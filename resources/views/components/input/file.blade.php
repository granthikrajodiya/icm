@props([
    'wrap' => true,
    'label' => null,
    'labeless' => false,
    'help' => null,
    'noError' => false,
    'caption' => null,
    'id' => null,
    'containerClass' => null,
    'name',
])

@php
    $id ??= $name;
@endphp

<x-input :wrap="$wrap" :label="$label" :labeless="$labeless" :help="$help" :no-error="$noError" :id="$id" :name="$name" :caption="$caption" :container-class="$containerClass">
    <input type="file" name="{{ $name }}" id="{{ $id }}" class="custom-input-file"/>
    <label for="{{ $id }}">
        <i class="fa fa-upload"></i>
        <span>{{ __('Choose a file…') }}</span>
    </label>
</x-input>
