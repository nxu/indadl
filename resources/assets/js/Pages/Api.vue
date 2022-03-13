<template>
  <Layout>
    <div class="mt-8 sm:mt-32">
      <h1 class="text-center mb-8 text-4xl font-bold font-serif">
        Indavideó letöltés API
      </h1>

      <Card>
        <h2 class="text-xl font-bold font-serif mb-2">Request</h2>
<pre class="bg-gray-200 p-3 rounded mb-4"><span class="font-bold">POST</span> https://indavideo.nxu.hu/url
Content-Type: application/json

{
    "url": "http://indavideo.hu/video/my_video_url"
}
</pre>

        <h2 class="text-xl font-bold font-serif mb-2">Response</h2>
<pre class="bg-gray-200 p-3 rounded mb-4"><span class="font-bold">200 OK</span>
Content-Type: application/json

{
    "url": "http://url.com/video.mp4?params",
    "resolutions": {
        360: "http://url.com/video.mp4?params",
        720: "http://url.com/video.mp4?params",
        1080: null
    }
}
</pre>

        <h2 class="text-xl font-bold font-serif mb-2">Hiba</h2>

<pre class="bg-gray-200 p-3 rounded mb-6"><span class="font-bold">400 Bad Request</span>
Content-Type: application/json

{
    "error": "Error message in English"
}
</pre>

        <p class="font-bold text-sm">Kérlek, használd felelősséggel.</p>
      </Card>
    </div>
  </Layout>
</template>

<script>
import Card from '../Components/Card'
import Layout from '../Components/Layout'

export default {
  components: {Layout, Card }
}
</script>
