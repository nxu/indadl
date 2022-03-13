<?php

namespace App\Http\Controllers;

use App\IndavideoClient;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
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

    public function api()
    {
        return Inertia::render('Api');
    }
}
