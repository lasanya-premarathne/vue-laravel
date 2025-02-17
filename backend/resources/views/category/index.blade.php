<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    @vite(['resources/js/app.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <div id="app">
        <app></app> <!-- Vue will replace this with App.vue -->
    </div>

    <script type="module" src="{{ Vite::asset('resources/js/app.js') }}"></script>

</body>
</html>
