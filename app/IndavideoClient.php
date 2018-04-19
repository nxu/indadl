<?php

namespace App;

use GuzzleHttp\Client;

class IndavideoClient
{
    const INDAVIDEO_API_ENDPOINT = 'http://amfphp.indavideo.hu/SYm0json.php/player.playerHandler.getVideoData/';

    // Url will be used later, no need for pattern markers
    const EMBED_URL_PATTERN = '~https?://embed\.indavideo\.hu/player/video/([0-9a-f]+)(\?.*)?~';

    const NORMAL_URL_PATTERN = '~^https?://([a-zA-Z]+\.)?indavideo\.hu/video/([a-zA-Z0-9_#\-]+)(\?.*)?$~i';

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getVideoUrl($url)
    {
        $url = $this->appendHttpIfNecessary($url);

        // Try to use URL as embed video URL directly
        $videoHash = $this->getVideoHashFromString($url);

        if (! $videoHash) {
            if (! $this->isNormalUrl($url)) {
                throw new \InvalidArgumentException('Invalid Indavideo URL provided');
            }

            $pageContent = $this->getPageContent($url);

            if (! $videoHash = $this->getVideoHashFromString($pageContent)) {
                throw new \InvalidArgumentException('Embed video URL not found.');
            }
        }

        $apiResponse = $this->getPageContent(static::INDAVIDEO_API_ENDPOINT . $videoHash, [
            'headers' => [
                'Referer' => 'https://assets.indavideo.hu',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36',
            ]
        ], true);

        $videoData = json_decode($apiResponse, true);

        $parser = new AmfResponseParser();
        return $parser->parseVideoData($videoData);
    }

    protected function appendHttpIfNecessary($url)
    {
        if (!preg_match('~^https?://~', $url)) {
            $url = 'http://' . $url;
        }

        return $url;
    }

    protected function getVideoHashFromString($stringContainingEmbedUrl)
    {
        if (! preg_match(static::EMBED_URL_PATTERN, $stringContainingEmbedUrl, $hash)) {
            return false;
        }

        return $hash[1];
    }

    protected function isNormalUrl($url)
    {
        return preg_match(static::NORMAL_URL_PATTERN, $url);
    }

    protected function getPageContent($url, $params = [])
    {
        $result = $this->client->request('GET', $url, $params);

        return (string) $result->getBody();
    }
}
