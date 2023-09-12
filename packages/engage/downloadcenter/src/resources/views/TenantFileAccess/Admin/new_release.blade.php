<x-form :action="route('newRelease.store', tenant('tenant_id'))">
    <div class="row">
        <x-input.text required name="release_name" container-class="col-sm-12 col-md-12 col-lg-12"/>
        <x-input.text required name="product_name" container-class="col-sm-12 col-md-12 col-lg-12" label="{{__('Product Name')}} ({{('an initial product name is required')}})"/>
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
        $('input[name=tenant]').val($('#tenant').val());
    });
</script>
