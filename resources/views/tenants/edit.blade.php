<x-form :action="route('tenant.update', [
    'tenant' => tenant('tenant_id'),
    'selectedTenant' => $tenant->tenant_id
    ])" put upload enctype="multipart/form-data">
    <div class="row">
        <x-input.text required name="company_name" :value="$tenant->company_name"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="company_phone" data-mask="(000)000-0000" class="input-mask"
                      :value="$tenant->company_phone"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="tenant_id" :value="$tenant->tenant_id"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                      readonly/>
        <x-input.text required name="created_date"
                      :value="$tenant->created_at->format('m/d/Y H:i A')"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" readonly/>
        <x-input.text required name="address" :value="$tenant->address"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="city" :value="$tenant->city"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="state" :value="$tenant->state"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="zip" :value="$tenant->zip"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
		@if($tenant->tenant_id == 'host')
			<x-select required name="account_status" id="account_status" label="Account Status"
					  container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" disabled >
				@foreach (\App\Models\Tenant::$status as $value => $label)
					<option value="{{ $value }}" @if ($tenant->account_status == $value) selected @endif>
						{{ $label }}</option>
				@endforeach
			</x-select>
		@else
			<x-select required name="account_status" id="account_status" label="Account Status"
					  container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				@foreach (\App\Models\Tenant::$status as $value => $label)
					<option value="{{ $value }}" @if ($tenant->account_status == $value) selected @endif>
						{{ $label }}</option>
				@endforeach
			</x-select>
		@endif

        <x-input.textarea name="message" rows="1" data-toggle="autosize" label="Account Status Message"
                          container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                          :caption="__('This textarea will autosize while you type')">
            {{ $tenant->message }}
        </x-input.textarea>

        @if (user()->account_type == 1 && count($primaryContacts) > 0)
            <x-select name="primary_contact" label="Primary Contact" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                @foreach ($primaryContacts as $value => $label)
                    <option value="{{ $value }}" @if ($value == $tenant->primary_contact) selected @endif>{{ $label }}</option>
                @endforeach
            </x-select>
        @endif

        <div class="d-flex align-items-center pl-4 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <x-input.checkbox
                name="manage_news_posts"
                id="manage_news_posts"
                label="Can Manage News Feeds"
                value="1"
                :current="$tenant->manage_news_posts"
                :checked="$tenant->manage_news_posts == 1 ? true : false"
            />
        </div>

        <div class="d-flex align-items-center col-xs-12 col-sm-12 col-md-6 col-lg-6 pl-4">
            <x-input.checkbox
                :disabled="!$isEmailExist"
                name="require_two_factor_authentication"
                id="require_two_factor_authentication"
                label="Require Two-Factor Authentication"
                value="1"
                :current="$tenant->require_two_factor_authentication"
                :checked="$tenant->require_two_factor_authentication == 1 ? true : false"
                :noError="!$isEmailExist"
                :error="__('Configure email to enable this setting')"

            />
        </div>

        @if (user()->account_type == \App\Models\User::INTERNAL_TENANT_ADMIN)
            @if($tenant->tenant_id <> 'host')
            <x-select required
                      name="branding_level"
                      label="Branding Level"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
            >
                @foreach (\App\Models\Tenant::BRANDING_LEVEL as $value => $label)
                    <option
                        value="{{ $value }}"
                        @if ($tenant->branding_level == $value) selected @endif
                    >
                        {{ $label }}
                    </option>
                @endforeach
            </x-select>
            @endif

            <x-select id="select-tenant"
                required name="authentication_service"
                label="Authentication Service"
                container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                :caption="$tenant->tenant_id == tenant('tenant_id') ? __('Changing the authentication service will log you out of the application.') : ''"
            >
                @foreach (\App\Models\Tenant::AUTH_SERVICES as $value => $label)
                    <option
                        value="{{ $value }}"
                        @if ($tenant->authentication_service == $value) selected @endif
                    >
                        {{ $label }}
                    </option>
                @endforeach
            </x-select>
        @endif

        <div class="d-flex align-items-center pl-4 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <x-input.checkbox
                name="user_register"
                id="user_register"
                label="Allow User To Register"
                value="1"
                :current="$tenant->user_register"
                :checked="$tenant->user_register == 1 ? true : false"
            />
        </div>

    </div>

    {{-- <div id="okta-session" class="row d-none">
        <x-input.text :value="isset($tenant->oktaInformation) ? $tenant->oktaInformation->destination_url : '' " name="destination_url" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text :value="isset($tenant->oktaInformation) ? $tenant->oktaInformation->issuer_url : '' " name="issuer_url" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text :value="isset($tenant->oktaInformation) ? $tenant->oktaInformation->logout_url : '' " name="logout_url" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <div class="pt-5 pl-2">
            <x-input.checkbox
                :checked="isset($tenant->oktaInformation) ? $tenant->oktaInformation->requires_database_user : '' "
                value="1" id="requires_database_user" name="requires_database_user" label="Requires user on database"
            />
        </div>
        <x-input.file :caption="isset($tenant->oktaInformation) ? explode('/', $tenant?->oktaInformation->certificate_path)[2]: '' " name="certificate_file" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.file :caption="isset($tenant->oktaInformation) ? explode('/', $tenant?->oktaInformation->key_path)[2] : '' " name="key_file" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
    </div> --}}

    <div id="okta-session" class="row d-none">
        <x-input.text :value="isset($tenant->ssoConfiguration) ? $tenant->ssoConfiguration->login_url : '' " name="okta_login_url"  label="Login URL" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text :value="isset($tenant->ssoConfiguration) ? $tenant->ssoConfiguration->issuer_url : '' " name="okta_issuer_url"  label="Issuer URL" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text :value="isset($tenant->ssoConfiguration) ? $tenant->ssoConfiguration->logout_url : '' " name="okta_logout_url" label="Logout URL"  container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <div class="pt-5 pl-2">
            <x-input.checkbox
                :checked="isset($tenant->ssoConfiguration) ? $tenant->ssoConfiguration->autocreate_authenticated_users : '' "
                value="1" id="okta_autocreate_authenticated_users" name="okta_autocreate_authenticated_users"
                label="Auto-create new authenticated users"
            />
        </div>
        <x-input.file :caption="isset($tenant->ssoConfiguration) ? explode('/', $tenant?->ssoConfiguration->certificate_path)[2]: '' " name="okta_certificate_file" id="okta_certificate_file" label="Certificate File" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6 okta-certificate-file"/>
        <x-input.file :caption="isset($tenant->ssoConfiguration) ? explode('/', $tenant?->ssoConfiguration->key_path)[2] : '' " name="okta_key_file" label="Key File" id="okta_key_file" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6 okta-key-file"/>
    </div>

    <div id="aad-session" class="row d-none">
        <x-input.text :value="isset($tenant->ssoConfiguration) ? $tenant->ssoConfiguration->login_url : '' " name="aad_login_url" label="Login URL" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text :value="isset($tenant->ssoConfiguration) ? $tenant->ssoConfiguration->issuer_url : '' " name="aad_issuer_url" label="Azure Application ID" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text :value="isset($tenant->ssoConfiguration) ? $tenant->ssoConfiguration->logout_url : '' " name="aad_logout_url" label="Logout URL" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <div class="pt-5 pl-2">
            <x-input.checkbox
                :checked="isset($tenant->ssoConfiguration) ? $tenant->ssoConfiguration->autocreate_authenticated_users : '' "
                id="aad_autocreate_authenticated_users"
                value="1"  name="aad_autocreate_authenticated_users" label="Auto-create new authenticated users"
            />
        </div>
        <x-input.file :caption="isset($tenant->ssoConfiguration) ? explode('/', $tenant?->ssoConfiguration->certificate_path)[2]: '' "  name="aad_certificate_file" label="Certificate File" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6 aad-certificate-file"/>
        <x-input.file  :caption="isset($tenant->ssoConfiguration) ? explode('/', $tenant?->ssoConfiguration->key_path)[2] : '' " name="aad_key_file" label="Key File " container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6 aad-key-file"/>
    </div>

    <div class="text-right pt-3">
        <x-button type="submit" sm pill>{{ __('Update') }}</x-button>
        <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
    </div>
</x-form>
<script>

$(document).ready(function () {
    const tenantAuthService = '{{ $tenant->authentication_service }}'
    if(tenantAuthService == "sso_okta"){
        $("#okta-session").removeClass("d-none")
        $("#aad-session").addClass("d-none")
    }
    if(tenantAuthService == "sso_aad"){
        $("#aad-session").removeClass("d-none")
        $("#okta-session").addClass("d-none")
    }

    $("#select-tenant").change(async (event) => {
    const selectValue = event.target.value
    if (selectValue != tenantAuthService && tenantAuthService != "ilinx"){

        if(selectValue == "sso_okta"){
            var cfile = $(".okta-certificate-file > .form-text").text("");
            var kfile = $(".okta-key-file > .form-text").text("");
        }

        if(selectValue == "sso_aad"){
            $(".aad-certificate-file > .form-text").text("");
            $(".aad-key-file > .form-text").text("");
        }
    }
    if(selectValue == "sso_okta"){
        $("#okta-session").removeClass("d-none")
        $("#aad-session").addClass("d-none")
        return
    }
    if(selectValue == "sso_aad" ){
        $("#aad-session").removeClass("d-none")
        $("#okta-session").addClass("d-none")
        return
    }
    $("#okta-session").addClass("d-none")
    $("#aad-session").addClass("d-none")
});
});
</script>
