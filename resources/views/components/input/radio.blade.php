@props([
    'label' => null,
    'labeless' => false,
    'help' => null,
    'noError' => false,
    'caption' => null,
    'id' => null,
    'containerClass' => null,
    'checked' => false,
    'name',
    'value',
])

@php
    $id ??= $name;
    if (!$label) {
        $label = __(Str::replace('_', ' ',  Str::title(Str::snake($name))) );
    }
    $checked = $checked ?? old($name, $current ?? null) == $value;
@endphp

<x-input :wrap="false" :label="$label" :labeless="true" :help="$help" :no-error="$noError" :id="$id" :name="$name" :caption="$caption" :container-class="$containerClass" >
    <div class="custom-control custom-radio">
        <input type="radio" name="{{ $name }}" id="{{ $id }}" class="custom-control-input" value="{{ $value }}" @if ($checked) checked @endif>
        @unless ($labeless)
            <label class="custom-control-label form-control-label" for="{{ $id }}">
                {{ $label }}
            </label>
        @endunless
    </div>
</x-input>
