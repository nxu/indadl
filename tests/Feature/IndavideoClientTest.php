<?php

namespace Tests\Feature;

use App\IndavideoClient;
use GuzzleHttp\Client;
use InvalidArgumentException;
use Tests\TestCase;

class IndavideoClientTest extends TestCase
{
    public function testItFailsOnInvalidUrl()
    {
        $this->expectException(InvalidArgumentException::class);

        $client = new IndavideoClient(new Client());
        $client->getVideoUrl('nonsense');
    }

    public function testItFailsOnNonIndavideoUrl()
    {
        $this->expectException(InvalidArgumentException::class);

        $client = new IndavideoClient(new Client());
        $client->getVideoUrl('https://www.google.com');
    }

    public function testItReturnsMultipleResolutionsForBasicUserVideo()
    {
        $client = new IndavideoClient(new Client());
        $urls = $client->getVideoUrl('https://indavideo.hu/video/Jatek_kezenallva');

        $this->assertNotFalse(curl_init($urls->getSd()));
        $this->assertNotFalse(curl_init($urls->getHd()));
    }

    public function testItReturnsMultipleResolutionsForProUserVideo()
    {
        $client = new IndavideoClient(new Client());
        $urls = $client->getVideoUrl('https://indavideo.hu/video/Batman_-_10_erdekes_teny');

        $this->assertNotFalse(curl_init($urls->getSd()));
        $this->assertNotFalse(curl_init($urls->getHd()));
    }

    public function testItReturnsMultipleResolutionsForProUserAnime()
    {
        $client = new IndavideoClient(new Client());
        $urls = $client->getVideoUrl('https://indavideo.hu/video/Muhyo_to_Rouji_no_Maho_uritsu_Soudan_Jimusho_2evad_5resz_Magyar_Felirattal');

        $this->assertNotFalse(curl_init($urls->getSd()));
        $this->assertNotFalse(curl_init($urls->getHd()));
    }

    public function testItReturnsValidUrlsForSudomainIndavideoUrl()
    {
        $client = new IndavideoClient(new Client());
        $urls = $client->getVideoUrl('http://index.indavideo.hu/video/rasko_eszter_szaboz_sziget_25_eves');

        $this->assertNotFalse(curl_init($urls->getSd()));
        $this->assertNotFalse(curl_init($urls->getHd()));
    }

    public function testItReturnsValidUrlForEmbedUrls()
    {
        $client = new IndavideoClient(new Client());
        $urls = $client->getVideoUrl('http://embed.indavideo.hu/player/video/691b51997a');

        $this->assertNotFalse(curl_init($urls->getSd()));
    }
}
