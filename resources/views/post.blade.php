<x-layout :page-title="$post->title">
    <div class="p-4 flex flex-col gap-4 mt-24 max-w-screen-lg mx-auto">
        <h1 class="font-bold text-xl">{{ $post->title }}</h1>
        <div class="prose">
            {!! $post->body !!}
        </div>
        <x-gallery :gallery="$post->getMedia('gallery')"/>
        <x-files :files="$post->getMedia('files')"/>
        <a href="{{ route('posts', [...request()->query()]) }}" class="underline mt-4">
            Back
        </a>
    </div>
</x-layout>
