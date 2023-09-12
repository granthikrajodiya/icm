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
    'value' => null,
    'disabled' => false,
    'error' => '',
])

@php
$id ??= $name;
if (!$label) {
    $label = __(Str::replace('_', ' ', Str::title(Str::snake($name))));
}
$checked = $checked ?? old($name, $current ?? null) == $value;
@endphp

<x-input :wrap="false" :label="$label" :labeless="true" :help="$help" :no-error="$noError"
    :id="'checkbox_input_area_'.$id" :name="'checkbox_input_area_'.$name" :caption="$caption"
    :container-class="$containerClass">
    <div class="row custom-control custom-switch">
        <input type="checkbox" name="{{ $name }}" id="{{ $id }}" class="custom-control-input col-xs-12 col-sm-12 col-md-6 col-lg-6"
            value="{{ $value }}" @if ($disabled) disabled @endif @if ($checked) checked @endif>
        @unless($labeless)
            <label class="custom-control-label form-control-label" for="{{ $id }}">
                {{ $label }}
            </label>
        @endunless

        @if($noError)
            <small class="form-text text-muted mb-2 mt-0 font-italic">
                {{ $error }}
            </small>
        @endif
    </div>
</x-input>
