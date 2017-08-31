@extends('app')

@section('content')
<section class="panel">
    <header>
        <h1>Indavideó letöltés API</h1>
    </header>

    <div class="content">
        <code><strong>POST</strong> https://indavideo.nxu.hu/url</code>

<pre><strong>200 OK</strong>

{
    "url": "http://url.com/video.mp4?params"
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
