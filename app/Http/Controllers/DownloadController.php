<?php

namespace App\Http\Controllers;

use App\IndavideoClient;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function getVideoUrl(Request $request, IndavideoClient $indavideoClient)
    {
        $this->validate($request, [
            'url' => 'required'
        ]);

        $url = $request->get('url');

        try {
            return response()->json($indavideoClient->getVideoUrl($url));
        } catch (\InvalidArgumentException $ex) {
            return response()->json([
                'error' => $ex->getMessage()
            ], 400);
        }
    }
}
