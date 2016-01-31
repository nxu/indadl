<?php
/* (c) 2014-2016 nXu */

// Check if hotlink mode
$hotlink = !empty($_GET['hotlink']) && $_GET['hotlink'] == 'true';

require_once('functions.php');

define('INDA_AMFPHP', 'http://amfphp.indavideo.hu/SYm0json.php/player.playerHandler.getVideoData/');

// Set JSON header
header('Content-Type: application/json');

// Check if param was given
if (!isset($_GET['url'])) {
    error("Nem adtál meg URL-t", $hotlink);
}

// Assign param
$url = $_GET['url'];

$isEmbed = false;
$hash = array();

// Check if hotlink mode (indadirect)
if ($hotlink) {
    // It is, fix url
    $url = sprintf("http://%s/%s", str_replace(".nxu", "", $_SERVER['HTTP_HOST']), trim($url, '/'));
}

// Add http if not already in the url
if (!preg_match('~^https?://~', $url)) {
    $url = 'http://' . $url;
}

// Check if URL is valid and if it's an embed or a real url
$embedPattern = "https?://embed\.indavideo\.hu/player/video/([0-9a-f]+)(\?.*)?";
$normalPattern = "~^https?://([a-zA-Z]+\.)?indavideo\.hu/video/([a-zA-Z0-9_#\-]+)(\?.*)?$~i";

if (preg_match("~^" . $embedPattern . "$~", $url, $hash)) {
    $isEmbed = true;
} else if (!preg_match($normalPattern, $url)) {
    error("Érvénytelen URL", $hotlink);
}

// Get hash
if ($isEmbed) {
    // Embed link, it's simple
    $hash = $hash[1];
} else {
    // Not an embed link, gotta scrape it from the html source

    // Follow redirects even when CURL sucks.
    // Might need to start using composer + Guzzle one day :)
    $url = get_final_url($url);

    // Load page
    $result = get_web_page($url);
    if ($result['http_code'] != 200) {
        error("Az oldal nem elérhető");
    }

    $page = $result['content'];

    // Page loaded, get the embed link
    preg_match("~" . $embedPattern . "~", $page, $hash);
    if (sizeof($hash) < 2) {
        error("A videó hash nem található", $hotlink);
    }

    $hash = $hash[1];
}

// Get video URL
$result = get_web_page(INDA_AMFPHP . $hash);
if ($result['http_code'] != 200)
    error("Az amfphp nem elérhető");

$page = $result['content'];
$page = json_decode($page);

if (!isset($page->data->video_file)) {
    error("A videó linkje nem található", $hotlink);
}

if ($hotlink) {
    header('Location:' . $page->data->video_file);
    exit;
} else {
    die(json_encode([
        'success' => true,
        'video_url' => $page->data->video_file
    ]));
}