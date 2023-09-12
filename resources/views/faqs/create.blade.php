<x-form :action="route('faq.store', tenant('tenant_id'))">
    <div class="row">
        <x-input.text required name="title"/>
        <x-input.textarea required name="detail" class="summernote-simple"/>
    </div>

    <div class="pt-3">
        <x-button sm pill right>{{ __('Create') }}</x-button>
        <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
    </div>
</x-form>
