<?php

namespace App\Livewire;

use App\Models\Page;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class ProductsList extends Component
{
    public ?string $locale;

    public Page $page;

    public Collection $categories;

    private ?Builder $query = null;

    public $filters = [
        'color' => [],
        'size' => [],
    ];

    public $products;

    public function mount(Page $page, string $locale): void
    {
        app()->setLocale($locale);

        $this->locale = $locale;
        $this->page = $page;
        $this->categories = $page->children()->orderBy('_lft')->get();
    }

    public function render(): View
    {
        $this->query = Product::forCategory($this->page);
        $this->products = $this->query->filteredBy($this->filters)->with(['media', 'specifications', 'prices'])->get();

        return view('livewire.products-list');
    }

    public function resetFilter(string $key): void
    {
        $this->filters[$key] = [];
    }

    public function getFilterOptions(string $key): array
    {
        return $this->query->with(['specifications' => function ($query) use ($key) {
            $query->whereHas('type', fn($query) => $query->where('name', $key));
        }])->get()->pluck('specifications')->flatten()->pluck('value')->unique()->sort()->values()->all();
    }

    public function isFilterChecked(string $key, string $value): bool
    {
        if (!isset($this->filters[$key])) {
            return false;
        }

        return in_array($value, $this->filters[$key]);
    }
}
