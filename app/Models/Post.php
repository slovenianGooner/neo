<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $fillable = ['published', 'title', 'slug', 'body'];

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
        return strip_tags(substr($this->body, 0, $length));
    }
}
