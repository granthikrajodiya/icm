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
    'rows' => 2,
    'name',
])

@php
    $id ??= $name;
    $value = old($name, $slot ?? null);
@endphp

<x-input :wrap="$wrap" :label="$label" :labeless="$labeless" :help="$help" :no-error="$noError" :id="$id"
         :name="$name" :caption="$caption" :container-class="$containerClass" :label-class="$labelClass">
    <textarea name="{{ $name }}" id="{{ $id }}" @if ($rows) rows="{{ $rows }}" @endif {{ $attributes->class([ 'form-control', 'is-invalid' => !empty($errors) ? $errors->has($name) : "", ])}}>{{ $value }}</textarea>

</x-input>
