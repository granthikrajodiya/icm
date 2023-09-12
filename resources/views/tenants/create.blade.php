<x-form id="frm_tenant" :action="route('tenant.store', tenant('tenant_id'))" enctype="multipart/form-data">
    <div class="row">
        <x-input.text required name="tenant_id"
                      label="Unique Tenant Identifier (no spaces, punctuation, or special characters)"
                      class="tenant_unique_id"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
        />
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <p class="tenant_note">
                {{ __('Consider using the email domain of the primary administrative user for the tenant Id. For example, if the admin email is johndoe@acmecompany.com an appropriate tenant Id would be "acmecompany"') }}
            </p>
        </div>
        <x-input.text required name="company_name" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="company_phone" data-mask="(000)000-0000" class="input-mask" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="address" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="city" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="state" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="zip" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-select required name="account_status" label="Account Status"
                  container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            @foreach (\App\Models\Tenant::$status as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </x-select>
        <x-input.textarea name="message" rows="1" data-toggle="autosize" label="Account Status Message"
                          container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                          :caption="__('This textarea will autosize while you type')"/>
        <div class="col-12 py-0">
            <h6>{{ __('Administrative User Account') }}</h6>
        </div>
        <x-input.text required name="name" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="username" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="email" label="Email Address" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>

        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <label class="form-control-label" for="password">{{ __('Password') }}</label>
                <div class="input-group input-group-merge">
                    <input id="password" type="password" class="form-control" name="password" required/>
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <a href="javascript:void(0)" data-toggle="password-text" data-target="#password">
                                <i class="fas fa-eye"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="invalid-feedback d-none" id="password-invalid"></div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="form-group">
                <div class="form-group">
                    <label class="form-control-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <div class="input-group input-group-merge">
                        <input id="password_confirmation" type="password" class="form-control"
                               name="password_confirmation" required/>
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <a href="javascript:void(0)" data-toggle="password-text"
                                   data-target="#password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                    <div class="invalid-feedback d-none" id="password_confirmation-invalid"></div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center pl-4 col-xs-12 col-sm-12 col-md-3 col-lg-3">
            <x-input.checkbox
                name="manage_news_posts"
                id="manage_news_posts"
                label="Can Manage News Feeds"
                default="false"
                value="1"
            />
        </div>

        @if (\App\Models\MailSetting::exists())
            <div class="d-flex align-items-center pl-4 col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <x-input.checkbox
                    name="require_two_factor_authentication"
                    id="require_two_factor_authentication"
                    label="Require Two-Factor Authentication"
                    value="1"
                />
            </div>
        @endif

        <x-select required
                  name="branding_level"
                  label="Branding Level"
                  container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
        >
            @foreach (\App\Models\Tenant::BRANDING_LEVEL as $value => $label)
                <option value="{{ $value }}" >
                    {{ $label }}
                </option>
            @endforeach
        </x-select>

        <x-select id="select-tenant"
                  required
                  name="authentication_service"
                  label="Authentication Service"
                  container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
        >
            @foreach (\App\Models\Tenant::AUTH_SERVICES as $value => $label)
                <option
                    value="{{ $value }}"
                >
                    {{ $label }}
                </option>
            @endforeach
        </x-select>

        <div class="d-flex align-items-center pl-4 col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <x-input.checkbox
                name="user_register"
                id="user_register"
                label="Allow User To Register"
                default="false"
                value="1"
            />
        </div>

    </div>


    <div id="okta-session" class="row d-none">
        <x-input.text required label="Login URL" name="okta_login_url" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required label="Issuer URL" name="okta_issuer_url" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="okta_logout_url" label="Logout URL" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <div class="pt-5 pl-2">
            <x-input.checkbox
                value="1"  name="okta_autocreate_authenticated_users" label="Auto-create new authenticated users"
            />
        </div>
        <x-input.file required name="okta_certificate_file" label="Certificate File" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.file required name="okta_key_file" label="Key File" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
    </div>

    <div id="aad-session" class="row d-none">
        <x-input.text required name="aad_login_url" label="Login URL" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="aad_issuer_url" label="Azure Application ID" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="aad_logout_url" label="Logout URL" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <div class="pt-5 pl-2">
            <x-input.checkbox
                value="1"  name="aad_autocreate_authenticated_users" label="Auto-create new authenticated users"
            />
        </div>
        <x-input.file required name="aad_certificate_file" label="Certificate File" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.file required name="aad_key_file" label="Key File " container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
    </div>


    <div class="text-right pt-3">
        <x-button type="button" sm pill id="create_tenant">{{ __('Create') }}</x-button>
        <x-button type="button" sm secondary pill data-dismiss="modal">{{ __('Cancel') }}</x-button>
    </div>

</x-form>
<script>
    $("#select-tenant").change(async (event) => {
        const selectValue = event.target.value
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

</script>
