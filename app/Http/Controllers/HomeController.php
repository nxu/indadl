<?php

namespace App\Http\Controllers;

use App\IndavideoClient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Video', ['video' => json_decode('{"url":"http:\/\/index2-hu.indavideo.hu\/indavideo\/003\/562\/954\/FEMINA_DELONGHI_KAMPANY_2021.360.mp4??&channel=main&zone=hu&zone=upc&token=435673292c3c3c2f189a88e0d2e5b9d4","resolutions":{"360":"http:\/\/index2-hu.indavideo.hu\/indavideo\/003\/562\/954\/FEMINA_DELONGHI_KAMPANY_2021.360.mp4??&channel=main&zone=hu&zone=upc&token=435673292c3c3c2f189a88e0d2e5b9d4","720":"http:\/\/index2-hu.indavideo.hu\/indavideo\/003\/562\/954\/FEMINA_DELONGHI_KAMPANY_2021.720.mp4??&channel=main&zone=hu&zone=upc&token=db45eac9e1c9a1b1b5c9a105e658ba3a","1080":null}}')]);
        return Inertia::render('Index');
    }

    public function download(Request $request, IndavideoClient $indavideoClient)
    {
        $request->validate(['url' => 'required']);

        $url = $request->get('url');

        try {
            $video = $indavideoClient->getVideoUrl($url);
            return Inertia::render('Video', compact('video'));
        } catch (\InvalidArgumentException $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ], 400);
        }
    }
}
