<?php

namespace App;

use InvalidArgumentException;

class AmfResponseParser
{
    public function parseVideoData(array $response)
    {
        $token = array_first(array_get($response, 'data.filesh', []));

        $rawUrls = $this->getAvailableRawUrls($response);

        if (empty($rawUrls)) {
            return $this->getFallback($response);
        }

        $urls = collect($rawUrls)->map(function ($url, $resolution) use ($token) {
            if (str_contains($url, '?')) {
                return "$url&token=$token";
            }

            return "$url?token=$token";
        });

        return new VideoData($urls->toArray());
    }

    protected function getAvailableRawUrls($response)
    {
        $resolutions = [];
        $originalUrl = array_get($response, 'data.video_file');
        $files = array_get($response, 'data.flv_files');

        if (! $files) {
            return null;
        }

        foreach ($files as $file) {
            if (mb_strpos($file, '.360.mp4') !== false) {
                $resolutions['360'] = str_replace($files[0], $file, $originalUrl);
            }

           if (mb_strpos($file, '.720.mp4') !== false) {
               $resolutions['720'] = str_replace($files[0], $file, $originalUrl);
            }

            if (mb_strpos($file, '.1080.mp4') !== false) {
                $resolutions['1080'] = str_replace($files[0], $file, $originalUrl);
            }
        }

        return $resolutions;
    }

    protected function getFallback($response)
    {
        $file = array_get($response, 'data.video_file');

        if (! $file) {
            throw new InvalidArgumentException('Video URL could not be retrieved from Indavideo API.');
        }

        $token = (array) array_get($response, 'data.filesh', []);
        $token = array_shift($token);

        if (! $token) {
            throw new InvalidArgumentException('Video URL could not be retrieved from Indavideo API.');
        }

        return $file . "?token=$token";
    }
}
