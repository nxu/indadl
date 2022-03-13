<!DOCTYPE html>
<html lang="hu" class="min-h-full">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>Indavideó letöltés</title>
    <meta name="description" content="Ingyenes, egyszerű Indavideó letöltő, akár mobilon is. Videók letöltése egy kattintással mp4 formátumban.">
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500;700&family=Zilla+Slab:wght@700&display=swap" rel="stylesheet">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/app.js') }}" defer></script>
</head>
<body class="bg-gradient-to-bl from-white to-indigo-200 dark:from-[#1d1933] dark:to-[#12111f] min-h-full">
@inertia
</body>
</html>
