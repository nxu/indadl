<?php
/* (c) 2014 nXu */

/**
 * Exits after displaying an error message.
 *
 * @param string  $msg
 * @param bool  $hotlink
 */
function error($msg, $hotlink = false)
{
    if (!$hotlink) {
        die(json_encode([
            'success' => false,
            'message' => $msg
        ]));
    } else {
        header('Location:/');
        exit;
    }
}

/**
 * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
 * array containing the HTTP server response header fields and content.
 *
 * @param string  $url
 * @return array
 */
function get_web_page($url)
{
    $user_agent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1';
    $cookie = tempnam("/tmp", "CURLCOOKIE");

    $options = array(

        CURLOPT_CUSTOMREQUEST => "GET",        //set request type post or get
        CURLOPT_POST => false,        //set to GET
        CURLOPT_USERAGENT => $user_agent, //set user agent
        CURLOPT_COOKIEFILE => $cookie, //set cookie file
        CURLOPT_COOKIEJAR => $cookie, //set cookie file
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING => "",       // handle all encodings
        CURLOPT_AUTOREFERER => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT => 120,      // timeout on response
        CURLOPT_MAXREDIRS => 10,       // stop after 10 redirects
    );

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    $header = curl_getinfo($ch);
    curl_close($ch);

    $header['errno'] = $err;
    $header['errmsg'] = $errmsg;
    $header['content'] = $content;
    return $header;
}

/**
 * Follows redirects of a url and returns the final one.
 *
 * @param string  $url
 * @param int  $timeout
 * @return mixed
 */
function get_final_url($url, $timeout = 120)
{
    $url = str_replace("&amp;", "&", urldecode(trim($url)));

    $cookie = tempnam("/tmp", "CURLCOOKIE");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1");
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    $content = curl_exec($ch);
    $response = curl_getinfo($ch);
    curl_close($ch);

    if ($response['http_code'] == 301 || $response['http_code'] == 302) {
        ini_set("user_agent", "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1");
        $headers = get_headers($response['url']);

        $location = "";
        foreach ($headers as $value) {
            if (substr(strtolower($value), 0, 9) == "location:")
                return get_final_url(trim(substr($value, 9, strlen($value))));
        }
    }

    if (preg_match("/window\.location\.replace\('(.*)'\)/i", $content, $value) ||
        preg_match("/window\.location\=\"(.*)\"/i", $content, $value)
    ) {
        return get_final_url($value[1]);
    } else {
        return $response['url'];
    }
}

