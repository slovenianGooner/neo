@props([
    'type' => 'text',
    'name',
    'error' => false,
    'inputClass' => [
        'block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6',
        'text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600' => !$error,
        'text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500' => $error,
    ]
])

<div {{ $attributes->merge(['class' => 'relative mt-2 rounded-md shadow-sm']) }}>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" @class($inputClass)>

    @if ($error)
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
    @endif
</div>
