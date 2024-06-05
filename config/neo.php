<?php

return [
    'primary_color' => env('NEO_PRIMARY_COLOR', 'indigo'),
    'posts_slug' => env('NEO_POSTS_SLUG', 'posts'),
    'posts_title' => env('NEO_POSTS_TITLE', 'Posts'),
    'homepage_title' => env('NEO_HOMEPAGE_TITLE', 'Home'),
    'contact_us_email' => env('NEO_CONTACT_US_EMAIL', null),
    'default_locale' => env('NEO_DEFAULT_LOCALE', 'en'),
    'locales' => [
        'en' => 'English',
        'sl' => 'Slovenian'
    ],
];
