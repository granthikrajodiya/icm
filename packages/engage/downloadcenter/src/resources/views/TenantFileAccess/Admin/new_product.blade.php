<x-form :action="route('newProduct.store', tenant('tenant_id'))">
    <div class="row">
        <x-select name="release" container-class="col-sm-12 col-md-12 col-lg-12" required id="create_release" label="{{__('Release Name')}}">
            @foreach ($releases as $value => $label)
                <option value="{{ $label }}">{{ $label }}</option>
            @endforeach
        </x-select>
        <input type="hidden" name="release_name" id="release_input"/>
        <x-input.text required name="product_name" container-class="col-sm-12 col-md-12 col-lg-12" label="{{__('New Product')}}"/>
        <input type="hidden" name="tenant" class="col-sm-12 col-md-12 col-lg-12" />

    </div>
    <div class="row">
        <div class="col-12 pt-4">
            <x-button sm pill right>{{ __('Save') }}</x-button>
            <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </div>
</x-form>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#create_release').val($('#release').val());
        $('#create_release').prop('disabled',true);
        $('#release_input').val($('#release').val());
        $('input[name=tenant]').val($('#tenant').val());
    })
</script>
