<?php

use App\Http\Middleware\EnsureLanguageIsApplied;
use App\Models\Page;
use App\Models\Post;
use App\Models\Scopes\LanguageScope;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

try {
    if (Schema::hasTable('pages')) {

        $hasMultipleLocales = count(config('neo.locales')) > 1;

        if ($hasMultipleLocales) {
            Route::get('/', fn() => redirect(config('neo.default_locale')));
        }

        foreach (config('neo.locales') as $locale => $label) {
            Route::group(['prefix' => $hasMultipleLocales ? $locale : null, 'middleware' => EnsureLanguageIsApplied::class], function () use ($locale) {
                // Route for homepage
                $homepage = Page::getHomepage($locale);
                Route::get('/', fn() => view($homepage->template_view ?? 'welcome', ['page' => $homepage]))->name('home.' . $locale);

                // Routes for all pages
                foreach (Page::withoutGlobalScope(LanguageScope::class)->orderBy('_lft')->where('homepage', false)->where('locale', $locale)->get() as $page) {
                    Route::get($page->getNestedSlug($locale), fn() => view($page->template_view, compact('page')))->name($page->getRouteName());
                }

                // Route for all posts
                foreach (Post::withoutGlobalScope(LanguageScope::class)->where('locale', $locale)->get() as $post) {
                    Route::get(Lang::get('neo.posts_slug', locale: $locale) . '/' . $post->slug, fn() => view('post', [
                        'post' => $post
                    ]))->name($post->getRouteName());
                }

                // Route for all posts
                Route::get(Lang::get('neo.posts_slug', locale: $locale), fn() => view('posts', [
                    'posts' => Post::withoutGlobalScope(LanguageScope::class)->where('locale', $locale)->latest()->paginate()
                ]))->name('posts.' . $locale);
            });
        }
    }
} catch (Exception $e) {
}
