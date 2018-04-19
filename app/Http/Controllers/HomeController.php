<?php

namespace App\Http\Controllers;

use App\IndavideoClient;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('app');
    }

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

    public function apiDocs()
    {
        return view('api');
    }

    public function legacy()
    {
        return response('New API: https://indavideo.nxu.hu/api', 400);
    }
}
