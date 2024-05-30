<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Route;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasSlug, NodeTrait;

    protected $fillable = [
        'parent_id',
        'active',
        'title',
        'slug',
        'body'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function rootParent(): ?Model
    {
        return $this->ancestors()->first() ?? $this;
    }

    public function posts(): HasMany
    {
        return $this->hasMany(PagePost::class, 'page_id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function getDepth(): int
    {
        return $this->ancestors()->count();
    }

    public function isActive(): bool
    {
        return Route::currentRouteName() === 'pages.show.' . $this->id;
    }

    public function isChildActive(): bool
    {
        return $this->descendants->pluck('id')->map(fn($id) => 'pages.show.' . $id)->contains(Route::currentRouteName());
    }
}
