<?php

use App\Models\Page;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

if (Schema::hasTable('pages')) {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    foreach (Page::orderBy('_lft')->get() as $page) {
        Route::get($page->getNestedSlug(), function () use ($page) {
            return view('page', compact('page'));
        })->name($page->getRouteName());
    }

    foreach (Post::query()->get() as $post) {
        Route::get(config('filament.posts_slug') . '/' . $post->slug, function () use ($post) {
            return view('post', compact('post'));
        })->name($post->getRouteName());
    }

    Route::get(config('filament.posts_slug'), function () {
        return view('posts', [
            'posts' => Post::query()->latest()->paginate(),
        ]);
    })->name('posts');
}
