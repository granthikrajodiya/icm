<x-form :action="route('discussion.store',tenant('tenant_id'))">
    <input type="hidden" name="batch_id" value="{{ $batchId }}">
    <div class="row">
        <x-input.textarea required name="comment" label="Message" rows="5"/>
    </div>

    <div class="pt-3">
        <x-button type="submit" sm pill right>{{ __('Add') }}</x-button>
        <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
    </div>
</x-form>
