<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $pageDescription ?? 'Welcome to our website' }}">
    <title>{{ $pageTitle ?? config('neo.homepage_title') }} &mdash; {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @stack('css')
    @vite('resources/css/website.css')

</head>
<body class="bg-white pt-16">
<x-navigation/>
{{ $slot }}
<x-footer/>
@stack('js')
</body>
</html>
