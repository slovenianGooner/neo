<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class PagePost extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'page_posts';

    protected $fillable = [
        'page_id',
        'published',
        'title',
        'body',
        'order'
    ];

    protected $casts = [
        'published' => 'boolean',
        'body' => 'json'
    ];

    public static function booted(): void
    {
        static::creating(function ($pagePost) {
            $pagePost->order = static::where('page_id', $pagePost->page_id)->max('order') + 1;
        });
    }
}
