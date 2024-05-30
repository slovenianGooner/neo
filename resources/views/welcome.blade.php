<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config("app.name") }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @vite('resources/css/website.css')
</head>
<body class="font-sans antialiased dark:bg-black dark:text-white/50">
<div class="w-screen h-screen flex flex-col justify-center items-center gap-y-2">
    <div>This is your</div>
    <div class="text-4xl font-bold">[neo]</div>
    <div>Laravel application.</div>
</div>
</body>
</html>
