<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Indavideó letöltés</title>
    <meta name="description" content="Ingyenes, egyszerű Indavideó letöltő, akár mobilon is. Videók letöltése egy kattintással mp4 formátumban.">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
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
                    >

                    <div class="button-container">
                        <a class="button" href="#" v-on:click="getSource">
                            <span v-if="loading"><i class="fa fa-fw fa-spin fa-circle-o-notch"></i></span>
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
        </p>
        <p class="copyright">
            &copy; 2014-{{ date('Y') }} <a href="https://nxu.hu" target="_blank">nxu</a>
            &middot;
            <a href="mailto:nxu@nxu.hu">nxu@nxu.hu</a>
        </p>

        <p class="exclaimer">
            Az oldal semmilyen kapcsolatban nem áll az indavideo.hu-val vagy az Inda-Labs Zrt-vel.
        </p>

        <p>
            <a href="https://www.paypal.me/nabunub" target="_blank" class="button donate">
                <i class="fa fa-fw fa-paypal"></i> DONATE
            </a>
        </p>
    </footer>
</div>

<a href="https://github.com/nXu/indadl" target="_blank" class="github-ribbon"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>

<script src="/js/app.js"></script>
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
