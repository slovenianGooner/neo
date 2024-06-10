@use('App\Models\Product')
@php
    $categories = $page->children()->orderBy('_lft')->get();
@endphp

<x-layout :page-title="$page->title">
    <div x-data="{ mobileFilterDialogOpen: false }">
        <!-- Off-canvas menu for mobile, show/hide based on off-canvas menu state. -->
        <div class="relative z-40 lg:hidden" role="dialog" aria-modal="true" x-cloak>
            <!-- Off-canvas menu backdrop, show/hide based on off-canvas menu state. -->
            <div class="fixed inset-0 bg-black bg-opacity-25"
                 x-show="mobileFilterDialogOpen"
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
            ></div>

            <div class="fixed inset-0 z-40 flex" x-show="mobileFilterDialogOpen">
                <!-- Off-canvas menu, show/hide based on off-canvas menu state. -->
                <div
                    x-show="mobileFilterDialogOpen"
                    x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-6 shadow-xl">
                    <div class="flex items-center justify-between px-4">
                        <h2 class="text-lg font-medium text-gray-900">{{ word('neo.filters') }}</h2>
                        <button type="button"
                                x-on:click="mobileFilterDialogOpen = false"
                                class="relative -mr-2 flex h-10 w-10 items-center justify-center p-2 text-gray-400 hover:text-gray-500">
                            <span class="absolute -inset-0.5"></span>
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Filters -->
                    <form class="mt-4">
                        @if ($categories->count() > 0)
                            <ul role="list" class="px-2 py-3 font-medium text-gray-900">
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ $category->getUrl() }}"
                                           class="block px-2 py-3">{{ $category->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="border-t border-gray-200 pb-4 pt-4" x-data="{ filterOpened: true }">
                            <fieldset>
                                <legend class="w-full px-2">
                                    <!-- Expand/collapse section button -->
                                    <button type="button"
                                            x-on:click="filterOpened = !filterOpened"
                                            class="flex w-full items-center justify-between p-2 text-gray-400 hover:text-gray-500"
                                            aria-controls="filter-section-0" aria-expanded="false">
                                        <span class="text-sm font-medium text-gray-900">Color</span>
                                        <span class="ml-6 flex h-7 items-center">
                                              <svg class="h-5 w-5 transform"
                                                   :class="{ '-rotate-180': filterOpened, 'rotate-0': !filterOpened }"
                                                   viewBox="0 0 20 20" fill="currentColor"
                                                   aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                      d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                      clip-rule="evenodd"/>
                                              </svg>
                                        </span>
                                    </button>
                                </legend>
                                <div class="px-4 pb-2 pt-4" id="filter-section-0" x-show="filterOpened">
                                    <div class="space-y-6">
                                        <div class="flex items-center">
                                            <input id="color-0-mobile" name="color[]" value="white" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-0-mobile" class="ml-3 text-sm text-gray-500">White</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="color-1-mobile" name="color[]" value="beige" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-1-mobile" class="ml-3 text-sm text-gray-500">Beige</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="color-2-mobile" name="color[]" value="blue" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-2-mobile" class="ml-3 text-sm text-gray-500">Blue</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="color-3-mobile" name="color[]" value="brown" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-3-mobile" class="ml-3 text-sm text-gray-500">Brown</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="color-4-mobile" name="color[]" value="green" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-4-mobile" class="ml-3 text-sm text-gray-500">Green</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="color-5-mobile" name="color[]" value="purple" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-5-mobile"
                                                   class="ml-3 text-sm text-gray-500">Purple</label>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <main class="mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
            <div class="border-b border-gray-200 pb-10 pt-24">
                @if ($breadcrumbs = $page->getBreadcrumbsArray(session_locale()) and count($breadcrumbs) > 0)
                    <nav aria-label="Breadcrumb">
                        <ol role="list" class="flex items-center space-x-4 py-4">
                            @foreach($breadcrumbs as $breadcrumb)
                                <li>
                                    <div class="flex items-center">
                                        <a href="{{ $breadcrumb->getUrl() }}"
                                           @if ($loop->last)
                                               aria-current="page"
                                           class="text-sm font-medium text-gray-500 hover:text-gray-600"
                                           @else
                                               class="mr-4 text-sm font-medium text-gray-900"
                                            @endif
                                        >
                                            {{ $breadcrumb->title }}
                                        </a>
                                        @if (!$loop->last)
                                            <svg viewBox="0 0 6 20" aria-hidden="true" class="h-5 w-auto text-gray-300">
                                                <path d="M4.878 4.34H3.551L.27 16.532h1.327l3.281-12.19z"
                                                      fill="currentColor"/>
                                            </svg>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </nav>
                @endif
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">{{ $page->title }}</h1>
                <div class="prose mt-4">
                    {!! $page->body !!}
                </div>
            </div>

            <div class="pb-24 pt-12 lg:grid lg:grid-cols-3 lg:gap-x-8 xl:grid-cols-4">
                <aside>
                    <h2 class="sr-only">{{ word('neo.filters') }}</h2>

                    <!-- Mobile filter dialog toggle, controls the 'mobileFilterDialogOpen' state. -->
                    <button x-on:click="mobileFilterDialogOpen = true" type="button"
                            class="inline-flex items-center lg:hidden">
                        <span class="text-sm font-medium text-gray-700">Filters</span>
                        <svg class="ml-1 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                             aria-hidden="true">
                            <path
                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z"/>
                        </svg>
                    </button>

                    <div class="hidden lg:block">
                        <form class="space-y-10 divide-y divide-gray-200">
                            @if ($categories->count() > 0)
                                <div>
                                    <ul class="space-y-4 text-sm font-medium text-gray-900">
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{ $category->getUrl() }}">{{ $category->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="{{ $categories->count() > 0 ? 'pt-10' : '' }}">
                                <fieldset>
                                    <legend class="block text-sm font-medium text-gray-900">Color</legend>
                                    <div class="space-y-3 pt-6">
                                        <div class="flex items-center">
                                            <input id="color-0" name="color[]" value="white" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-0" class="ml-3 text-sm text-gray-600">White</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="color-1" name="color[]" value="beige" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-1" class="ml-3 text-sm text-gray-600">Beige</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="color-2" name="color[]" value="blue" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-2" class="ml-3 text-sm text-gray-600">Blue</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="color-3" name="color[]" value="brown" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-3" class="ml-3 text-sm text-gray-600">Brown</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="color-4" name="color[]" value="green" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-4" class="ml-3 text-sm text-gray-600">Green</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="color-5" name="color[]" value="purple" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="color-5" class="ml-3 text-sm text-gray-600">Purple</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="pt-10">
                                <fieldset>
                                    <legend class="block text-sm font-medium text-gray-900">Sizes</legend>
                                    <div class="space-y-3 pt-6">
                                        <div class="flex items-center">
                                            <input id="sizes-0" name="sizes[]" value="xs" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="sizes-0" class="ml-3 text-sm text-gray-600">XS</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="sizes-1" name="sizes[]" value="s" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="sizes-1" class="ml-3 text-sm text-gray-600">S</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="sizes-2" name="sizes[]" value="m" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="sizes-2" class="ml-3 text-sm text-gray-600">M</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="sizes-3" name="sizes[]" value="l" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="sizes-3" class="ml-3 text-sm text-gray-600">L</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="sizes-4" name="sizes[]" value="xl" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="sizes-4" class="ml-3 text-sm text-gray-600">XL</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input id="sizes-5" name="sizes[]" value="2xl" type="checkbox"
                                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                            <label for="sizes-5" class="ml-3 text-sm text-gray-600">2XL</label>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </form>
                    </div>
                </aside>

                <section aria-labelledby="product-heading" class="mt-6 lg:col-span-2 lg:mt-0 xl:col-span-3">
                    <h2 id="product-heading" class="sr-only">{{ word('neo.products') }}</h2>

                    <div
                        class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 sm:gap-y-10 lg:gap-x-8 xl:grid-cols-3">
                        @foreach(Product::forCategory($page)->with(['media', 'specifications', 'prices'])->get() as $product)
                            <div
                                class="group relative flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white">
                                <div
                                    class="aspect-h-4 aspect-w-3 bg-gray-200 sm:aspect-none group-hover:opacity-75 sm:h-96">
                                    <img
                                        src="{{ $product->getFirstMediaUrl('thumbnail') }}"
                                        alt="Eight shirts arranged on table in black, olive, grey, blue, white, red, mustard, and green."
                                        class="h-full w-full object-cover object-center sm:h-full sm:w-full">
                                </div>
                                <div class="flex flex-1 flex-col space-y-2 p-4">
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <a href="{{ $product->getUrlWithQueryString() }}">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $product->title }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-500">{{ $product->getExcerpt() }}</p>
                                    <div class="flex flex-1 flex-col justify-end">
                                        @if ($product->getSpecification('color'))
                                            <p class="text-sm italic text-gray-500">
                                                Color: {{ $product->getSpecification('color')->value }}</p>
                                        @endif
                                        @if ($product->getSpecification('size'))
                                            <p class="text-sm italic text-gray-500">
                                                Size: {{ $product->getSpecification('size')->value }}</p>
                                        @endif
                                        @if ($product->getPrice())
                                            <p class="text-sm font-medium text-gray-900">{{ $product->getPrice()->formatted }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </main>
    </div>
</x-layout>
