@extends('app')

@section('content')
<section class="panel">
    <header>
        <h1>Indavideó letöltés API</h1>
    </header>

    <div class="content">
        <h4>Request</h4>
        <pre><strong>POST</strong> https://indavideo.nxu.hu/url

{
    "url": "http://indavideo.hu/video/my_video_url"
}
</pre>

        <h4>Response</h4>
<pre><strong>200 OK</strong>

{
    "url": "http://url.com/video.mp4?params",
    "resolutions": {
        360: "http://url.com/video.mp4?params",
        720: "http://url.com/video.mp4?params",
        1080: null
    }
}</pre>

        <p>vagy</p>

<pre><strong>400 Bad Request</strong>

{
    "error": "Error message in English"
}</pre>

        <p>Kérlek, használd felelősséggel.</p>
    </div>
</section>
@overwrite
