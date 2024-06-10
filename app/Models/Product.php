<?php

namespace App\Models;

use App\Models\Product\Price;
use App\Models\Product\Specification;
use App\Models\Scopes\LanguageScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

#[ScopedBy([LanguageScope::class])]
class Product extends Model implements HasMedia
{
    use HasSlug, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'active',
        'title',
        'slug',
        'body',
        'locale',
        'template',
        'template_data',
    ];

    protected $casts = [
        'active' => 'boolean',
        'template_data' => 'json'
    ];

    protected static function booted(): void
    {
        static::saving(function (Product $product) {
            $product->locale = session_locale();
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

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug')
            ->extraScope(fn($builder) => $builder->where('locale', session_locale())->where('category_id', $this->category_id));
    }

    public function getRouteName(): string
    {
        return 'products.show.' . $this->id;
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Page::class, "category_id");
    }

    public function scopeForCategory(Builder $query, Page $page): Builder
    {
        return $query->whereIn('category_id', $page->descendantsAndSelf($page->id)->pluck('id')->toArray());
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(Specification::class);
    }

    public function getNestedSlug(string $locale): string
    {
        return $this->category->getNestedSlug($locale) . '/' . $this->slug;
    }

    public function getTemplateViewAttribute(): string
    {
        return $this->template ? 'product-templates.' . $this->template : 'product';
    }

    public function getExcerpt(int $length = 100): string
    {
        return Str::of($this->body)->limit($length)->stripTags();
    }

    public function getSpecification(string $key): ?Specification
    {
        return $this->specifications()->whereHas('type', fn($query) => $query->where('name', $key))->first();
    }

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function getPrice(): ?Price
    {
        // Active price can be one of the following
        // 1. Price with valid_from <= now and valid_to >= now
        // 2. Price with valid_from <= now and valid_to = null
        // 3. Price with valid_from = null and valid_to >= now
        return $this->prices()->where(function ($query) {
            $query->where('valid_from', '<=', now())->where('valid_to', '>=', now());
        })->orWhere(function ($query) {
            $query->where('valid_from', '<=', now())->whereNull('valid_to');
        })->orWhere(function ($query) {
            $query->whereNull('valid_from')->where('valid_to', '>=', now());
        })->first();
    }
}
