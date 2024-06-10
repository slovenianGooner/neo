<?php

namespace App\Models;

use App\Models\Scopes\LanguageScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

#[ScopedBy([LanguageScope::class])]
class Post extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $fillable = ['published', 'title', 'slug', 'locale', 'body'];

    protected static function booted(): void
    {
        static::saving(function (Post $post) {
            $post->locale = session_locale();
        });
    }

    public function getUrl(array $query = []): string
    {
        return route($this->getRouteName(), [...$query]);
    }

    public function getUrlWithQueryString(): string
    {
        return $this->getUrl([...request()->query()]);
    }

    public function getRouteName(): string
    {
        return 'posts.show.' . $this->id;
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getExcerpt(int $length = 100): string
    {
        return Str::of($this->body)->limit($length)->stripTags();
    }
}
