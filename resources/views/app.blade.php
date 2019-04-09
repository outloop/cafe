<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="/favicon.icon" type="image/x-icon">

    <title>Cafe</title>

</head>

<body>
<div id="app">
    <router-view></router-view>
</div>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
