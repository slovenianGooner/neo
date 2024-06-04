<?php

use App\Models\Page;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

try {
    if (Schema::hasTable('pages')) {
        // Route for homepage
        $homepage = Page::getHomepage();
        Route::get('/', fn() => view($homepage->template_view ?? 'welcome', ['page' => $homepage]))->name('home');

        // Routes for all pages
        foreach (Page::orderBy('_lft')->where('homepage', false)->get() as $page) {
            Route::get($page->getNestedSlug(), fn() => view($page->template_view, compact('page')))->name($page->getRouteName());
        }

        // Route for all posts
        foreach (Post::query()->get() as $post) {
            Route::get(config('neo.posts_slug') . '/' . $post->slug, fn() => view('post', compact('post')))->name($post->getRouteName());
        }

        // Route for all posts
        Route::get(config('neo.posts_slug'), fn() => view('posts', ['posts' => Post::query()->latest()->paginate()]))->name('posts');
    }
} catch (Exception $e) {
}
