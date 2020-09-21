<?php

namespace App;

class AssetContentInliner
{
    public function getMixedAsset($asset)
    {
        $hash = md5_file(public_path('mix-manifest.json'));

        return cache()->rememberForever("asset:$asset:$hash", function () use ($asset) {
            return file_get_contents(public_path($asset));
        });
    }
}
