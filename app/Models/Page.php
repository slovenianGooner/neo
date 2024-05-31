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

    public function getUrl(): string
    {
        return route($this->getRouteName());
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }

    public function getDepth(): int
    {
        return $this->ancestors()->count();
    }

    public function getRouteName(): string
    {
        return 'pages.show.' . $this->id;
    }

    public function getNestedSlug(): string
    {
        return $this->ancestors()->pluck('slug')->push($this->slug)->implode('/');
    }

    public function getIndentedTitle(int $startingDepth = 0): string
    {
        // Figure out how deep the page is in the tree
        $depth = $this->getDepth();

        if ($depth > $startingDepth) {
            // If it's not the root page, add a dash for each level
            return str_repeat('&mdash;&mdash;', $depth - $startingDepth) . ' ' . $this->title;
        }

        return $this->title;
    }

    public function isActive(): bool
    {
        return Route::currentRouteName() === $this->getRouteName();
    }

    public function isChildActive(): bool
    {
        return $this->descendants->get()->map(fn(Page $page) => $page->getRouteName())->contains(Route::currentRouteName());
    }
}
