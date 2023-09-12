<x-form :action="route('faq.update', [tenant('tenant_id'), $faq->id])" put>
    <div class="row">
        <x-input.text required name="title" :value="$faq->title"/>
        <x-input.textarea required name="detail" class="summernote-simple">
            {!! $faq->detail !!}
        </x-input.textarea>
    </div>

    <div class="pt-3">
        <x-button sm pill right>{{ __('Update') }}</x-button>
        <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
    </div>
</x-form>
