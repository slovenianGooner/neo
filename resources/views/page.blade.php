<x-layout>
    <div class="p-4 mx-auto max-w-screen-lg flex flex-col gap-4 mt-24">
        <h1 class="font-bold text-xl">{{ $page->title }}</h1>
        <div class="prose">
            {!! $page->body !!}
        </div>
        @foreach($page->posts as $post)
            <h2 class="font-bold text-lg">{{ $post->title }}</h2>
            <div class="prose">
                {!! $post->body !!}
            </div>
        @endforeach
    </div>
</x-layout>
