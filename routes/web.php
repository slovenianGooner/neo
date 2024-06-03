<?php

use App\Models\Page;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

try {
    if (Schema::hasTable('pages')) {
        // Route for homepage
        Route::get('/', function () {
            $page = Page::where('homepage', true)->first();
            if ($page) {
                return view($page->template ? 'page-templates.' . $page->template : 'page', compact('page'));
            }

            return view('welcome');
        })->name('home');

        // Routes for all pages
        foreach (Page::orderBy('_lft')->where('homepage', false)->get() as $page) {
            Route::get($page->getNestedSlug(), function () use ($page) {
                return view($page->template ? 'page-templates.' . $page->template : 'page', compact('page'));
            })->name($page->getRouteName());
        }

        // Route for all posts
        foreach (Post::query()->get() as $post) {
            Route::get(config('neo.posts_slug') . '/' . $post->slug, function () use ($post) {
                return view('post', compact('post'));
            })->name($post->getRouteName());
        }

        // Route for all posts
        Route::get(config('neo.posts_slug'), function () {
            return view('posts', [
                'posts' => Post::query()->latest()->paginate(),
            ]);
        })->name('posts');
    }
} catch (Exception $e) {
}
