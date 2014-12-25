<?php
	/* (c) 2014-2015 nXu */
	require_once('functions.php');

	define('INDA_AMFPHP', 'http://amfphp.indavideo.hu/SYm0json.php/player.playerHandler.getVideoData/');

	// Set JSON header
	header('Content-Type: application/json');

	// Check if param was given
	if (!isset($_GET['url']))
		error("Nem adtál meg URL-t");

	// Assign param
	$url = $_GET['url'];

	// Check if URL is valid and if it's an embed or a real url
	$isEmbed = false;
	$hash = array();
	$embedPattern = "https?://embed\.indavideo\.hu/player/video/([0-9a-f]+)"; // No delimiters, will be needed later
	$normalPattern = "~^https?://([a-zA-Z]+\.)?indavideo\.hu/video/[a-zA-Z0-9_#\-]+$~";

	if (preg_match("~^" . $embedPattern . "$~", $url, $hash)) {
		$isEmbed = true;
	} else if (!preg_match($normalPattern, $url)) {
		error("Érvénytelen URL");
	}

	// Get hash
	if ($isEmbed) {
		// Embed link, it's simple
		$hash = $hash[1];
	} else {
		// Not an embed link, gotta scrape it from the html source
		$result = get_web_page($url);
		if ($result['http_code'] != 200)
			error("Az oldal nem elérhető");

		$page = $result['content'];

		// Page loaded, get the embed link
		preg_match("~" . $embedPattern . "~", $page, $hash);
		if (sizeof($hash) < 2) {
			error("A videó hash nem található");
		}

		$hash = $hash[1];
	}

	// Get video URL
	$result = get_web_page(INDA_AMFPHP . $hash);
	if ($result['http_code'] != 200)
		error("Az amfphp nem elérhető");

	$page = $result['content'];
	$page = json_decode($page);

	die('{"success": true, "video_url": "' . $page->data->video_file . '" }');
?>
