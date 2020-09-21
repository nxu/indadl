<?php

namespace App;

use Illuminate\Support\Arr;
use JsonSerializable;

class VideoData implements JsonSerializable
{
    private $sd;
    private $hd;
    private $uhd;

    public function __construct($files)
    {
        $this->sd = Arr::get($files, '360');
        $this->hd = Arr::get($files, '720');
        $this->uhd = Arr::get($files, '1080');
    }

    public function getSd()
    {
        return $this->sd;
    }

    public function getHd()
    {
        return $this->hd;
    }

    public function getUhd()
    {
        return $this->uhd;
    }

    function jsonSerialize()
    {
        return [
            'url' => $this->getSd(), // Backwards compatibility
            'resolutions' => [
                '360' => $this->getSd(),
                '720' => $this->getHd(),
                '1080' => $this->getUhd()
            ]
        ];
    }
}
