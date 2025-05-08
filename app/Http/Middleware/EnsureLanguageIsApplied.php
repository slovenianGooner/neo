<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View as View;
use Symfony\Component\HttpFoundation\Response;

class EnsureLanguageIsApplied
{
    public function handle(Request $request, Closure $next): Response
    {
        // Get the locale from the URL
        $locale = $request->segment(1);
        if (!array_key_exists($locale, config('neo.locales'))) {
            $locale = null;
        }
        $locale = $locale ?? config("neo.default_locale");
        app()->setLocale($locale);
        View::share("locale", $locale);
        View::share('hasMultipleLocales', count(config('neo.locales')) > 1);
        return $next($request);
    }
}
