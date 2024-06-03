@props([
    'error' => false
])

@if ($error)
    <p class="mt-2 text-sm text-red-600">{{ $error[0] }}</p>
@endif
