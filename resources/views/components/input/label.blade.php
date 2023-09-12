@props([
    'for' => null
])

<label for="{{ $for }}" {{ $attributes->class(['form-control-label']) }}>
    {{ $slot }}
</label>
