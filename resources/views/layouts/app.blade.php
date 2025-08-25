<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    @vite('resources/js/app.js')


</head>

<body class="antialiased bg-gray-100">
    @if(session('message'))
    <div class="bg-green-600 font-bold text-white p-5 text-center">{{ session('message') }}</div>
    @endif
    @yield('content')
</body>

</html>