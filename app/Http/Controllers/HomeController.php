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
            return response()->json([
                'url' => $indavideoClient->getVideoUrl($url)
            ]);
        } catch (\InvalidArgumentException $ex) {
            return response($ex->getMessage(), 400);
        }
    }
}
