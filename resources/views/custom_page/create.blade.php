<x-form :action="route('CustomPages.store', tenant('tenant_id'))">
    <div class="row">
        <x-input.text required name="title" container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12"/>
        <x-input.textarea class="summernote-simple" name="detail"
                          container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12"/>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <x-button sm pill>{{ __('Save') }}</x-button>
                <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
            </div>
        </div>
    </div>
</x-form>
