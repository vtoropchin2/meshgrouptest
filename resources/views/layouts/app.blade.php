<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Test task</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?hash={{ md5_file(public_path('js/app.js')) }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}?hash={{ md5_file(public_path('css/app.css')) }}" rel="stylesheet">
</head>
<body>
<div id="app" class="container">
    <app-component></app-component>
</div>
</body>
</html>
