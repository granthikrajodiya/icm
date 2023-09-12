<x-form :action="route('release-product.update', [tenant('tenant_id'),$product->id])" put>
    <div class="row">
        <x-input.text required name="release_name" container-class="col-sm-12 col-md-12 col-lg-12" :value="$product->product_version" label="{{__('Release Name')}}"/>

        <x-input.text required name="product_name" container-class="col-sm-12 col-md-12 col-lg-12" :value="$product->product_name" label="{{__('Product Name')}}"/>
        <input type="hidden" name="tenant" class="col-sm-12 col-md-12 col-lg-12" />

    </div>
    <div class="row">
        <div class="col-12 pt-4">
            <x-button sm pill right>{{ __('Update') }}</x-button>
            <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </div>
</x-form>

<script type="text/javascript">
    $( document ).ready(function() {
        $('input[name=tenant]').val($('#tenant').val());
    });
</script>
