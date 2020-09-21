<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Indavideó letöltés</title>
    <meta name="description" content="Ingyenes, egyszerű Indavideó letöltő, akár mobilon is. Videók letöltése egy kattintással mp4 formátumban.">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="preload"
          href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;700&display=swap"
          as="style"
          onload="this.onload=null;this.rel='stylesheet'"
    >
</head>
<body>

<div id="app">
    <main>
        @section('content')
        <section class="panel">
            <header>
                <h1>Indavideó letöltés</h1>
            </header>

            <div class="content" v-if="! ('360' in files)">
                <div class="input-with-button">
                    <input type="text"
                           autofocus
                           class="form-input"
                           v-model="sourceUrl"
                           placeholder="Indavideó videó URL"
                           v-on:keyup.enter="getSource"
                           v-on:keyup="resetError"
                           aria-label="Indavideo URL"
                    >

                    <div class="button-container">
                        <a class="button" href="#" v-on:click="getSource">
                            <span v-if="loading">
                                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve" style="width:20px;height:20px;">
                                    <path fill="#fff" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                                      <animateTransform
                                          attributeName="transform"
                                          attributeType="XML"
                                          type="rotate"
                                          dur="1s"
                                          from="0 50 50"
                                          to="360 50 50"
                                          repeatCount="indefinite" />
                                  </path>
                                </svg>
                            </span>
                            <span v-else>Letöltés</span>
                        </a>
                    </div>
                </div>

                <p class="error" v-if="error.length > 0">@{{ error }}</p>
            </div>

            <div class="content center" v-else>
                <a href="#" class="reset-button" @click="reset()">Másik videót töltök le</a>

                <div>
                    <tabs>
                        <tab v-for="(file, resolution) in files"
                             v-if="file != null"
                             :name="resolution + 'p'"
                             :key="'restab' + resolution"
                        >
                            <a :href="file" class="button large" download>Letöltés</a>

                            <hr>

                            <video :src="file" controls></video>
                        </tab>
                    </tabs>
                </div>
            </div>
        </section>
        @show
    </main>

    <footer>
        <p class="api">
            <a href="/api">API</a>
            <span>&nbsp;&middot;&nbsp;</span>
            <a href="https://stats.uptimerobot.com/nYB1qC7YwQ/784058498" target="_blank" rel="noopener">Status</a>
        </p>
        <p class="copyright">
            &copy; 2014-{{ date('Y') }} <a href="https://nxu.hu" target="_blank" rel="noopener">nxu</a>
            &middot;
            <a href="mailto:nxu@nxu.hu">nxu@nxu.hu</a>
        </p>

        <p class="exclaimer">
            Az oldal semmilyen kapcsolatban nem áll az indavideo.hu-val vagy az Inda-Labs Zrt-vel.
        </p>

        <p>
            <a href="https://www.paypal.me/nabunub" target="_blank" class="button donate" rel="noreferrer">
                <svg style="height:12px;width:12px;display:inline-block;vertical-align:middle" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="paypal" class="svg-inline--fa fa-paypal fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M111.4 295.9c-3.5 19.2-17.4 108.7-21.5 134-.3 1.8-1 2.5-3 2.5H12.3c-7.6 0-13.1-6.6-12.1-13.9L58.8 46.6c1.5-9.6 10.1-16.9 20-16.9 152.3 0 165.1-3.7 204 11.4 60.1 23.3 65.6 79.5 44 140.3-21.5 62.6-72.5 89.5-140.1 90.3-43.4.7-69.5-7-75.3 24.2zM357.1 152c-1.8-1.3-2.5-1.8-3 1.3-2 11.4-5.1 22.5-8.8 33.6-39.9 113.8-150.5 103.9-204.5 103.9-6.1 0-10.1 3.3-10.9 9.4-22.6 140.4-27.1 169.7-27.1 169.7-1 7.1 3.5 12.9 10.6 12.9h63.5c8.6 0 15.7-6.3 17.4-14.9.7-5.4-1.1 6.1 14.4-91.3 4.6-22 14.3-19.7 29.3-19.7 71 0 126.4-28.8 142.9-112.3 6.5-34.8 4.6-71.4-23.8-92.6z"></path></svg>
                <span style="display-inline-block;vertical-align:middle">DONATE</span>
            </a>
        </p>
    </footer>
</div>

<a href="https://github.com/nXu/indadl" target="_blank" class="github-ribbon" rel="noopener"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>

<script src="{{ mix('/js/app.js') }}"></script>
<script>!function(e,t,r,a,n,c,l,o){function h(e,t,r,a){for(r='',a='0x'+e.substr(t,2)|0,t+=2;t<e.length;t+=2)r+=String.fromCharCode('0x'+e.substr(t,2)^a); return r}try{for(n=e.getElementsByTagName('a'),l='/cdn-cgi/l/email-protection#',o=l.length,a=0;a<n.length;a++)try{c=n[a],t=c.href.indexOf(l),t>-1&&(c.href='mailto:'+h(c.href,t+o))}catch(f){}for(n=Array.prototype.slice.apply(e.getElementsByClassName('__cf_email__')),a=0;a<n.length;a++)try{c=n[a],c.parentNode.replaceChild(e.createTextNode(h(c.getAttribute('data-cfemail'),0)),c)}catch(f){}}catch(f){}}(document)</script><script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', '{{ config('app.ga_key') }}', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>
