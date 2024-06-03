<x-layout :page-title="$page->title">
    <div class="p-4 mx-auto max-w-7xl flex flex-col gap-4">
        <h1 class="font-bold text-xl">{{ $page->title }}</h1>
        <div class="prose max-w-none">
            {!! $page->body !!}

            {{-- Custom template data, provided by the template --}}
            <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-3 not-prose mb-8">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:col-span-2 lg:gap-8">
                    @foreach($page->template_data['offices'] as $office)
                        <div class="rounded-2xl bg-gray-50 p-10">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">{{ $office['name'] }}</h3>
                            <dl class="mt-3 space-y-1 text-sm leading-6 text-gray-600">
                                <div>
                                    <dt class="sr-only">Email</dt>
                                    <dd><a class="font-semibold text-indigo-600"
                                           href="mailto:{{ $office['email'] }}">{{ $office['email'] }}</a>
                                    </dd>
                                </div>
                                <div class="mt-1">
                                    <dt class="sr-only">Address</dt>
                                    <dd>{{ $office['address'] }}</dd>
                                </div>
                            </dl>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="max-w-2xl">
                <livewire:contact-us-form/>
            </div>
        </div>
    </div>
</x-layout>
