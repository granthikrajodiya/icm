<x-form :action="route('CustomPages.update', [tenant('tenant_id'), $customPage->id])" put>
    <div class="row">
        <x-input.text required name="title" :value="$customPage->title"
                      container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12"/>
        <x-input.textarea class="summernote-simple" name="detail"
                          container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            {!! $customPage->detail !!}
        </x-input.textarea>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <x-button sm pill>{{ __('Update') }}</x-button>
                <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
            </div>
        </div>
    </div>
</x-form>
