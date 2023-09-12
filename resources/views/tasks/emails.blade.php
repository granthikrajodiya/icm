<x-form :action="route('emails.store', tenant('tenant_id'))">

    <input type="hidden" name="batch_id" value="{{ $batchId }}"/>

    <div class="row">
        <x-input.text required name="to" label="Mail To" container-class="col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="subject" container-class="col-sm-12 col-md-6 col-lg-6"/>
        <x-input.textarea required class="summernote-simple" name="description"
                          container-class="col-12"/>
    </div>

    <div class="text-right pt-3">
        <x-button type="submit" sm pill>{{ __('Create') }}</x-button>
        <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
    </div>

</x-form>
