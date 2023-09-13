<x-form :action="route('qapp.delete',[tenant('tenant_id'), $qapp->id])" enctype="multipart/form-data">
    <div class="row">
            <p>{{ __('This action can not be undone. Do you want to continue?') }}</p>

        <div class="col-md-12">
            <x-input.checkbox name="data_delete" id="data_delete" label="Delete associated app data also?" default="false" value="1" />
        </div>
    </div>

    <div class="text-right pt-3">
        <x-button type="submit" sm pill id="propertiesSaveForm">{{ __('Yes') }}</x-button>
        <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
    </div>

</x-form>
