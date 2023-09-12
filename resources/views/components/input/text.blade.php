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
    'value' => null,
    'type' => 'text',
    'name',
])

@php
    $id ??= $name;
    $value = old($name, $value ?? null);
@endphp

<x-input :wrap="$wrap" :label="$label" :labeless="$labeless" :help="$help" :no-error="$noError" :id="$id"
         :name="$name" :caption="$caption" :container-class="$containerClass" :label-class="$labelClass">
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" @isset($maxlength) maxlength="{{ $maxlength }}" @endisset
        {{ $attributes->class([
            'form-control',
            'invalid-feedback' => !empty($errors) ? $errors->has($name) : "",
        ]) }} />
</x-input>
