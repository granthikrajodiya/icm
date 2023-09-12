@props([
    'id' => null,
    'class' => null
])
<button type="{{ $type }}" {{ $attributes->class($class) }} id="{{ $id }}">
    {{ $slot }}
</button>
