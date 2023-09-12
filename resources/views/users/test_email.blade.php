<x-form :action="route('test.email.send', tenant('tenant_id'))" id="test_email" class="pl-3 pr-3">

    <x-input.text type="email" name="email" label="E-Mail Address" required/>

    <div class="form-group">
        <input type="hidden" name="mail_driver" value="{{$data['mail_driver']}}"/>
        <input type="hidden" name="mail_host" value="{{$data['mail_host']}}"/>
        <input type="hidden" name="mail_port" value="{{$data['mail_port']}}"/>
        <input type="hidden" name="mail_username" value="{{$data['mail_username']}}"/>
        <input type="hidden" name="mail_password" value="{{$data['mail_password']}}"/>
        <input type="hidden" name="mail_encryption" value="{{$data['mail_encryption']}}"/>
        <input type="hidden" name="mail_from_address" value="{{$data['mail_from_address']}}"/>
        <div class="row">
            <div class="col-6">
                <x-button sm pill>{{ __('Send Test Mail') }}</x-button>
            </div>
            <div class="col-6 text-right pt-2">
                <x-input.label id="email_sanding" for="email_sanding" style="display: none">
                    <i class="fas fa-clock"></i>
                    {{ __('Sending ...') }}
                </x-input.label>
            </div>
        </div>
    </div>
</x-form>
