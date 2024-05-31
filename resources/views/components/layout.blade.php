<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $pageDescription ?? 'Welcome to our website' }}">
    <title>{{ $pageTitle ?? config('filament.homepage_title') }} &mdash; {{ config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>

    @stack('css')
    @vite('resources/css/website.css')

</head>
<body class="bg-white">
<x-navigation>
    <x-slot:logo>
        <a href="{{ route('home') }}">
            {{ config('app.name') }}
        </a>
    </x-slot:logo>
    <x-slot:prepend>
        <a href="{{ route('home') }}" class="text-gray-900 hover:text-gray-700">Home</a>
        <a href="{{ route('posts') }}" class="text-gray-900 hover:text-gray-700">Posts</a>
    </x-slot:prepend>
</x-navigation>
{{ $slot }}
@stack('js')
</body>
</html>
