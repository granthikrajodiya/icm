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
    'withoutLineBreak' => false
])

@php
    $id ??= $name;
@endphp

<x-input :wrap="$wrap" :label="$label" :labeless="$labeless" :help="$help" :no-error="$noError" :id="$id"
         :name="$name" :caption="$caption" :container-class="$containerClass" :label-class="$labelClass">

    @unless ($withoutLineBreak)
    <br>
    @endunless
    <div data-toggle="buttons" {{ $attributes->class([' btn-group-toggle']) }}>
        {{ $slot }}
    </div>
</x-input>
