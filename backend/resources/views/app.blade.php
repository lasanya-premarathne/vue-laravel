<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite([
            // 'resources/css/app.css',
            'resources/js/app.js',
            '../../public/theme/css/style.css',
            '../../public/theme/js/custom.min.js',
            '../../public/theme/scss/main.scss',
            // '../../public/theme/'
        ])
    </head>
    <body class="antialiased">
        <!-- Adding jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <div id="app"></div>
    </body>
</html>
