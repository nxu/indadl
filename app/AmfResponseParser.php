<?php

namespace App;

use InvalidArgumentException;

class AmfResponseParser
{
    public function parseVideoData(array $response)
    {
        $availableFile = array_get($response, 'data.video_file');
        $hashes = array_get($response, 'data.filesh', []);
        $files = array_get($response, 'data.flv_files', []);
        $urls = ['360' => $availableFile . "&token=$hashes[360]"];

        $resolutions = $this->getAvailableResolutions($response);

        if (! $resolutions) {
            return $this->getFallback($response);
        }

        $hashes_keys = array_keys($hashes);
        for ($index = 0; $index < count($files) - 1; $index++) {
            $token = array_get($hashes, $hashes_keys[$index + 1]);
            $urls[$resolutions[$index]] = str_replace($files[0], $files[$index + 1], $availableFile). "&token=$token";
        }

        return new VideoData($urls);
    }

    protected function getAvailableResolutions($response)
    {
        $resolutions = [];
        $files = array_get($response, "data.flv_files");

        if (! $files) {
            return null;
        }

        foreach ($files as $file) {

if (mb_strpos($file, '.360.mp4') !== false) {
                $resolutions[] = '360';
            }

           if (mb_strpos($file, '.720.mp4') !== false) {
                $resolutions[] = '720';
            }

            if (mb_strpos($file, '.1080.mp4') !== false) {
                $resolutions[] = '1080';
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
