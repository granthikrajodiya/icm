<x-layouts.app
    title="{{__('Account settings')}}"
    header="{{__('Account settings')}}"
>
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card">
                <div class="list-group list-group-flush" id="tabs">
                    <div data-href="#tabs-1" class="list-group-item text-primary">
                        <div class="media">
                            <i class="fas fa-user"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1">{{ __('Basic') }}</a>
                                <p class="mb-0 text-sm">{{ __('Basic account information') }}</p>
                            </div>
                        </div>
                    </div>
                    @can('userUpdatePassword', auth()->user())
                        <div data-href="#tabs-2" class="list-group-item">
                            <div class="media">
                                <i class="fas fa-lock"></i>
                                <div class="media-body ml-3">
                                    <a href="#" class="stretched-link h6 mb-1">{{ __('Security') }}</a>
                                    <p class="mb-0 text-sm">{{ __('Password management') }}</p>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            <div class="card bg-gradient-warning hover-shadow-lg border-0">
                <div class="card-body py-3">
                    <div class="row row-grid align-items-center">
                        <div class="col-lg-8">
                            <div class="media align-items-center">
                                <a href="#" class="avatar avatar-lg rounded-circle mr-3">
                                    <img class="avatar avatar-lg" {{ $user->img_avatar }}>
                                </a>
                                <div class="media-body">
                                    <h5 class="text-white mb-0">{{ $user->name }}</h5>
                                    <div>
                                        <x-form :action="route('update.profile', tenant('tenant_id'))"
                                                id="update_avatar" upload>
                                            <input type="file" name="avatar" id="avatar"
                                                   class="custom-input-file custom-input-file-link"
                                                   data-multiple-caption="{count} files selected" multiple/>
                                            <label for="avatar">
                                                <span class="text-white">{{__('Change avatar')}}</span>
                                            </label>
                                        </x-form>

                                        @if (!empty(user()->account_status_message))
                                            <span class="text-white text-sm font-weight-bold">
                                                {{ __('Status : ') . user()->account_status_message }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tabs-1" class="tabs-card">
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0">{{ __('Profile Setting') }}</h5>
                    </div>
                    <div class="card-body">
                        <x-form :action="route('update.profile', tenant('tenant_id'))" id="update_profile">
                            <div class="row">
                                <x-input.text required name="name" :value="$user->name" container-class="col-md-6"/>
                                <x-input.text required name="email" :value="$user->email" container-class="col-md-6" disabled/>
                                <x-input.text required name="created_date" label="Account Type" :value="$user->account_type_name" container-class="col-md-6" readonly/>
                                <x-input.text required name="created_date" label="Account Created Date" :value="$user->created_at->format('m/d/Y')" container-class="col-md-6" readonly/>

                            </div>
                            <div class="row">
                                <x-input.text name="phone" :value="$user->phone" class="input-mask" data-mask="(000)000-0000" container-class="col-md-6"/>
                            </div>
                            <div class="row">
                                <x-select required name="communication_channel" :label="__('Preferred Communication channel')" container-class="col-md-6">
                                    <option value="email" @if ($user->communication_channel == 'email') selected @endif>
                                        {{ __('Email') }}
                                    </option>
                                    <option value="phone" @if ($user->communication_channel == 'phone') selected @endif>
                                        {{ __('Phone') }}
                                    </option>
                                    <option value="text" @if ($user->communication_channel == 'text') selected @endif>
                                        {{ __('Text') }}
                                    </option>
                                </x-select>
                                <x-input.text
                                    id="input-texting-number"
                                    name="texting_number"
                                    label="{{ __('Texting Number') }}"
                                    :value="$user->texting_number"
                                    container-class="col-md-6 {{ $user->communication_channel === 'text' ? '' : 'd-none' }} preferred_communication_channel_text_input"
                                />
                            </div>
                            <div class="text-right">
                                <input type="hidden" name="from" value="profile">
                                <x-button type="submit" sm pill>{{ __('Save changes') }}</x-button>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
            <div id="tabs-2" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0">{{ __('Security Setting') }}</h5>
                    </div>
                    <div class="card-body">
                        <x-form id="update_password" :action="route('update.profile', tenant('tenant_id'))">
                            <div class="row">
                                <x-input.text required type="password" name="old_password"
                                              label="Old Password" :placeholder="__('Enter your old password')"
                                              container-class="col-md-6"/>
                                <x-input.text required type="password" name="new_password"
                                              label="New Password" :placeholder="__('Enter your new password')"
                                              container-class="col-md-6"/>
                                <x-input.text required type="password" name="confirm_password"
                                              label="Confirm Password" container-class="col-md-6"
                                              placeholder="{{ __('Enter your confirm password') }}"/>
                            </div>
                            <div class="text-right">
                                <input type="hidden" name="from" value="password">
                                <x-button type="submit" sm pill>{{ __('Save changes') }}</x-button>
                            </div>
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('theme-script')
        <script src="{{ asset('assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
        <script src="{{asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js')}}"></script>
    @endpush
    @push('script')
        <script>
            $(document).ready(function () {
                $('.list-group-item').on('click', function () {
                    var href = $(this).attr('data-href');
                    $('.tabs-card').addClass('d-none');
                    $(href).removeClass('d-none');
                    $('#tabs .list-group-item').removeClass('text-primary');
                    $(this).addClass('text-primary');
                });
            });
            document.getElementById("avatar").onchange = function () {
                document.getElementById("update_avatar").submit();
            };
            $(document).on('change', '#communication_channel', function () {
                if ($(this).val() == 'text') {
                    $('.preferred_communication_channel_text_input').removeClass('d-none');
                    $('#input-texting-number').attr('required', true);
                } else {
                    $('.preferred_communication_channel_text_input').addClass('d-none');
                    $('#input-texting-number').attr('required', false);
                }
            });
        </script>
    @endpush

</x-layouts.app>
