<x-form :action="route('user.update', [tenant('tenant_id'), $user->id])" upload id="update_profile">
    <div class="row">
        <x-input.text required name="name" :value="$user->name"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <x-input.text required name="email" :value="$user->email"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" readonly="true"/>
        <x-input.text name="phone" :value="$user->phone" class="input-mask" data-mask="(000)000-0000"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        <div id="checkbox-area">
            <x-input.checkbox
                    name="chat_user"
                    :checked="$user->chat_user == 1 ? true : false"
                    container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                    :value="$user->chat_user"
            />
        </div>
    </div>

    <div class="row">
        @if ($user->account_status != 'pending')
            <x-select required name="account_status" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <option value="active" @if ($user->account_status == 'active') selected @endif>
                    {{ __('Active') }}
                </option>
                <option value="inactive" @if ($user->account_status == 'inactive') selected @endif>
                    {{ __('Inactive') }}
                </option>
            </x-select>
        @else
            <x-input.text name="account_status" value="Pending" readonly disabled
                          container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"/>
        @endif

        <x-input.textarea name="account_status_message"
                          container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">{{ $user->account_status_message }}</x-input.textarea>

    </div>

    @if (user()->account_type == App\Models\User::EXTERNAL_TENANT_ADMIN)
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                <label for="user_account_type" class="form-control-label">
                    Account Type
                </label>
                <select name="account_type" id="user_account_type" class="form-control" required="required"
                {{$user->id == user()->id ? "disabled='true'" : ''}}">
                    @foreach(App\Models\User::EXTERNAL_ACCOUNT_TYPES as $key => $value)
                        <option value="{{ $key }}" @if ($user->account_type == $key) selected @endif>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div id="checkbox-area">
                <x-input.checkbox
                        name="primary_contact" container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                        :checked="tenant('primary_contact') == $user->id"
                        :disabled="$user->account_type == 0 ? 'true' : 'false'"
                />
            </div>
        </div>

    @elseif (user()->account_type == App\Models\User::INTERNAL_TENANT_ADMIN)
        <div class="row" >
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                <label for="user_account_type" class="form-control-label">
                    Account Type
                </label>
                <select name="account_type" id="user_account_type" class="form-control" required="required"
                {{$user->id == user()->id ? "disabled='true'" : ''}}">
                    @if ($user->account_type == App\Models\User::INTERNAL_TENANT_ADMIN ||
                        $user->account_type ==  App\Models\User::INTERNAL_TENANT_USER )
                        @foreach(App\Models\User::INTERNAL_ACCOUNT_TYPES as $key => $value)
                            <option value="{{ $key }}" @if ($user->account_type == $key) selected @endif>
                                {{ $value }}
                            </option>
                        @endforeach
                    @elseif ($user->account_type == App\Models\User::EXTERNAL_TENANT_USER ||
                                $user->account_type ==  App\Models\User::EXTERNAL_TENANT_ADMIN)
                            @foreach(App\Models\User::EXTERNAL_ACCOUNT_TYPES as $key => $value)
                                <option value="{{ $key }}" @if ($user->account_type == $key) selected @endif>
                                    {{ $value }}
                                </option>
                            @endforeach
                    @endif
                </select>
            </div>
            @if($tenant->authentication_service == \App\Models\Tenant::AUTH_SERVICE_ILINX)
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                <div class="pt-4 mt-2">
                    <x-form :action="route('user.update', [tenant('tenant_id'), $user->id])" upload id="reset-password"></x-form>
                    <a role="button" class="btn btn-sm btn-primary" id="reset_button" href="{{ route('password.reset.adminform', [tenant('tenant_id'), $user->id]) }}" target="_blank" data-saferedirecturl="{{ route('password.reset.adminform', [tenant('tenant_id'), $user->id]) }}">
                        <span class="btn-inner--text">{{ __('Reset password') }}</span>
                        <i class="fas fa-key"></i>
                    </a>
                </div>
            </div>
            @endif
        </div>
    @endif
    <input type="hidden" name="current_account_type" id="current_account_type" value="{{$user->account_type}}">
    <input type="hidden" name="selected_user_id" id="selected_user_id" value="{{$user->id}}">
    <input type="hidden" name="current_user_id" id="current_user_id" value="{{user()->id}}">
    <input type="hidden" name="selected_tenant_id" id="selected_tenant_id" value="{{$user->tenant_id}}">


    <div class="row">
        <x-input.text required name="last_login"
                      :value="isset($user->last_login_at) && !empty($user->last_login_at) ? Utility::getDateFormatted($user->last_login_at, true) : ''"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" readonly="true"/>
        <x-input.text required name="created_date" :value="Utility::getDateFormatted($user->created_at, true)"
                      container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" readonly="true"/>
    </div>

    <div class="text-right">
        <x-button type="button" id="btn_edit_user" sm pill>
         {{ __('Save') }}
        </x-button>
    </div>
</x-form>

<style>
    #checkbox-area {
        align-items: center;
        display: flex;
        padding-left: 10px;
    }
</style>
