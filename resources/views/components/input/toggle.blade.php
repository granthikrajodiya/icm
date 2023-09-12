@props([
    'size' => null,
    'sm' => null,
    'xs' => null,
    'md' => null,
    'lg' => null,
    'info' => null,
    'warning' => null,
    'danger' => null,
    'success' => null,
    'secondary' => null,
    'primary' => null,
    'color' => null,
    'id' => null,
    'label' => null,
    'labeless' => false,
    'current' => null,
    'name',
    'value'
])

@php
    $id ??= $name;
    if (!$label) {
        $label = __(Str::replace('_', ' ',  Str::title(Str::snake($name))));
    }
    $checked = old($name, $current ?? null) == $value;

    $size = $size ?? 'md';
    if ($xs) $size = 'xs';
    if ($sm) $size = 'sm';
    if ($lg) $size = 'lg';

    $color = $color ?? 'primary';
    if ($info) $color = 'info';
    if ($warning) $color = 'warning';
    if ($danger) $color = 'danger';
    if ($success) $color = 'success';
    if ($secondary) $color = 'secondary';
    if ($primary) $color = 'primary';
@endphp

<label {{ $attributes->class([
    'btn',
    'active' => $checked,

    // sizes
    'btn-xs' => $size === 'xs',
    'btn-sm' => $size === 'sm',
    'btn-lg' => $size === 'lg',

    // colors
    'btn-info' => $color === 'info',
    'btn-warning' => $color === 'warning',
    'btn-danger' => $color === 'danger',
    'btn-success' => $color === 'success',
    'btn-secondary' => $color === 'secondary',
    'btn-primary' => $color === 'primary',
]) }}>
    <input type="radio" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" @if ($checked) checked @endif>
    @unless($labeless)
        {{ $label }}
    @endif
</label>
