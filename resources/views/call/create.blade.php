<x-form :action="route('calls.store', tenant('tenant_id'))">
    <div class="row">
        <x-input.text required name="subject" container-class="col-sm-12 col-md-6 col-lg-6"/>
        <x-select required name="call_type" class="select2" container-class="col-sm-12 col-md-6 col-lg-6">
            <option value="outbound">{{ __('Outbound') }}</option>
            <option value="inbound">{{ __('Inbound') }}</option>
        </x-select>
        <x-input.text required type="date" name="call_date" container-class="col-sm-12 col-md-6 col-lg-6"
                      value="{{ now()->format('Y-m-d') }}"/>
        <x-input.text required type="number" name="duration" help="(in minutes)" min="0"
                      container-class="col-sm-12 col-md-6 col-lg-6"/>
        <x-input.textarea required name="description" label="Call Notes" rows="5"/>
        <input type="hidden" name="batch_id" value="{{ $batchId }}">
    </div>

    <div class="row">
        <div class="col-12 pt-4">
            <x-button sm pill right>{{ __('Create') }}</x-button>
            <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </div>
</x-form>
