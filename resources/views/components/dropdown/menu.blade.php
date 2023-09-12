@props(['href'])

@php
    if (!$slot instanceof \Illuminate\Support\HtmlString) {
        $slot = __(Str::replace('_', ' ',  Str::title(Str::snake($slot))) );
    }
@endphp

<a href="{{ $href ?? "" }}" {{ $attributes->class(['dropdown-item']) }}>
    {{ $slot }}
</a>
