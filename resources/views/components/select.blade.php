@props([
    'wrap' => true,
    'label' => null,
    'labeless' => false,
    'help' => null,
    'noError' => false,
    'caption' => null,
    'id' => null,
    'containerClass' => null,
    'labelClass' => null,
    'name',
])

@php
   $id ??= $name;
@endphp

<x-input :wrap="$wrap" :label="$label" :labeless="$labeless" :help="$help" :no-error="$noError" :id="$id"
         :name="$name" :caption="$caption" :container-class="$containerClass" :label-class="$labelClass">
    <select name="{{ $name }}" id="{{ $id }}"
            {{ $attributes->class([
                'form-control',
                'is-invalid' => !empty($errors) ? $errors->has($name) : "",
            ])}}>
        {{ $slot }}
    </select>
</x-input>
