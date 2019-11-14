<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Laravel</title>

    <script src="{{mix('js/app.js')}}" defer></script>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>
    <div id="app" class="container mx-auto p-5">
        <router-view></router-view>
    </div>
</body>
</html>
