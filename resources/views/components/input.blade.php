@props([
    'wrap' => true,
    'label',
    'labeless' => '',
    'noError' => false,
    'id',
    'caption',
    'containerClass' => null,
    'labelClass' =>'',
    'name',
])

@php
    if (!$label) {
        $label = __(Str::replace('_', ' ',  Str::title(Str::snake($name))));
    }
@endphp

@if ($wrap) <div {{ $attributes->class([
    'form-group',
    'col-12' => !\Illuminate\Support\Str::contains($containerClass, 'col-')
])->merge(['class' => $containerClass]) }}> @endif
    @unless ($labeless)
        <x-input.label :for="$id" :class="$labelClass">
            {{ $label }}
        </x-input.label>
    @endunless
    @isset ($help)
        <small class="font-weight-bold">
            {{ __($help) }}
        </small>
    @endisset

    {{ $slot }}

    @if ($caption)
        <small class="form-text text-muted mb-2 mt-0">
            {{ $caption }}
        </small>
    @endif

    @unless ($noError)
        @error ($name)
            <div id="{{ $id }}" class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    @endunless
@if ($wrap) </div> @endif
