@props(['id', 'active' => false])

@php
    if (!$slot instanceof \Illuminate\Support\HtmlString) {
        $slot = __(Str::replace('_', ' ',  Str::title(Str::snake($id))) );
    }
@endphp

<li class="nav-item">
    <a href="#{{ $id }}" id="{{ $id }}-tab" {{ $attributes->class([
            'nav-link',
            'active' => $active
        ]) }} data-toggle="tab" role="tab" aria-selected="{{ $active ? 'true' : 'false' }}">
        {{ $slot }}
    </a>
</li>
