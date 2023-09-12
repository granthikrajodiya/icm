<x-form id="frm_create_user" :action="route('user.store', tenant('tenant_id'))">
    <div class="row">
        <x-input.text required name="name" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="username" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <small class="pl-3">{{ __('Note : no spaces, punctuation, or special characters') }}</small>
    </div>
    <div class="row">
        <x-input.text required name="email" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <div id="checkbox-area">
            <x-input.checkbox name="send_invitation" label="Send invitation email when account is activated" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6 my-5"/>
        </div>
    </div>
    <div class="row">
        <x-input.text name="phone" class="input-mask" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" data-mask="(000)000-0000"/>
        <x-select required name="account_type" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <option value="4">{{ __('Admin') }}</option>
            <option value="0">{{ __('User') }}</option>
        </x-select>
    </div>
    <div class="text-right">
        <x-button type="button" sm pill id="create_user">{{ __('Save') }}</x-button>
    </div>
</x-form>
<style>
#checkbox-area {
    align-items: center;
    display: flex;
    padding-left: 10px;
}
</style>
