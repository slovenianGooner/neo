<x-layout :page-title="$page->title">
    <div class="p-4 mx-auto max-w-screen-lg flex flex-col gap-4 mt-24">
        <h1 class="font-bold text-xl">{{ $page->title }}</h1>
        <div class="prose">
            {!! $page->body !!}
        </div>
        @foreach($page->posts as $post)
            <h2 class="font-bold text-lg">{{ $post->title }}</h2>
            <div class="prose max-w-none">
                {!! $post->body !!}
            </div>
            <x-gallery :gallery="$post->getMedia('gallery')"/>
            <x-files :files="$post->getMedia('files')"/>
        @endforeach
    </div>
</x-layout>
