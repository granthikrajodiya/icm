<x-form :action="route('calls.update', [tenant('tenant_id'), 'call' => $call->id])" put>
    <div class="row">
        <x-input.text required name="subject" :value="$call->subject" container-class="col-sm-12 col-md-6 col-lg-6"/>
        <x-select required name="call_type" class="select2" container-class="col-sm-12 col-md-6 col-lg-6">
            <option value="outbound" @if ($call?->call_type == 'outbound') selected @endif>{{ __('Outbound') }}</option>
            <option value="inbound" @if ($call?->call_type == 'inbound') selected @endif>{{ __('Inbound') }}</option>
        </x-select>
        <x-input.text required type="date" name="call_date" value="{{ !empty($call->call_date) ? Utility::getDateFormatted($call->call_date, false, 'Y-m-d') : '' }}"
                      container-class="col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required type="number" name="duration" help="(in minutes)" min="0"
                      container-class="col-sm-12 col-md-6 col-lg-6" :value="$call->duration"/>
        <x-input.textarea required name="description" label="Call Notes" rows="5">
            {{ $call->description }}
        </x-input.textarea>

    </div>

    <div class="row">
        <div class="col-12 pt-4">
            <x-button sm pill right>{{ __('Update') }}</x-button>
            <x-button type="button" sm secondary pill right data-dismiss="modal">{{ __('Cancel') }}</x-button>
        </div>
    </div>
</x-form>
