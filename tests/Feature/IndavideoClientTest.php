<?php

namespace Tests\Feature;

use App\IndavideoClient;
use GuzzleHttp\Client;
use Tests\TestCase;

class IndavideoClientTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testItFailsOnInvalidUrl()
    {
        $client = new IndavideoClient(new Client());
        $client->getVideoUrl('nonsense');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testItFailsOnNonIndavideoUrl()
    {
        $client = new IndavideoClient(new Client());
        $client->getVideoUrl('https://www.google.com');
    }

    public function testItReturnsValidUrlForBasicIndavideoUrl()
    {
        $client = new IndavideoClient(new Client());
        $url = $client->getVideoUrl('http://indavideo.hu/video/Anime_cosplay_bemutato');

        $this->assertNotFalse(curl_init($url));
    }

    public function testItReturnsValidUrlForSudomainIndavideoUrl()
    {
        $client = new IndavideoClient(new Client());
        $url = $client->getVideoUrl('http://index.indavideo.hu/video/rasko_eszter_szaboz_sziget_25_eves');

        $this->assertNotFalse(curl_init($url));
    }

    public function testItReturnsValidUrlForEmbedUrls()
    {
        $client = new IndavideoClient(new Client());
        $url = $client->getVideoUrl('http://embed.indavideo.hu/player/video/691b51997a');

        $this->assertNotFalse(curl_init($url));
    }
}
