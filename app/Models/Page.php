<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Model implements HasMedia
{
    use HasSlug, NodeTrait, InteractsWithMedia;

    protected $fillable = [
        'parent_id',
        'active',
        'homepage',
        'title',
        'slug',
        'template',
        'template_data',
        'body'
    ];

    protected $casts = [
        'active' => 'boolean',
        'homepage' => 'boolean',
        'template_data' => 'json'
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

    public function canMoveUp(): bool
    {
        // We can move up if the page is the lowest "_lft" compared to its siblings
        return $this->siblings()->where('_lft', '<', $this->_lft)->count() > 0;
    }

    public function canMoveDown(): bool
    {
        // We can move down if the page is the highest "_lft" compared to its siblings
        return $this->siblings()->where('_lft', '>', $this->_lft)->count() > 0;
    }

    public function moveUp(): void
    {
        if (!$this->canMoveUp()) {
            return;
        }

        // Get previous sibling
        /**
         * @var $neighbor Page
         */
        $neighbor = $this->siblings()->where('_lft', '<', $this->_lft)->orderBy('_lft', 'desc')->first();
        $this->beforeNode($neighbor)->save();
    }

    public function moveDown(): void
    {
        if (!$this->canMoveDown()) {
            return;
        }

        // Get next sibling
        /**
         * @var $neighbor Page
         */
        $neighbor = $this->siblings()->where('_lft', '>', $this->_lft)->orderBy('_lft')->first();
        $this->afterNode($neighbor)->save();
    }

    public static function getForNavigation(?int $parentId = null): Collection
    {
        return static::where('active', true)->where('parent_id', $parentId)->where('homepage', false)->orderBy('_lft')->get();
    }
}
