<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class PagePost extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $table = 'page_posts';

    protected $fillable = [
        'page_id',
        'published',
        'title',
        'body',
        'order'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public static function booted(): void
    {
        static::creating(function ($pagePost) {
            $pagePost->order = static::where('page_id', $pagePost->page_id)->max('order') + 1;
        });
    }
}
