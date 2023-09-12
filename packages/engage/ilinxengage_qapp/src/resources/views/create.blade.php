<x-form id="" :action="route('qapp.store', tenant('tenant_id'))">
    <div class="row">
        <x-input.text required name="title" container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12"/>
        <x-input.text required name="description" container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12"/>
    </div>

    <div class="text-right">
        <x-button type="submit" sm pill id="">{{ __('Save') }}</x-button>
        <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
    </div>
</x-form>
<style>
#checkbox-area {
    align-items: center;
    display: flex;
    padding-left: 10px;
}
</style>




