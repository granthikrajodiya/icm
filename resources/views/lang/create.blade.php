<x-form :action="route('lang.store')" class="pl-3 pr-3">
    <x-input.text required name="code" label="Language Code" placeholder="{{ __('Language Code') }}"/>
    <div class="form-group">
        <x-button sm pill>{{ __('Create') }}</x-button>
    </div>
</x-form>
