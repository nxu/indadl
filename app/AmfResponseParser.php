<?php

namespace App;

use InvalidArgumentException;

class AmfResponseParser
{
    public function parseVideoData(array $response)
    {
        $availableFiles = array_get($response, 'data.video_files', []);
        $hashes = array_get($response, 'data.filesh', []);
        $urls = [];
        $index = 0;

        $resolutions = $this->getAvailableResolutions($response);

        if (! $resolutions) {
            return $this->getFallback($response);
        }

        foreach ($resolutions as $resolution) {
            $token = array_get($hashes, $resolution);
            $urls[$resolution] = array_get($availableFiles, $index++) . "&token=$token";
        }

        return new VideoData($urls);
    }

    protected function getAvailableResolutions($response)
    {
        $resolutions = ['360'];
        $files = array_get($response, "data.video_files");

        if (! $files) {
            return null;
        }

        foreach ($files as $file) {
            if (mb_strpos($file, '.720.mp4?') !== false) {
                $resolutions[] = '720';
            }

            if (mb_strpos($file, '.1080.mp4?') !== false) {
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
