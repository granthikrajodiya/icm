<x-layouts.app title="{{ __('Site Settings') }}">
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card">
                <div class="list-group list-group-flush" id="tabs">
                    @if (user()->account_type == 1)
                        <div data-href="#tabs-site-setting" class="list-group-item list-group-list text-primary">
                            <div class="media">
                                <i class="fas fa-cog pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        {{ __('Site Settings') }}
                                    </a>
                                    <p class="mb-0 text-sm">{{ __('Basic application configuration settings') }}</p>
                                </div>
                            </div>
                        </div>
                        <div data-href="#tabs-tenant-layout" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-building pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        {{ __('Tenants') }}
                                    </a>
                                    <p class="mb-0 text-sm">{{ __('Manage your tenants') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (user()->account_type == 4)
                        <div data-href="#tabs-site-setting-external-user" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-cog pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        {{ __('Site Settings') }}
                                    </a>
                                    <p class="mb-0 text-sm">{{ __('Basic application configuration settings') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (user()->account_type == 1 || user()->account_type == 4)
                        <div data-href="#tabs-user-layout" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-users pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">{{ __('Users') }}</a>
                                    <p class="mb-0 text-sm">{{ __('Manage user accounts') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (user()->account_type == 1)
                        <div data-href="#tabs-layout-navigation-layout" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-th pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        {{ __('Layout & Navigation Definitions') }}
                                    </a>
                                    <p class="mb-0 text-sm">
                                        {{ __('Define Home page layouts and Navigation elements for your users') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div data-href="#tabs-permission-layout" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-user-lock pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)"
                                        class="stretched-link h6 mb-1">{{ __('Permissions & Features') }}</a>
                                    <p class="mb-0 text-sm">{{ __('Manage group access for internal host users') }}</p>
                                </div>
                            </div>
                        </div>
                        {{-- <div data-href="#tabs-integrations" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-th pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        {{ __('Integrations') }}
                                    </a>
                                    <p class="mb-0 text-sm">{{ __('Manage Integration with extrenal systems') }}</p>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div data-href="#tabs-label-message" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-tags pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        {{ __('Label & Messages') }}
                                    </a>
                                    <p class="mb-0 text-sm">
                                        {{ __('Change the label and user messages displayed within the application') }}
                                    </p>
                                </div>
                            </div>
                        </div> --}}
                        <div data-href="#tabs-mail-setting" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-envelope pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)"
                                        class="stretched-link h6 mb-1">{{ __('Mailer Settings') }}</a>
                                    <p class="mb-0 text-sm">{{ __('Details about your mail setting information') }}</p>
                                </div>
                            </div>
                        </div>
                            {{-- <div data-href="#tabs-pusher-setting" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-comments pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            {{ __('Pusher Settings') }}
                                        </a>
                                        <p class="mb-0 text-sm">
                                            {{ __('Details about your pusher setting information for chat') }}
                                        </p>
                                    </div>
                                </div>
                            </div> --}}
                        <div data-href="#tabs-customPage-setting" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-edit pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        {{ __('Custom Pages') }}
                                    </a>
                                    <p class="mb-0 text-sm">
                                        {{ __('Create and manage custom content for card and pages') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div data-href="#tabs-help-center" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-info-circle pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        {{ __('Help Center Page') }}
                                    </a>
                                    <p class="mb-0 text-sm">{{ __('Details about your Help Center Page setting') }}</p>
                                </div>
                            </div>
                        </div>
                        <div data-href="#tabs-faq" class="list-group-item list-group-list">
                            <div class="media">
                                <i class="fas fa-question pt-1"></i>
                                <div class="media-body ml-3">
                                    <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                        {{ __('FAQ Settings') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if (in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms))
                            <div data-href="#tabs-news-feed" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-newspaper pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            {{ __('News Feeds') }}
                                        </a>
                                        <p class="mb-0 text-sm">{{ __('News and announcements') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        @if (in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms))
                            <div data-href="#tabs-customPage-setting" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-edit pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            {{ __('Custom Pages') }}
                                        </a>
                                        <p class="mb-0 text-sm">
                                            {{ __('Create and manage custom content for card and pages') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (in_array('FAQ_ALL_CONTENT', $userPerms))
                            <div data-href="#tabs-help-center" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-info-circle pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            {{ __('Help Center Page') }}
                                        </a>
                                        <p class="mb-0 text-sm">{{ __('Details about your Help Center Page setting') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div data-href="#tabs-faq" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-question pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            {{ __('FAQ Settings') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms) || tenant()->manage_news_posts)
                            <div data-href="#tabs-news-feed" class="list-group-item list-group-list">
                                <div class="media">
                                    <i class="fas fa-newspaper pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                            {{ __('News Feeds') }}
                                        </a>
                                        <p class="mb-0 text-sm">{{ __('News and announcements') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Add Package Configuration Link --}}
                    @php
                        $packageConfigurations = [];
                        $packageLayout = config('package-layout');
                        if ($packageLayout) {
                            foreach ($packageLayout as $pk => $v) {
                                if (isset($v['configuration']) && !empty($v['configuration'])) {
                                    $packageConfigurations[$pk] = $v['configuration'];
                                }
                            }
                        }
                    @endphp
                        @if ($packageConfigurations)
                            <div class="config-menu-has-child">
                                <div class="media parent-menu">
                                    <i class="fas fa-cog pt-1"></i>
                                    <div class="media-body ml-3">
                                        <a class="h6 mb-1" href="javascript:void(0)">
                                            {{ __('Package Configurations') }}
                                        </a>
                                        <p class="mb-0 text-sm">{{ __('Package Configurations') }}</p>
                                    </div>
                                </div>
                                <div class="config-menu-children">
                                    @foreach ($packageConfigurations as $pk => $v)
                                        @php
                                            $packageConfigurationTemplate = $pk . '::' . $v['template'];
                                        @endphp
                                        @if(\View::exists($packageConfigurationTemplate))
                                            <div data-href="#{{ (isset($v['tab_id']) && !empty($v['tab_id'])) ? $pk . '_' . $v['tab_id']: '' }}" class="list-group-item list-group-list config">
                                                <div class="media">
                                                    {{-- (isset($v['icon']) && !empty($v['icon'])) ? $v['icon']: '' --}}
                                                    <div class="media-body ml-5">
                                                        <a href="javascript:void(0)" class="stretched-link h6 mb-1">
                                                            {{ (isset($v['title']) && !empty($v['title'])) ? $v['title']: '' }}
                                                        </a>
                                                        <p class="mb-0 text-sm">{{ (isset($v['description']) && !empty($v['description'])) ? $v['description']: '' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            {{-- @if (user()->account_type == 1 || user()->account_type == 4)
                <div id="tabs-company-setting" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ __('Company Information') }}</h5>
                        </div>
                        <div class="card-body">
                            <x-form :action="route('settings.store', tenant('tenant_id'))" id="update_setting">
                                <div class="row">
                                    <x-input.text required name="company_name" :value="tenant('company_name')"
                                        container-class="col-md-6" />
                                    <x-input.text required name="company_address" :value="tenant('address')"
                                        container-class="col-md-6" />
                                    <x-input.text required name="company_city" :value="tenant('city')"
                                        container-class="col-md-6" />
                                    <x-input.text required name="company_state" :value="tenant('state')"
                                        container-class="col-md-6" />
                                    <x-input.text required name="company_zip" :value="tenant('zip')"
                                        container-class="col-md-6" />
                                    <x-input.text required name="company_phone" :value="tenant('company_phone')"
                                        data-mask="(000)000-0000" class="input-mask" container-class="col-md-6" />
                                </div>
                                <div class="text-right">
                                    <input type="hidden" name="from" value="company_setting">
                                    <x-button sm pill>{{ __('Save changes') }}</x-button>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
            @endif --}}

            <x-form :action="route('settings.poweredby.destroy', [
                                                            tenant('tenant_id')
                                                        ])" delete
                    id="delete-poweredby">
            </x-form>
            <x-form :action="route('settings.smalllogo.destroy', [
                                                            tenant('tenant_id')
                                                        ])" delete
                    id="delete-smalllogo">
            </x-form>

            @if (user()->account_type == 1)
                <div id="tabs-site-setting" class="tabs-card">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ __('Basic Setting') }}</h5>
                        </div>
                        <div class="card-body">
                            <x-form :action="route('settings.store', tenant('tenant_id'))" id="update_setting" upload>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <x-input.label for="full_logo">{{ __('Logo') }}</x-input.label>
                                            <input type="file" name="full_logo" id="full_logo"
                                                class="custom-input-file" />
                                            <x-input.label for="full_logo">
                                                <i class="fa fa-upload"></i>
                                                <span>{{ __('Choose a file…') }}</span>
                                            </x-input.label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5">
                                        <img alt="logo" src="{{ tenant()?->logo_path }}" class="img_setting" />
                                    </div>
                                    {{-- SMALL LOGO HOST--}}
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <x-input.label for="small_logo">{{ __('Small Logo') }}</x-input.label>
                                            <input type="file" name="small_logo" accept="image/*"
                                                   id="small_logo" class="custom-input-file" />
                                            <x-input.label for="small_logo">
                                                <i class="fa fa-upload"></i>
                                                <span>{{ __('Choose a file…') }}</span>
                                            </x-input.label>
                                        </div>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 pt-4 mt-1">
                                        @if(!is_null(tenant('small_logo')))
                                            <div class="text-left">
                                                <button type="button" class="action-item text-danger px-2"
                                                        data-dismiss="modal"
                                                        data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="document.getElementById('delete-smalllogo').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-xs-11 col-sm-11 col-md-5 col-lg-5 pt-5">
                                        <img src="{{ !is_null(tenant('small_logo')) ? asset(\Storage::url(tenant('small_logo'))) : '' }}"
                                             class="img_setting" />
                                    </div>
                                    {{-- END SMALL LOGO HOST--}}
                                    {{-- POWEREDBY LOGO HOST--}}
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <x-input.label for="poweredby_logo">{{ __('PoweredBy  Logo') }}</x-input.label>
                                            <input type="file" name="poweredby_logo" accept="image/*"
                                                   id="poweredby_logo" class="custom-input-file" />
                                            <x-input.label for="poweredby_logo">
                                                <i class="fa fa-upload"></i>
                                                <span>{{ __('Choose a file…') }}</span>
                                            </x-input.label>
                                        </div>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 pt-4 mt-1">
                                        @if(!is_null(tenant('poweredby_logo')))
                                            <div class="text-left">
                                                <button type="button" class="action-item text-danger px-2"
                                                        data-dismiss="modal"
                                                        data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                        data-confirm-yes="document.getElementById('delete-poweredby').submit();">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-xs-11 col-sm-11 col-md-5 col-lg-5 pt-5">
                                        @if(!is_null(tenant('poweredby_logo')))
                                        <img src="{{ !is_null(tenant('poweredby_logo')) ? asset(\Storage::url(tenant('poweredby_logo'))) : '' }}"
                                             class="img_setting" />
                                        @endif
                                    </div>
                                    {{-- END POWEREDBY LOGO HOST--}}
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <x-input.label for="favicon">{{ __('Favicon') }}</x-input.label>
                                            <input type="file" name="favicon" id="favicon"
                                                class="custom-input-file" />
                                            <x-input.label for="favicon">
                                                <i class="fa fa-upload"></i>
                                                <span>{{ __('Choose a file…') }}</span>
                                            </x-input.label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5">
                                        <img alt="favicon" src="{{ tenant()?->fav_icon_path }}"
                                            class="img_setting" />

                                    </div>
                                    <div class="col-12">
                                        <x-input.toggle-group :wrap="false" name="banner">
                                            <x-input.toggle sm name="banner_type" id="banner_type1" label="Image"
                                                value="image" :current="Utility::getValByName('banner_type')" />
                                            <x-input.toggle sm name="banner_type" id="banner_type2" label="Color"
                                                value="color" :current="Utility::getValByName('banner_type')" />
                                        </x-input.toggle-group>
                                    </div>
                                    <div
                                        class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3 banner_img {{ Utility::getValByName('banner_type') != 'image' ? 'd-none' : '' }}">
                                        <div class="form-group">
                                            <x-input.label for="banner">{{ __('Banner Image') }}</x-input.label>
                                            <input type="file" name="banner" id="banner"
                                                class="custom-input-file" />
                                            <label for="banner">
                                                <i class="fa fa-upload"></i>
                                                <span>{{ __('Choose a file…') }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div
                                        class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5 banner_img {{ Utility::getValByName('banner_type') != 'image' ? 'd-none' : '' }}">
                                        <img alt="banner" src="{{ tenant()?->banner_path }}" class="img_banner" />

                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <x-input.text name="header_text" label="Title Text"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                        placeholder="{{ __('Enter Header Title Text') }}" :value="Utility::getValByName('header_text')" />
                                    <x-input.text name="footer_text" label="Footer Text"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                        placeholder="{{ __('Enter Footer Text') }}" :value="Utility::getValByName('footer_text')" />
                                </div>
                                <hr />
                                <div class="row">
                                    <x-input.text required name="footer_link_1" label="Footer Link Title 1"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                        placeholder="{{ __('Enter Footer Link Title 1') }}" :value="Utility::getValByName('footer_link_1')" />
                                    <x-input.text required name="footer_value_1" label="Footer Link href 1"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                        placeholder="{{ __('Enter Footer Link 1') }}" :value="Utility::getValByName('footer_value_1')" />
                                </div>
                                <div class="row">
                                    <x-input.text required name="footer_link_2" label="Footer Link Title 2"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                        placeholder="{{ __('Enter Footer Link Title 2') }}" :value="Utility::getValByName('footer_link_2')" />
                                    <x-input.text required name="footer_value_2" label="Footer Link href 2"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                        placeholder="{{ __('Enter Footer Link 2') }}" :value="Utility::getValByName('footer_value_2')" />
                                </div>
                                <div class="row">
                                    <x-input.text required name="footer_link_3" label="Footer Link Title 3"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                        placeholder="{{ __('Enter Footer Link Title 3') }}" :value="Utility::getValByName('footer_link_3')" />
                                    <x-input.text required name="footer_value_3" label="Footer Link href 3"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                        placeholder="{{ __('Enter Footer Link 3') }}" :value="Utility::getValByName('footer_value_3')" />
                                    <x-input.text required name="terms_conditions" label="Terms and condition link"
                                        container-class="col-12"
                                        placeholder="{{ __('Enter Terms and condition link') }}" :value="Utility::getValByName('terms_conditions')" />
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 py-2 my-3">
                                        <x-input.checkbox name="show_activities" id="show_activities"
                                            label="Show Activities" :checked="Utility::getValByName('show_activities') == '1' ? true : false" value="true" />
                                    </div>
                                    <x-input.text type="time" required name="day_start"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" :value="Utility::getValByName('day_start')" />
                                    <x-select name="default_theme"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        @foreach ($themes as $value => $label)
                                            <option value="{{ $value }}"
                                                @if (Utility::getValByName('default_theme') == $value) selected @endif>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </x-select>
                                    <x-select name="date_format"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        @foreach ($arrDate as $value => $label)
                                            <option value="{{ $value }}"
                                                @if (Utility::getValByName('date_format') == $value) selected @endif>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </x-select>

                                    @if (user()->account_type == 1)
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <hr>

                                            <x-input.toggle-group name="sidebar_editor" label="Sidebar">
                                                <x-input.toggle name="sidebar_editor_style" id="sidebar_editor_style1"
                                                    label="Background Color" value="bg_color" :current="Utility::getValByName('sidebar_editor_style')" />
                                                <x-input.toggle name="sidebar_editor_style" id="sidebar_editor_style2"
                                                    label="Gradient Color" value="bg_gradient" :current="Utility::getValByName('sidebar_editor_style')" />
                                                <x-input.toggle name="sidebar_editor_style" id="sidebar_editor_style3"
                                                    label="Transparent" value="transparent" :current="Utility::getValByName('sidebar_editor_style')" />
                                            </x-input.toggle-group>

                                            <br><br>

                                            <div
                                                class="sidebar_bg_color {{ Utility::getValByName('sidebar_editor_style') != 'bg_color' ? 'd-none' : '' }}
                                                        col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                <x-input.text type="color" name="sidebar_editor_bg" label="Color"
                                                    :value="Utility::getValByName('sidebar_editor_bg')" />
                                            </div>
                                            <div
                                                class="sidebar_bg_gradiant {{ Utility::getValByName('sidebar_editor_style') != 'bg_gradient' ? 'd-none' : '' }}">
                                                <x-select name="bg_gradient" label="Color">
                                                    @foreach ($arrGradient as $value => $label)
                                                        <option value="{{ $value }}"
                                                            @if (Utility::getValByName('bg_gradient') == $value) selected @endif>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                <x-input.textarea name="sidebar_editor" :wrap="false" labeless
                                                    class="summernote-simple-sidebar clearfix">
                                                    {{ Utility::getValByName('sidebar_editor') }}
                                                </x-input.textarea>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-right">
                                    <input type="hidden" name="from" value="site_setting" />
                                    <x-button type="submit" sm primary pill>{{ __('Save changes') }}</x-button>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
                <div id="tabs-tenant-layout" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header actions-toolbar border-0">
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">{{ __('Tenants') }}</h6>
                                </div>
                                <div class="col text-right">
                                    <div class="actions">
                                        <a href="#"
                                            data-url="{{ route('tenant.create', tenant('tenant_id')) }}"
                                            data-size="xl" data-ajax-popup="true"
                                            data-title="{{ __('Create Tenant') }}" class="action-item">
                                            <i class="fas fa-plus"></i>
                                            <span class="d-sm-inline-block">{{ __('Add') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 px-1 pb-3">
                            <div class="table-responsive" id="">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Tenant ID') }}</th>
                                            <th>{{ __('Primary Contact') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($tenants->count() > 0)
                                            @foreach ($tenants as $tenant)
                                                <tr>
                                                    <td>{{ $tenant->company_name }}</td>
                                                    <td>{{ $tenant->tenant_id }}</td>
                                                    <td>{{ isset($tenant->user->name) && !is_null($tenant->user->name) ? $tenant->user->name : '-' }}
                                                    </td>
                                                    <td>{{ \App\Models\Tenant::$status[$tenant->account_status] }}
                                                    </td>
                                                    <td>
                                                        <div class="actions">
                                                            <a href="#" class="action-item px-2"
                                                                data-url="{{ route('tenant.edit', [
                                                                    'tenant' => tenant('tenant_id'),
                                                                    'selectedTenant' => $tenant->tenant_id,
                                                                ]) }}"
                                                                data-ajax-popup="true" data-size="lg"
                                                                data-title="{{ __('Edit Tenant') }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            {{-- <a href="#" class="action-item text-danger px-2" data-confirm="{{__('Are You Sure?')}}|{{__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-tenant-{{$tenant->tenant_id}}').submit();">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a> --}}
                                                        </div>
                                                        {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['tenant.destroy',[tenant('tenant_id'),$tenant->tenant_id]],'id'=>'delete-tenant-'.$tenant->tenant_id]) !!}
                                                    {!! Form::close() !!} --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th scope="col" colspan="5">
                                                    <h6 class="text-center">{{ __('No Tenants Found.') }}</h6>
                                                </th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (user()->account_type == 4)
                <div id="tabs-site-setting-external-user" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ __('Basic Setting') }}</h5>
                        </div>
                        <div class="card-body">
                            <x-form :action="route('settings.store', tenant('tenant_id'))" id="update_setting" upload>
                                <div class="row">
                                    {{-- LOGO --}}
                                    @if (tenant('branding_level') == 'all')
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <x-input.label for="full_logo">{{ __('Logo') }}</x-input.label>
                                                <input type="file" name="full_logo" id="full_logo"
                                                    class="custom-input-file" />
                                                <x-input.label for="full_logo">
                                                    <i class="fa fa-upload"></i>
                                                    <span>{{ __('Choose a file…') }}</span>
                                                </x-input.label>
                                                {{-- }}<small><i>{{ tenant('logo') }}</i></small> --}}
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5">
                                            <img src="{{ !is_null(tenant('logo')) ? asset(\Storage::url(tenant('logo'))) : '' }}"
                                                class="img_setting" />
                                        </div>
                                    @endif
                                    {{-- END LOGO --}}

                                    @if (tenant('branding_level') == 'min' || tenant('branding_level') == 'all')
                                        {{-- SMALL LOGO TENANT--}}
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <x-input.label for="small_logo">{{ __('Small Logo') }}</x-input.label>
                                                <input type="file" name="small_logo" accept="image/*"
                                                    id="small_logo" class="custom-input-file" />
                                                <x-input.label for="small_logo">
                                                    <i class="fa fa-upload"></i>
                                                    <span>{{ __('Choose a file…') }}</span>
                                                </x-input.label>
                                            </div>
                                        </div>

                                        @if(!is_null(tenant('small_logo')))
                                            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 pt-4 mt-1">
                                                @if(File::exists(storage_path('/app/public/'.tenant('small_logo'))))
                                                    <div class="text-right">
                                                        <button type="button" class="action-item text-danger px-2"
                                                                data-dismiss="modal"
                                                                data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-smalllogo').submit();">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-xs-11 col-sm-11 col-md-5 col-lg-5 pt-5">
                                                <img src="{{ !is_null(tenant('small_logo')) ? asset(\Storage::url(tenant('small_logo'))) : '' }}"
                                                    class="img_setting" />
                                            </div>
                                        @endif

                                        {{-- END SMALL LOGO TENANT--}}
                                        {{-- POWEREDBY LOGO TENANT--}}
                                        {{--<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <x-input.label for="poweredby_logo">{{ __('Powered By Logo') }}</x-input.label>
                                                <input type="file" name="poweredby_logo" accept="image/*"
                                                       id="poweredby_logo" class="custom-input-file" />
                                                <x-input.label for="poweredby_logo">
                                                    <i class="fa fa-upload"></i>
                                                    <span>{{ __('Choose a file…') }}</span>
                                                </x-input.label>
                                            </div>
                                        </div>--}}

                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5">
                                            <img src="{{ !is_null(tenant('poweredby_logo')) ? asset(\Storage::url(tenant('poweredby_logo'))) : '' }}"
                                                 class="img_setting" />
                                        </div>
                                        {{-- END POWEREDBY LOGO TENANT--}}
                                    @endif

                                    @if (tenant('branding_level') == 'all')
                                        <div class="col-12">
                                            <x-input.label for="banner_type">{{ __('Banner') }}</x-input.label>
                                            <br>
                                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                <label
                                                    class="btn btn-sm btn-primary {{ tenant('banner_type') == 'image' ? 'active' : '' }}">
                                                    <input type="radio" name="banner_type" value="image"
                                                        class="banner_style" autocomplete="off"
                                                        {{ tenant('banner_type') == 'image' ? 'checked' : '' }}>
                                                    {{ __('Image') }}
                                                </label>
                                                <label
                                                    class="btn btn-sm btn-primary {{ tenant('banner_type') == 'color' ? 'active' : '' }}">
                                                    <input type="radio" name="banner_type" value="color"
                                                        class="banner_style" autocomplete="off"
                                                        {{ tenant('banner_type') == 'color' ? 'checked' : '' }}>
                                                    {{ __('Color') }}
                                                </label>
                                            </div>
                                        </div>

                                        <div
                                            class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mt-3 banner_img {{ tenant('banner_type') == 'image' ? '' : 'd-none' }}">
                                            <div class="form-group">
                                                <x-input.label for="banner_type">{{ __('Banner Image') }}
                                                </x-input.label>
                                                <input type="file" name="banner" id="banner"
                                                    class="custom-input-file" />
                                                <label for="banner">
                                                    <i class="fa fa-upload"></i>
                                                    <span>{{ __('Choose a file…') }}</span>
                                                </label>
                                                <small><i>{{ tenant('banner') }}</i></small>
                                            </div>
                                        </div>
                                        <div
                                            class="col-xs-12 col-sm-12 col-md-6 col-lg-6 pt-5 banner_img {{ tenant('banner_type') == 'image' ? '' : 'd-none' }}">
                                            <img src="{{ !is_null(tenant('banner')) ? asset(\Storage::url(tenant('banner'))) : '' }}"
                                                class="img_setting" />
                                        </div>
                                    @endif
                                </div>

                                @if (tenant('branding_level') == 'all')
                                    <div class="row mt-4">
                                        <x-input.text name="header_text" id="header_text" label="Title Text"
                                            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                            value="{{ tenant('header_text') }}"
                                            placeholder="Enter Header Title Text" />

                                        <x-select name="default_theme" label="Default Theme"
                                            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            @foreach ($themes as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ tenant('default_theme') == $value ? 'selected' : '' }}>
                                                    {{ $label }}</option>
                                            @endforeach
                                        </x-select>
                                    </div>
                                @endif
                                <div class="row">
                                    <x-select name="date_format" label="Date Format"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        @foreach ($arrDate as $value => $label)
                                            <option value="{{ $value }}"
                                                {{ tenant('date_format') == $value ? 'selected' : '' }}>
                                                {{ $label }}</option>
                                        @endforeach
                                    </x-select>
                                    <x-input.text type="time" name="day_start" id="day_start" label="Day Start"
                                        container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                        value="{{ tenant('day_start') }}" />

                                    @if (tenant('branding_level') == 'all')
                                        <x-input.checkbox name="show_activities" id="show_activities"
                                            label="Show Activities"
                                            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6 py-2 my-3"
                                            :checked="tenant('show_activities') == '1' ? true : false" value="on">
                                        </x-input.checkbox>
                                    @endif

                                </div>
                                <div class="text-right">
                                    <input type="hidden" name="from" value="external_admin_site_setting">
                                    <x-button type="submit" sm pill>{{ __('Save changes') }}</x-button>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
            @endif
            @if (user()->account_type == 1 || user()->account_type == 4)
                <div id="tabs-user-layout"
                    class="tabs-card {{ user()->account_type == 1 || user()->account_type == 4 ? 'd-none' : '' }}">
                    <div class="card">
                        <div class="card-header actions-toolbar border-0">
                            <div class="actions-search" id="actions-user-search">
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i
                                                class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-flush" id="user_keyword"
                                        placeholder="{{ __('Type keyword..') }}">
                                    <div class="input-group-append">
                                        <a href="#" class="input-group-text bg-transparent"
                                            data-action="search-close" data-target="#actions-user-search"><i
                                                class="fas fa-times"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">{{ __('Users') }}</h6>
                                </div>
                                <div class="col text-right">
                                    <div class="actions">
                                        <a href="#" class="action-item mr-2" data-action="search-open"
                                            data-target="#actions-user-search"><i class="fas fa-search"></i></a>
                                        <div class="dropdown mr-2">
                                            <a href="#" class="action-item" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-filter"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right" id="user_sort">
                                                <a class="dropdown-item active" href="#"
                                                    data-val="created_at-desc">
                                                    <i class="fas fa-sort-amount-down"></i>{{ __('Newest') }}
                                                </a>
                                                <a class="dropdown-item" href="#" data-val="name-asc">
                                                    <i class="fas fa-sort-alpha-down"></i>{{ __('From A-Z') }}
                                                </a>
                                                <a class="dropdown-item" href="#" data-val="name-desc">
                                                    <i class="fas fa-sort-alpha-up"></i>{{ __('From Z-A') }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="dropdown mr-2">
                                            <a href="#" class="action-item" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item" id="refresh_userlist">
                                                    {{ __('Refresh') }}
                                                </a>
                                            </div>
                                        </div>
                                        @if (user()->account_type == 4)
                                            <a href="#" class="action-item"
                                                data-url="{{ route('user.create', tenant('tenant_id')) }}"
                                                data-ajax-popup="true" data-size="lg"
                                                data-title="{{ __('Add User') }}">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 px-1 pb-3">
                            @if (user()->account_type == 1)
                                <div class="row px-3">
                                    <div class="col-2 my-auto">
                                        <div class="form-group">
                                            <label class="form-control-label"
                                                for="user_tenant">{{ __('Tenant') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-5 my-auto">
                                        <div class="form-group">
                                            <select name="user_tenant" id="user_tenant" class="form-control">
                                                @foreach ($tenants as $tent)
                                                    <option value="{{ $tent->tenant_id }}">
                                                        {{ $tent->company_name . ' (' . $tent->tenant_id . ')' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div id='userlist-loader' class="min-h-500">
                                <img src="{{ asset('assets/img/loading.gif') }}" height="50px" width="50px"
                                    class="loading" alt="">
                            </div>
                            <div class="table-responsive" id="userlist-content" style="display: none">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            @if (user()->account_type == 4)
                                                <th>{{ __('Primary') }}</th>
                                            @endif
                                            <th>{{ __('Account Type') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="user_list">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (user()->account_type == 1)
                <div id="tabs-layout-navigation-layout" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header actions-toolbar border-0">
                            <div class="actions-search" id="actions-layout-navigation-search">
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i
                                                class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-flush"
                                        id="layout_navigation_keyword" placeholder="{{ __('Type keyword..') }}">
                                    <div class="input-group-append">
                                        <a href="#" class="input-group-text bg-transparent"
                                            data-action="search-close"
                                            data-target="#actions-layout-navigation-search"><i
                                                class="fas fa-times"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">{{ __('Layouts') }}</h6>
                                </div>
                                <div class="col text-right">
                                    <div class="actions">
                                        <a href="#" class="action-item mr-2" data-action="search-open"
                                            data-target="#actions-layout-navigation-search"><i
                                                class="fas fa-search"></i></a>
                                        <a href="#"
                                            data-url="{{ route('layout.navigation.create', tenant('tenant_id')) }}"
                                            id="layoutNavigationCreate" data-size="lg" data-ajax-popup="true"
                                            data-title="{{ __('Create Layout') }}" class="action-item">
                                            <i class="fas fa-plus"></i>
                                            <span class="d-sm-inline-block">{{ __('Add') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0 px-1 pb-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Internal') }}</th>
                                            <th>{{ __('External') }}</th>
                                            <th>{{ __('Public') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="layout_navigation_table">
                                        @if ($layoutDefinitions['all']->count() > 0)
                                            @foreach ($layoutDefinitions['all'] as $definition)
                                                <tr>
                                                    <td>{{ $definition->title }}</td>
                                                    <td>
                                                        @if ($definition->user_group == 1)
                                                            <i class="fas fa-check text-success"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($definition->user_group == 2)
                                                            <i class="fas fa-check text-success"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($definition->user_group == 3)
                                                            <i class="fas fa-check text-success"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="actions">
                                                            <a href="#" class="action-item px-2"
                                                                id="layoutNavigationEdit"
                                                                data-id="{{ $definition->id }}"
                                                                data-url="{{ route('layout.navigation.edit', [tenant('tenant_id'), $definition->id]) }}"
                                                                data-ajax-popup="true" data-size="lg"
                                                                data-title="{{ __('Edit Layout : ') . $definition->title }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            @if (user()->layout_definition != $definition->id)
                                                                <a href="#" class="action-item text-danger px-2"
                                                                    data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                    data-confirm-yes="document.getElementById('delete-layout-navigation-{{ $definition->id }}').submit();">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <x-form :action="route('layout.navigation.delete', [
                                                            tenant('tenant_id'),
                                                            $definition->id,
                                                        ])" delete
                                                            id="delete-layout-navigation-{{ $definition->id }}">
                                                        </x-form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th scope="col" colspan="5">
                                                    <h6 class="text-center">{{ __('No Data Found.') }}</h6>
                                                </th>
                                                {{-- <td>{{ $definition->title }}</td> --}}
                                                {{-- <td> --}}
                                                {{-- @if ($definition->user_group == 1)<i --}}
                                                {{-- class="fas fa-check text-success"></i> @endif --}}
                                                {{-- </td> --}}
                                                {{-- <td> --}}
                                                {{-- @if ($definition->user_group == 2)<i --}}
                                                {{-- class="fas fa-check text-success"></i> @endif --}}
                                                {{-- </td> --}}
                                                {{-- <td> --}}
                                                {{-- @if ($definition->user_group == 3) <i --}}
                                                {{-- class="fas fa-check text-success"></i> @endif --}}
                                                {{-- </td> --}}
                                                {{-- <td> --}}
                                                {{-- <div class="actions"> --}}
                                                {{-- <a href="#" class="action-item px-2" id="layoutNavigationEdit" --}}
                                                {{-- data-id="{{ $definition->id }}" --}}
                                                {{-- data-url="{{ route('layout.navigation.edit', [tenant('tenant_id'), 'layoutDefinition' => $definition]) }}" --}}
                                                {{-- data-ajax-popup="true" data-size="lg" --}}
                                                {{-- data-title="{{ __('Edit Layout') }}" --}}
                                                {{-- > --}}
                                                {{-- <i class="fas fa-edit"></i> --}}
                                                {{-- </a> --}}
                                                {{-- <a href="#" class="action-item text-danger px-2" --}}
                                                {{-- data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}" --}}
                                                {{-- data-confirm-yes="document.getElementById('delete-layout-navigation-{{ $definition->id }}').submit();"> --}}
                                                {{-- <i class="fas fa-trash-alt"></i> --}}
                                                {{-- </a> --}}
                                                {{-- </div> --}}
                                                {{-- {!! Form::open(['method' => 'DELETE', 'route' => ['layout.navigation.delete', [tenant('tenant_id'), 'layoutDefinition' => $definition]], 'id' => 'delete-layout-navigation-' . $definition->id]) !!} --}}
                                                {{-- {!! Form::close() !!} --}}
                                                {{-- </td> --}}
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-permission-layout" class="tabs-card {{ user()->account_type == 1 ? 'd-none' : '' }}">
                    <div class="card">
                        <div class="card-header ">
                            <div class="row justify-content-between align-items-center">
                                <h5 class="h6 mb-0">{{ __('Permissions & Features') }}</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <x-form :action="route('moduleAssignment.store.permissions', tenant('tenant_id'))" id="form_module_assignment" method="POST">
                                <div class="row">
                                    @if (count($securityGroup) > 0)
                                        <x-select name="group_name" label="Group"
                                            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="group_name">
                                            @foreach ($securityGroup as $key => $label)
                                                <option value="{{ $label }}">
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                    @else
                                        <x-select name="group_name" label="Group"
                                            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" id="group_name"
                                            disabled="true">
                                        </x-select>
                                    @endif
                                </div>

                                <div class="row">

                                    @if (count($securityGroup) > 0)
                                        <x-select name="module_name" label="Module" id="module_select_layout"
                                            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                            @foreach ($modulePermsDefs as $key => $modules)
                                                <option value="{{ $key }}">
                                                    {{ $key }}
                                                </option>
                                            @endforeach
                                        </x-select>
                                    @else
                                        <x-select name="module_name" label="Module" id="module_select_layout"
                                            container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6" disabled='true'>
                                        </x-select>
                                    @endif

                                </div>

                                @foreach ($modulePermsDefs as $key => $modules)
                                    @if ($loop->first)
                                        <div class="row selectors" id="permission-selector-{{ $modules['code'] }}">
                                            @foreach ($modules['results'] as $k => $defs)
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 py-1 my-1">

                                                    <div class="custom-control custom-switch">
                                                        @if (count($securityGroup) > 0)
                                                            <input type="checkbox" name="permission_values"
                                                                id="{{ $modules['code'] . '_' . $defs->permission_key }}"
                                                                class="custom-control-input"
                                                                data-level="{{ $defs->permission_level }}"
                                                                value="{{ $defs->permission_key }}">

                                                            <label class="custom-control-label form-control-label"
                                                                for="{{ $modules['code'] . '_' . $defs->permission_key }}">
                                                                {{ $defs->permission_description }}
                                                            </label>
                                                        @else
                                                            <input type="checkbox" name="permission_values"
                                                                id="{{ $modules['code'] . '_' . $defs->permission_key }}"
                                                                class="custom-control-input"
                                                                data-level="{{ $defs->permission_level }}"
                                                                value="{{ $defs->permission_key }}" disabled="true">

                                                            <label class="custom-control-label form-control-label"
                                                                for="{{ $modules['code'] . '_' . $defs->permission_key }}">
                                                                {{ $defs->permission_description }}
                                                            </label>
                                                        @endif
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="row selectors d-none"
                                            id="permission-selector-{{ $modules['code'] }}">
                                            @foreach ($modules['results'] as $k => $defs)
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 py-1 my-1">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" name="permission_values"
                                                            id="{{ $modules['code'] . '_' . $defs->permission_key }}"
                                                            class="custom-control-input"
                                                            data-level="{{ $defs->permission_level }}"
                                                            value="{{ $defs->permission_key }}">

                                                        <label class="custom-control-label form-control-label"
                                                            for="{{ $modules['code'] . '_' . $defs->permission_key }}">
                                                            {{ $defs->permission_description }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach

                                    <div class="float-left mt-3">
                                        <span class=" text-sm font-italic"> Permissions apply only to host users</span>
                                    </div>
                                    <div class="float-right  mt-2">
                                        <input type="hidden" name="unchecked_permissions" value=""
                                            id="unchecked_permissions">
                                        <input type="hidden" name="checked_permissions" value=""
                                            id="checked_permissions">
                                        <input type="hidden" name="module_assignments" value=""
                                            id="module_assignments">

                                        @if (count($securityGroup) > 0)
                                            <x-button type="button" sm primary pill id="submit_permission">
                                                {{ __('Save changes') }}
                                            </x-button>
                                        @else
                                            <x-button type="button" sm primary pill id="submit_permission"
                                                disabled='true'>
                                                {{ __('Save changes') }}
                                            </x-button>
                                        @endif
                                    </div>

                            </x-form>
                        </div>

                    </div>
                </div>

                {{-- <div id="tabs-integrations" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header actions-toolbar border-0">
                            <div class="actions-search" id="actions-integrations-search">
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i
                                                class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-flush" id="integrations_keyword"
                                           placeholder="{{ __('Type keyword..') }}">
                                    <div class="input-group-append">
                                        <a href="#" class="input-group-text bg-transparent" data-action="search-close"
                                           data-target="#actions-integrations-search"><i class="fas fa-times"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">{{ __('Integrations') }}</h6>
                                </div>
                                <div class="col text-right">
                                    <div class="actions">
                                        <a href="#" class="action-item mr-2" data-action="search-open"
                                           data-target="#actions-integrations-search"
                                        >
                                            <i class="fas fa-search"></i>
                                        </a>
                                        <a href="#" data-url="{{ route('integrations.create', tenant('tenant_id')) }}"
                                           id="integrationCreate" data-size="lg" data-ajax-popup="true"
                                           data-title="{{ __('Create Integration') }}" class="action-item"
                                        >
                                            <i class="fas fa-plus"></i>
                                            <span class="d-sm-inline-block">{{ __('Add') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0 px-1 pb-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="integrations_table">
                                        @if (count($integrations) > 0)
                                            @foreach ($integrations as $integration_val)
                                                <tr>
                                                    <td>{{ $integration_val->name }}</td>
                                                    <td>
                                                        <div class="actions">
                                                            <a href="#" class="action-item px-2 integrationEdit"
                                                               data-id="{{ $integration_val->id }}"
                                                               data-url="{{ route('integrations.edit', [tenant('tenant_id'), $integration_val->id]) }}"
                                                               data-ajax-popup="true" data-size="lg"
                                                               data-title="{{ __('Configure Integration Authentication') }}"
                                                               id="{{ $integration_val->id }}"
                                                            >
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="#" class="action-item text-danger px-2"
                                                               data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                               data-confirm-yes="document.getElementById('delete-integration-{{ $integration_val->id }}').submit();"
                                                            >
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['integrations.destroy', [tenant('tenant_id'), $integration_val->id]], 'id' => 'delete-integration-' . $integration_val->id]) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th scope="col" colspan="5">
                                                    <h6 class="text-center">{{ __('No Data Found.') }}</h6>
                                                </th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div id="tabs-label-message" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-body pt-1">
                            <ul class="nav nav-tabs nav-bordered mb-3">
                                <li class="nav-item">
                                    <a href="#labels" data-toggle="tab" aria-expanded="false"
                                        class="nav-link active">
                                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">{{ __('Labels') }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#messages" data-toggle="tab" aria-expanded="true" class="nav-link">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">{{ __('Messages') }}</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="labels">
                                    <x-form :action="route('settings.store', tenant('tenant_id'))" id="update_labels">
                                        <div class="row">
                                            <x-input.text name="document_menu" label="Document Menu"
                                                container-class="col-md-12"
                                                value="{{ Utility::getValByName('document_menu') }}" required />
                                            <x-input.text name="folder_menu" label="Folder Menu"
                                                container-class="col-md-12"
                                                value="{{ Utility::getValByName('folder_menu') }}" required />
                                            <x-input.text name="task_menu" label="Task Menu"
                                                container-class="col-md-12"
                                                value="{{ Utility::getValByName('task_menu') }}" required />
                                            <x-input.text name="activities_menu" label="Activities Menu"
                                                container-class="col-md-12"
                                                value="{{ Utility::getValByName('activities_menu') }}" required />
                                            <x-input.text name="help_menu" label="Help Menu"
                                                container-class="col-md-12"
                                                value="{{ Utility::getValByName('help_menu') }}" required />
                                            <x-input.text name="salutation" label="Salutation"
                                                container-class="col-md-12"
                                                value="{{ Utility::getValByName('salutation') }}" required />
                                            <x-input.text name="single_task_work_item" label="Single task/work item"
                                                container-class="col-md-6"
                                                value="{{ Utility::getValByName('single_task_work_item') }}"
                                                required />
                                            <x-input.text name="plural_task_work_item" label="Plural task/work item"
                                                container-class="col-md-6"
                                                value="{{ Utility::getValByName('plural_task_work_item') }}"
                                                required />
                                        </div>
                                        <div class="text-right">
                                            <input type="hidden" name="from" value="label_message">
                                            <x-button type="submit" sm pill>{{ __('Save changes') }}</x-button>
                                        </div>
                                    </x-form>
                                </div>
                                <div class="tab-pane show" id="messages">
                                    <x-form :action="route('message.store.data', [tenant('tenant_id'), 'en'])">

                                        @foreach ($arrMessage as $fileName => $fileValue)
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h3>{{ ucfirst($fileName) }}</h3>
                                                </div>
                                                @foreach ($fileValue as $label => $value)
                                                    @if (is_array($value))
                                                        @foreach ($value as $label2 => $value2)
                                                            @if (is_array($value2))
                                                                @foreach ($value2 as $label3 => $value3)
                                                                    @if (is_array($value3))
                                                                        @foreach ($value3 as $label4 => $value4)
                                                                            @if (is_array($value4))
                                                                                @foreach ($value4 as $label5 => $value5)
                                                                                    <x-input.text
                                                                                        container-class="col-lg-12"
                                                                                        class="mb-3"
                                                                                        name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}][{{ $label4 }}][{{ $label5 }}]"
                                                                                        label="{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}.{{ $label4 }}.{{ $label5 }}"
                                                                                        value="{{ $value5 }}" />
                                                                                @endforeach
                                                                            @else
                                                                                <x-input.text
                                                                                    container-class="col-lg-12"
                                                                                    class="mb-3"
                                                                                    name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}][{{ $label4 }}]"
                                                                                    label="{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}.{{ $label4 }}"
                                                                                    value="{{ $value4 }}" />
                                                                            @endif
                                                                        @endforeach
                                                                    @else
                                                                        <x-input.text container-class="col-lg-12"
                                                                            class="mb-3"
                                                                            name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}][{{ $label3 }}]"
                                                                            label="{{ $fileName }}.{{ $label }}.{{ $label2 }}.{{ $label3 }}"
                                                                            value="{{ $value3 }}" />
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <x-input.text container-class="col-lg-12"
                                                                    class="mb-3"
                                                                    name="message[{{ $fileName }}][{{ $label }}][{{ $label2 }}]"
                                                                    label="{{ $fileName }}.{{ $label }}.{{ $label2 }}"
                                                                    value="{{ $value2 }}" />
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <x-input.text container-class="col-lg-12" class="mb-3"
                                                            name="message[{{ $fileName }}][{{ $label }}]"
                                                            label="{{ $fileName }}.{{ $label }}"
                                                            value="{{ $value }}" />
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endforeach
                                        <hr>
                                        <div class="text-right">
                                            <x-button sm pill type="submit">{{ __('Save') }}</x-button>
                                        </div>
                                    </x-form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tabs-mail-setting" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ __('Mailer Settings') }}</h5>
                        </div>
                        <div class="card-body">
                            <x-form :action="route('settings.store', tenant('tenant_id'))" id="update_setting">
                                <div class="row">
                                    <x-input.text name="mail_driver" container-class="col-md-6" label="Mail Driver"
                                        value="{{ $mail->mail_driver ?? '' }}" required
                                        placeholder="{{ __('Mail Driver') }}" />
                                    <x-input.text name="mail_host" container-class="col-md-6" label="Mail Host"
                                        value="{{ $mail->mail_host ?? '' }}" required
                                        placeholder="{{ __('Mail Host') }}" />
                                    <x-input.text name="mail_port" container-class="col-md-6" label="Mail Port"
                                        value="{{ $mail->mail_port ?? '' }}" required
                                        placeholder="{{ __('Mail Port') }}" min="0" />
                                    <x-input.text name="mail_username" container-class="col-md-6"
                                        label="Mail Username" value="{{ $mail->mail_username ?? '' }}" required
                                        placeholder="{{ __('Mail Username') }}" />
                                    <x-input.text required type="password" name="mail_password" container-class="col-md-6"
                                        label="Mail Password" value="{{ $mail->mail_password ?? '' }}" required
                                        placeholder="{{ __('Mail Password') }}" />
                                    <x-input.text name="mail_encryption" container-class="col-md-6"
                                        label="Mail Encryption" value="{{ $mail->mail_encryption ?? '' }}" required
                                        placeholder="{{ __('Mail Encryption') }}" />
                                    <x-input.text name="mail_from_address" container-class="col-md-6"
                                        label="Mail From Address" value="{{ $mail->mail_from_address ?? '' }}"
                                        required placeholder="{{ __('Mail From Address') }}" />
                                    <x-input.text name="mail_from_name" container-class="col-md-6"
                                        label="Mail From Name" value="{{ $mail->mail_from_name ?? '' }}" required
                                        placeholder="{{ __('Mail From Name') }}" />

                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="text-left">
                                            <x-button type="button" sm warning pill class="send_email"
                                                data-title="{{ __('Send Test Mail') }}"
                                                data-url="{{ route('test.email', tenant('tenant_id')) }}">
                                                {{ __('Send Test Mail') }}</x-button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-right">
                                            <input type="hidden" name="from" value="mail">
                                            <x-button type="submit" sm pill>{{ __('Save changes') }}</x-button>
                                        </div>
                                    </div>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>


                {{-- <div id="tabs-pusher-setting" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ __('Pusher Settings') }}</h5>
                        </div>
                        <div class="card-body">
                            <x-form :action="route('settings.store', tenant('tenant_id'))" id="update_setting">
                                <div class="row">
                                    <x-input.text name="pusher_app_id"
                                                  container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                                  label="Pusher App Id" value="{{ env('PUSHER_APP_ID') }}" required
                                                  placeholder="{{ __('Pusher App Id') }}"/>

                                    <x-input.text name="pusher_app_key"
                                                  container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                                  label="Pusher App Key" value="{{ env('PUSHER_APP_KEY') }}" required
                                                  placeholder="{{ __('Pusher App Key') }}"/>

                                    <x-input.text name="pusher_app_secret"
                                                  container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                                  label="Pusher App Secret"
                                                  value="{{ env('PUSHER_APP_SECRET') }}" required
                                                  placeholder="{{ __('Pusher App Secret') }}"/>

                                    <x-input.text name="pusher_app_cluster"
                                                  container-class="col-xs-12 col-sm-12 col-md-6 col-lg-6"
                                                  label="Pusher App Cluster"
                                                  value="{{ env('PUSHER_APP_CLUSTER') }}" required
                                                  placeholder="{{ __('Pusher App Cluster') }}"/>

                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="text-right">
                                            <input type="hidden" name="from" value="pusher">
                                            <x-button type="submit" sm pill>{{ __('Save changes') }}</x-button>
                                        </div>
                                    </div>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div> --}}
                <div id="tabs-customPage-setting" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header actions-toolbar border-0">
                            <div class="actions-search" id="actions-custom-page-search">
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i
                                                class="fas fa-search"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-flush"
                                        id="customPage_keyword" placeholder="{{ __('Type keyword..') }}">
                                    <div class="input-group-append">
                                        <a href="#" class="input-group-text bg-transparent"
                                            data-action="search-close" data-target="#actions-custom-page-search"><i
                                                class="fas fa-times"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">{{ __('Custom Pages') }}</h6>
                                </div>
                                <div class="col text-right">
                                    <div class="actions">
                                        <a href="#" class="action-item mr-2" data-action="search-open"
                                            data-target="#actions-custom-page-search"><i
                                                class="fas fa-search"></i></a>

                                        @if (in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms))
                                            <a href="#"
                                                data-url="{{ route('CustomPages.create', tenant('tenant_id')) }}"
                                                id="customPageCreate" data-size="lg" data-ajax-popup="true"
                                                data-title="{{ __('New Custom Page') }}" class="action-item">
                                                <i class="fas fa-plus"></i>
                                                <span class="d-sm-inline-block">{{ __('Add') }}</span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0 px-1 pb-3">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            @if (in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms) || user()->account_type == 1)
                                                <th>{{ __('Action') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody id="custom_pages_table">
                                        @if (count($customPage) > 0)
                                            @foreach ($customPage as $pageVal)
                                                <tr>
                                                    <td>{{ $pageVal->title }}</td>
                                                    @if (in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms))
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#"
                                                                    class="action-item px-2 customPageEdit"
                                                                    data-id="{{ $pageVal->id }}"
                                                                    data-url="{{ route('CustomPages.edit', [tenant('tenant_id'), $pageVal->id]) }}"
                                                                    data-ajax-popup="true" data-size="lg"
                                                                    data-title="{{ __('Edit Custom Page') }}"
                                                                    id="{{ $pageVal->id }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                @if (user()->account_type == 1)
                                                                    <a href="#"
                                                                        class="action-item text-danger px-2"
                                                                        data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                        data-confirm-yes="document.getElementById('delete-CustomPages-{{ $pageVal->id }}').submit();">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            @if (user()->account_type == 1)
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['CustomPages.destroy', [tenant('tenant_id'), $pageVal->id]],
                                                                    'id' => 'delete-CustomPages-' . $pageVal->id,
                                                                ]) !!}
                                                                {!! Form::close() !!}
                                                            @endif
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th scope="col" colspan="5">
                                                    <h6 class="text-center">{{ __('No Data Found.') }}</h6>
                                                </th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="tabs-help-center" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="h6 mb-0">{{ __('Help Center Settings') }}</h5>
                        </div>
                        <div class="card-body">
                            <x-form :action="route('settings.store', tenant('tenant_id'))" id="update_setting" enctype="multipart/form-data">
                                <div class="row">
                                    <x-input.textarea name="help_center_text" class="summernote-simple"
                                        container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        {{ \Utility::getValByName('help_center_text') }}
                                    </x-input.textarea>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="text-right">
                                            <input type="hidden" name="from" value="help_center">
                                            <x-button type="submit" sm pill>{{ __('Save changes') }}</x-button>
                                        </div>
                                    </div>
                                </div>
                            </x-form>
                        </div>
                    </div>
                </div>
                <div id="tabs-faq" class="tabs-card d-none">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="mb-0">{{ __('FAQ Settings') }}</h6>
                                </div>
                                <div class="col-auto">
                                    <div class="actions">
                                        <a href="#" class="action-item"
                                            data-url="{{ route('faq.create', tenant('tenant_id')) }}"
                                            data-ajax-popup="true" data-size="lg"
                                            data-title="{{ __('Add FAQ') }}">
                                            <i class="fas fa-plus"></i>
                                            <span class="d-sm-inline-block">{{ __('Add') }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th class="w-25">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($faqs->count() > 0)
                                            @foreach ($faqs as $faq)
                                                <tr>
                                                    <td>{{ $faq->title }}</td>
                                                    <td>
                                                        <div class="actions">
                                                            <a href="#" class="action-item px-2"
                                                                data-url="{{ route('faq.edit', [tenant('tenant_id'), $faq]) }}"
                                                                data-ajax-popup="true" data-size="lg"
                                                                data-title="{{ __('Edit FAQ') }}">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <a href="#" class="action-item text-danger px-2"
                                                                data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="document.getElementById('delete-faq-{{ $faq->id }}').submit();">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['faq.destroy', [tenant('tenant_id'), $faq->id]],
                                                            'id' => 'delete-faq-' . $faq->id,
                                                        ]) !!}
                                                        {!! Form::close() !!}
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th scope="col" colspan="2">
                                                    <h6 class="text-center">{{ __('No FAQ Found.') }}</h6>
                                                </th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                @if (in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms))
                    <div id="tabs-news-feed" class="tabs-card d-none">
                        <div class="card">
                            <div class="card-header actions-toolbar border-0">
                                <div class="actions-search" id="actions-news-search">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent"><i
                                                    class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-flush" id="customPage_keyword"
                                               placeholder="{{ __('Type keyword..') }}">
                                        <div class="input-group-append">
                                            <a href="#" class="input-group-text bg-transparent" data-action="search-close"
                                               data-target="#actions-news-search"><i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0">{{ __('Posts') }}</h6>
                                    </div>
                                    <div class="col text-right">
                                        <div class="actions">
                                            <a href="#" class="action-item mr-2" data-action="search-open"
                                               data-target="#actions-news-search"><i class="fas fa-search"></i></a>
                                            <a href="#" data-url="{{ route('newsfeed.create', tenant('tenant_id')) }}"
                                               id="newsCreate" data-size="lg" data-ajax-popup="true"
                                               data-title="{{ __('Create New Post') }}" class="action-item">
                                                <i class="fas fa-plus"></i>
                                                <span class="d-sm-inline-block">{{ __('Add') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body pt-0 px-1 pb-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Published') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="news_feed_table">
                                            @if (count($newsfeeds) > 0)
                                                @foreach ($newsfeeds as $post)
                                                    <tr>
                                                        <td>{{ $post->title }}</td>
                                                        <td>{{  Utility::isDate($post->updated_at)  }}</td>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#" class="action-item px-2 "
                                                                   data-url="{{ route('newsfeed.edit', [tenant('tenant_id'), $post]) }}"
                                                                   data-ajax-popup="true" data-size="lg"
                                                                   data-title="{{ __('Edit Post') }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="#" class="action-item text-danger px-2"
                                                                    data-confirm="{{__('Are You Sure?')}}|{{__('This action can not be undone. Do you want to continue?')}}"
                                                                    data-confirm-yes="document.getElementById('delete-news-{{ $post->id }}').submit();">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['newsfeed.destroy',[tenant('tenant_id'),$post->id]],
                                                                'id'=>'delete-news-'.$post->id
                                                            ]) !!}
                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th scope="col" colspan="5">
                                                        <h6 class="text-center">{{ __('No Data Found.') }}</h6>
                                                    </th>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                @if (in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms))
                    <div id="tabs-customPage-setting" class="tabs-card d-none">
                        <div class="card">
                            <div class="card-header actions-toolbar border-0">
                                <div class="actions-search" id="actions-custom-page-search">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent"><i
                                                    class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-flush"
                                            id="customPage_keyword" placeholder="{{ __('Type keyword..') }}">
                                        <div class="input-group-append">
                                            <a href="#" class="input-group-text bg-transparent"
                                                data-action="search-close" data-target="#actions-custom-page-search"><i
                                                    class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0">{{ __('Custom Pages') }}</h6>
                                    </div>
                                    <div class="col text-right">
                                        <div class="actions">
                                            <a href="#" class="action-item mr-2" data-action="search-open"
                                                data-target="#actions-custom-page-search"><i
                                                    class="fas fa-search"></i></a>
                                            <a href="#"
                                                data-url="{{ route('CustomPages.create', tenant('tenant_id')) }}"
                                                id="customPageCreate" data-size="lg" data-ajax-popup="true"
                                                data-title="{{ __('New Custom Page') }}" class="action-item">
                                                <i class="fas fa-plus"></i>
                                                <span class="d-sm-inline-block">{{ __('Add') }}</span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body pt-0 px-1 pb-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="custom_pages_table">
                                            @if (count($customPage) > 0)
                                                @foreach ($customPage as $pageVal)
                                                    <tr>
                                                        <td>{{ $pageVal->title }}</td>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#"
                                                                    class="action-item px-2 customPageEdit"
                                                                    data-id="{{ $pageVal->id }}"
                                                                    data-url="{{ route('CustomPages.edit', [tenant('tenant_id'), $pageVal->id]) }}"
                                                                    data-ajax-popup="true" data-size="lg"
                                                                    data-title="{{ __('Edit Custom Page') }}"
                                                                    id="{{ $pageVal->id }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                @if (user()->account_type == 1)
                                                                    <a href="#"
                                                                        class="action-item text-danger px-2"
                                                                        data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                        data-confirm-yes="document.getElementById('delete-CustomPages-{{ $pageVal->id }}').submit();">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>
                                                                @endif
                                                            </div>
                                                            @if (user()->account_type == 1)
                                                                {!! Form::open([
                                                                    'method' => 'DELETE',
                                                                    'route' => ['CustomPages.destroy', [tenant('tenant_id'), $pageVal->id]],
                                                                    'id' => 'delete-CustomPages-' . $pageVal->id,
                                                                ]) !!}
                                                                {!! Form::close() !!}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th scope="col" colspan="5">
                                                        <h6 class="text-center">{{ __('No Data Found.') }}</h6>
                                                    </th>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (in_array('FAQ_ALL_CONTENT', $userPerms))
                    <div id="tabs-help-center" class="tabs-card d-none">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="h6 mb-0">{{ __('Help Center Settings') }}</h5>
                            </div>
                            <div class="card-body">
                                <x-form :action="route('settings.store', tenant('tenant_id'))" id="update_setting" enctype="multipart/form-data">
                                    <div class="row">
                                        <x-input.textarea name="help_center_text" class="summernote-simple"
                                            container-class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            {{ \Utility::getValByName('help_center_text') }}
                                        </x-input.textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <div class="text-right">
                                                <input type="hidden" name="from" value="help_center">
                                                <x-button type="submit" sm pill>{{ __('Save changes') }}</x-button>
                                            </div>
                                        </div>
                                    </div>
                                </x-form>
                            </div>
                        </div>
                    </div>
                    <div id="tabs-faq" class="tabs-card d-none">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0">{{ __('FAQ Settings') }}</h6>
                                    </div>
                                        <div class="col-auto">
                                            <div class="actions">
                                                <a href="#" class="action-item"
                                                    data-url="{{ route('faq.create', tenant('tenant_id')) }}"
                                                    data-ajax-popup="true" data-size="lg"
                                                    data-title="{{ __('Add FAQ') }}">
                                                    <i class="fas fa-plus"></i>
                                                    <span class="d-sm-inline-block">{{ __('Add') }}</span>
                                                </a>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ __('Title') }}</th>
                                                <th class="w-25">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($faqs->count() > 0)
                                                @foreach ($faqs as $faq)
                                                    <tr>
                                                        <td>{{ $faq->title }}</td>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#" class="action-item px-2"
                                                                    data-url="{{ route('faq.edit', [tenant('tenant_id'), $faq]) }}"
                                                                    data-ajax-popup="true" data-size="lg"
                                                                    data-title="{{ __('Edit FAQ') }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="#" class="action-item text-danger px-2"
                                                                    data-confirm="{{ __('Are You Sure?') }}|{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                    data-confirm-yes="document.getElementById('delete-faq-{{ $faq->id }}').submit();">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['faq.destroy', [tenant('tenant_id'), $faq->id]],
                                                                'id' => 'delete-faq-' . $faq->id,
                                                            ]) !!}
                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th scope="col" colspan="2">
                                                        <h6 class="text-center">{{ __('No FAQ Found.') }}</h6>
                                                    </th>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if (in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms) || tenant()->manage_news_posts)
                    <div id="tabs-news-feed" class="tabs-card d-none">
                        <div class="card">
                            <div class="card-header actions-toolbar border-0">
                                <div class="actions-search" id="actions-news-search">
                                    <div class="input-group input-group-merge input-group-flush">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-transparent"><i
                                                    class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-flush" id="customPage_keyword"
                                               placeholder="{{ __('Type keyword..') }}">
                                        <div class="input-group-append">
                                            <a href="#" class="input-group-text bg-transparent" data-action="search-close"
                                               data-target="#actions-news-search"><i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0">{{ __('Posts') }}</h6>
                                    </div>
                                    <div class="col text-right">
                                        <div class="actions">
                                            <a href="#" class="action-item mr-2" data-action="search-open"
                                               data-target="#actions-news-search"><i class="fas fa-search"></i></a>
                                            <a href="#" data-url="{{ route('newsfeed.create', tenant('tenant_id')) }}"
                                               id="newsCreate" data-size="lg" data-ajax-popup="true"
                                               data-title="{{ __('Create New Post') }}" class="action-item">
                                                <i class="fas fa-plus"></i>
                                                <span class="d-sm-inline-block">{{ __('Add') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body pt-0 px-1 pb-3">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Published') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody id="news_feed_table">
                                            @if (count($newsfeeds) > 0)
                                                @foreach ($newsfeeds as $post)
                                                    <tr>
                                                        <td>{{ $post->title }}</td>
                                                        <td>{{  Utility::isDate($post->updated_at)  }}</td>
                                                        <td>
                                                            <div class="actions">
                                                                <a href="#" class="action-item px-2 "
                                                                   data-url="{{ route('newsfeed.edit', [tenant('tenant_id'), $post]) }}"
                                                                   data-ajax-popup="true" data-size="lg"
                                                                   data-title="{{ __('Edit Post') }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="#" class="action-item text-danger px-2"
                                                                    data-confirm="{{__('Are You Sure?')}}|{{__('This action can not be undone. Do you want to continue?')}}"
                                                                    data-confirm-yes="document.getElementById('delete-news-{{ $post->id }}').submit();">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                            {!! Form::open([
                                                                'method' => 'DELETE',
                                                                'route' => ['newsfeed.destroy',[tenant('tenant_id'),$post->id]],
                                                                'id'=>'delete-news-'.$post->id
                                                            ]) !!}
                                                            {!! Form::close() !!}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <th scope="col" colspan="5">
                                                        <h6 class="text-center">{{ __('No Data Found.') }}</h6>
                                                    </th>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif

            {{-- Add Package Configuration Page --}}
            @if ($packageConfigurations)
                @foreach ($packageConfigurations as $pk => $v)
                    @php
                        $packageConfigurationTemplate = $pk . '::' . $v['template'];
                    @endphp
                    @if(\View::exists($packageConfigurationTemplate))
                        <div id="{{ (isset($v['tab_id']) && !empty($v['tab_id'])) ? $pk . '_' . $v['tab_id']: '' }}" class="tabs-card d-none">
                            @include($packageConfigurationTemplate)
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-iconpicker/css/bootstrap-iconpicker.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/libs/summernote/summernote-bs4.css') }}">
    @endpush
    @push('theme-script')
        <script src="{{ asset('assets/libs/summernote/summernote-bs4.js') }}"></script>
        <script type="text/javascript"
            src="{{ asset('assets/libs/bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/js/form-step.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>
    @endpush
    @push('script')
        <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
        <script>
            // For Sidebar Tabs
            var sort = 'created_at-desc';

            var color_table_json = [];
            var color_data = "";
            var module_perms = @json($modulePermsDefs);
            var module_assignments = @json($permsAssignment);
            var checked_permissions = [];
            var unchecked_permissions = [];
            var fixed_min_top_height = {!! env('FIXED_MIN_TOP_CARD_HEIGHT') !!};
            var fixed_min_middle_height = {!! env('FIXED_MIN_MIDDLE_CARD_HEIGHT') !!};
            var fixed_min_bottom_height = {!! env('FIXED_MIN_BOTTOM_CARD_HEIGHT') !!};
            //console.log("module assignment", module_assignments);
            // console.log("module_perms", module_perms);
            // console.log("security group",  @json($securityGroup) );
            //console.log("userGroups",  @json($userGroups) );
            // console.log("userPerms",  @json($userPerms) );

            $(document).ready(function() {
                var tab = 'tabs-site-setting';
                if (@json($permsAssignment).length > 0) {
                    checked_permissions = @json($permsAssignment);
                }

                checkPermissions();

                @if (user()->account_type == 4)
                    tab = 'site-setting-external-user'
                @endif

                @if ($tab = Session::get('tab-status'))
                    var tab = '{{ $tab }}';
                @endif

                var nav_tab = '';

                @if ($nav_tab = Session::get('nav-status'))
                    var nav_tab = '{{ $nav_tab }}';
                @endif

                @if (user()->account_type != 1)
                    @if (in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms) &&  (in_array('FAQ_ALL_CONTENT', $userPerms)) )
                        @if($tab == 'faq')
                            tab = 'faq';
                        @elseif ( $tab == 'help-center')
                            tab = 'help-center'
                        @else
                            tab = 'customPage-setting'
                        @endif

                    @elseif(in_array('CUSTOM_PAGES_ALL_CONTENT', $userPerms))
                        tab = 'customPage-setting'
                    @elseif(in_array('FAQ_ALL_CONTENT', $userPerms) && $tab !== 'faq')
                        tab = 'help-center'
                    @elseif(in_array('NEWS_FEEDS_ALL_CONTENT', $userPerms) && $tab !== 'news-feed')
                        tab = 'news-feed'
                    @endif
                @endif

                //set value if there is one
                @if (Session::get('tab-status'))
                    var tab = '{{ $tab }}';
                @endif

                setTimeout(function() {
                    $("#tabs .list-group-list[data-href='#tabs-" + tab + "']").trigger("click");
                    if (nav_tab != '') {
                        $(".nav-item .nav-link[href='#" + nav_tab + "_navigation']").trigger("click");
                    }
                }, 10);

                @if (Session::has('success') && Session::has('id') && !empty(Session::get('id')))
                    show_toastr('Success', '{{ Session::get('success') }}', 'success');
                    $("#tabs-integrations").find("#{{ Session::get('id') }}").trigger("click");
                    {{ Session::forget('success') }}
                    {{ Session::forget('id') }}
                @endif

                $('.list-group-list').on('click', function() {
                    var href = $(this).attr('data-href');
                    $('.tabs-card').addClass('d-none');
                    $(href).removeClass('d-none');
                    $('#tabs .list-group-list').removeClass('text-primary');
                    $(this).addClass('text-primary');
                });
                // User Filter Data
                ajaxFilterUserList($('#user_tenant').val(), 'created_at-desc');
                if ($(".summernote-simple-sidebar").length) {
                    setTimeout(function() {
                        $(".summernote-simple-sidebar").summernote({
                            dialogsInBody: !0,
                            minHeight: 200,
                            toolbar: [
                                ['style', ['style', 'strikethrough']],
                                ["font", ["bold", "italic", "underline", "clear"]],
                                ['fontname', ['fontname']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ["para", ["ul", "ol", "paragraph"]],
                                ['insert', ['hr', 'link', 'picture']],
                                ['height', ['height']],
                                ['view', ['codeview']],
                            ]
                        });
                    }, 100);
                }

            });

            function checkPermissions() {
                var selected_group = $('select[name="group_name"]').val();
                var selected_module = $('select[name="module_name"]').val();
                $('input[name=permission_values]:checkbox').each(function() {
                    $(this).prop("checked", false);
                });

                Object.entries(module_assignments).forEach((assignment) => {
                    if (assignment[1].group_name == selected_group &&
                        assignment[1].module_name == selected_module) {
                        var checkboxId = module_perms[selected_module]['code'] + "_" + assignment[1].permission_key;
                        $('#' + checkboxId).prop("checked", true);
                    }
                })

            }

            @if (user()->account_type == 1)
                // For Test Email Send
                $(document).on("click", '.send_email', function(e) {
                    e.preventDefault();
                    var title = $(this).attr('data-title');
                    var size = 'md';
                    var url = $(this).attr('data-url');
                    if (typeof url != 'undefined') {
                        $("#commonModal .modal-title").html(title);
                        $("#commonModal .modal-dialog").addClass('modal-' + size);
                        $("#commonModal").modal('show');
                        $.post(url, {
                            mail_driver: $("#mail_driver").val(),
                            mail_host: $("#mail_host").val(),
                            mail_port: $("#mail_port").val(),
                            mail_username: $("#mail_username").val(),
                            mail_password: $("#mail_password").val(),
                            mail_encryption: $("#mail_encryption").val(),
                            mail_from_address: $("#mail_from_address").val(),
                        }, function(data) {
                            $('#commonModal .modal-body').html(data);
                        });
                    }
                });
                $(document).on('submit', '#test_email', function(e) {
                    e.preventDefault();
                    $("#email_sanding").show();
                    var post = $(this).serialize();
                    var url = $(this).attr('action');
                    $.ajax({
                        type: "post",
                        url: url,
                        data: post,
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (data.is_success) {
                                $('#email').val('');
                                show_toastr('Success', data.message, 'success');
                            } else {
                                show_toastr('Error', data.message, 'error');
                            }
                            $("#email_sanding").hide();
                        }
                    });
                });
                // End Test Email
                // For Card Content Type Change
                $(document).on('change', '#content_type', function() {
                    getSource($(this).val());
                    renderColorTable();
                });
                var getLayoutSource = null;

                function getSource(content_type, source = '') {
                    if (content_type != '' && content_type != undefined) {
                        $('#data_source').empty();
                        getLayoutSource = $.ajax({
                            type: "POST",
                            url: '{{ route('layout.getsource', tenant('tenant_id')) }}',
                            data: {
                                content_type: content_type
                            },
                            cache: false,
                            beforeSend: function() {
                                if (getLayoutSource != null) {
                                    getLayoutSource.abort();
                                } else {
                                    $("#loader").show();
                                    $('#data-content').hide();
                                }
                            },
                            success: function(response, status, xhr) {
                                if (!xhr.responseJSON) {
                                    location.reload();
                                    return false;
                                }
                                if (response.is_success) {
                                    if (content_type == 'Content view' || content_type == 'Workflow view') {
                                        $('.eform_div').removeClass('d-none');
                                    } else if (!$('.eform_div').hasClass('d-none')) {
                                        $('.eform_div').addClass('d-none');
                                    }
                                    if (content_type == 'Line Chart') {
                                        $('.chart-dimensions').removeClass('d-none');
                                    } else if(!$('.chart-dimensions').hasClass('d-none')) {
                                        $('.chart-dimensions').addClass('d-none');
                                    }

                                    if (content_type == 'Horizontal bar Chart' || content_type ==
                                        'Vertical bar Chart' || content_type == 'Pie Chart') {
                                        $('.color-select-table').removeClass('d-none');
                                        $('.chart-dimensions').removeClass('d-none');
                                        $("#adv_config").val(JSON.stringify(
                                            color_table_json)); //empties out the color table json if not charts
                                    } else if (!$('.color-select-table').hasClass('d-none')) {
                                        $("#adv_config").val("");
                                        $('.color-select-table').addClass('d-none');
                                        $('.chart-dimensions').addClass('d-none');
                                    }

                                    if (content_type == 'Custom HTML') {
                                        $('.url_div').removeClass('d-none');
                                        $('.source_div').addClass('d-none');
                                    } else {
                                        if (!$('.url_div').hasClass('d-none')) {
                                            $('.source_div').removeClass('d-none');
                                            $('.url_div').addClass('d-none');
                                        }
                                        $('#data_source').empty();
                                        $.each(response.data, function(key, data) {
                                            var selected = ''
                                            if (source != '' && source != undefined && source == data) {
                                                selected = 'selected';
                                            }else if (content_type == 'Single Form' && (source != '' && source != undefined && source == key)) {
                                                selected = 'selected'; // single form is key = ID , value = Navigation Data Source Name
                                            }
                                            if (content_type == 'Integration' || content_type ==
                                                'Custom Page') {
                                                $("#data_source").append('<option value="' + data + '" ' +
                                                    selected + '>' + key + '</option>');
                                            } else if (content_type == 'Single Form' || content_type == 'Single Dashboard') {
                                                $("#data_source").append('<option value="' + key + '" ' +
                                                    selected + '>' + data + '</option>');
                                            } else {
                                                $("#data_source").append('<option value="' + data + '" ' +
                                                    selected + '>' + data + '</option>');
                                            }
                                        });
                                    }
                                } else {
                                    $('#data_source').empty();
                                    show_toastr('Error', response.message, 'error');
                                }
                            },
                            complete: function(data) {
                                // Hide image container
                                $("#loader").hide();
                                $('#data-content').show();
                                // Enabling list mode toggle button if Content View/Workflow view
                                let list_mode_toggle = $('#content_type').val();
                                if (list_mode_toggle === "Content view" || list_mode_toggle === "Workflow view") {
                                    $("#list_mode_toggle").css('display', 'block');
                                } else {
                                    $("#list_mode_toggle").css('display', 'none');
                                    $("#max_column_input").css('display', 'none');
                                }
                            }
                        });
                    } else {
                        show_toastr('Error', '{{ __('Content Type Not Found.') }}', 'error');
                        setTimeout(function() {
                            $("#commonModal").modal('toggle');
                        }, 300);
                    }
                }

                function renderColorTable(color_table = color_table_json) {
                    var color_url = $(".add-color-pointer").attr('data-url');
                    //for color table temporary
                    if (color_table.length != 0) {
                        $("#color-table-body").empty();
                        var td_html = ""
                        for (let [index, color_data] of color_table.entries()) {
                            td_html += ` <tr><td>
                                <span class="color-dot" style="background-color:${color_data.color} "></span>
                            </td>
                            <td >
                                ${color_data.value}
                            </td>
                            <td>
                                <div class="actions float-right">
                                    <a href="#" class="action-item color-data-edit" data-color="${color_data.color}" data-value="${color_data.value}" data-id="${color_data.id}" data-size="md" data-title="Edit Color Values"  data-url="${color_url}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="action-item text-danger color-data-delete" data-color="${color_data.color}">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td></tr>`;
                        }
                        $("#color-table-body").append(td_html);
                        $("#adv_config").val(JSON.stringify(color_table_json));
                    } else {
                        $("#color-table-body").empty();
                        $("#adv_config").val("");
                    }
                } //renderColorTable
            @endif

            // User Filter With List
            var currentRequest = null;

            $('#user_tenant').on('change', function() {
                ajaxFilterUserList($(this).val(), sort, $('#user_keyword').val());
            });

            $(document).on('keyup', '#user_keyword', function() {
                ajaxFilterUserList($('#user_tenant').val(), sort, $(this).val());
            });

            // when change sorting order
            $('#refresh_userlist').on('click', function(e) {
                currentRequest = null;
                ajaxFilterUserList($('#user_tenant').val(), sort, $('#user_keyword').val());
            });

            $('#user_sort').on('click', 'a', function(e) {
                e.stopPropagation();
                sort = $(this).attr('data-val');
                ajaxFilterUserList($('#user_tenant').val(), sort, $('#user_keyword').val());
                $('#user_sort a').removeClass('active');
                $(this).addClass('active');
            });

            function ajaxFilterUserList(tenant_id, user_sort, keyword = '') {
                var mainEle = $('#user_list');
                var data = {
                    tenant_id: tenant_id,
                    sort: user_sort,
                    keyword: keyword,
                }
                currentRequest = $.ajax({
                    type: 'POST',
                    url: '{{ route('users.list', tenant('tenant_id')) }}',
                    data: data,
                    beforeSend: function() {
                        if (currentRequest != null) {
                            currentRequest.abort();
                        } else {
                            $("#userlist-loader").show();
                            $('#userlist-content').hide();
                        }
                    },
                    success: function(data, status, xhr) {
                        if (!xhr.responseJSON) {
                            location.reload();
                            return false;
                        }
                        mainEle.html(data.html);
                    },
                    complete: function(data) {
                        if (currentRequest != null) {
                            $("#userlist-loader").hide();
                            $('#userlist-content').show();
                        }
                    }
                });
            }

            // end
            @if (user()->account_type == 1)
                $(document).on('change', 'input[name="sidebar_editor_style"]', function() {
                    var type = $('input[name="sidebar_editor_style"]:checked').val();
                    if (type == 'bg_color') {
                        $('.sidebar_bg_color').removeClass('d-none');
                        $('.sidebar_bg_gradiant').addClass('d-none');
                    } else if (type == 'bg_gradient') {
                        $('.sidebar_bg_color').addClass('d-none');
                        $('.sidebar_bg_gradiant').removeClass('d-none');
                    } else {
                        $('.sidebar_bg_color').addClass('d-none');
                        $('.sidebar_bg_gradiant').addClass('d-none');
                    }
                });

                $(document).on('change', 'input[name="banner_type"]', function() {
                    var bannerType = $('input[name="banner_type"]:checked').val();
                    if (bannerType == 'image') {
                        $('.banner_img').removeClass('d-none');
                    } else {
                        $('.banner_img').addClass('d-none');
                    }
                });

                // permissions check group name change
                $(document).on("change", '#group_name', function(e) {
                    checkPermissions();
                });


                // permissions setting at module change
                $(document).on("change", '#module_select_layout', function(e) {
                    var selected_module = $('select[name="module_name"]').val();

                    Object.entries(module_perms).forEach((module_name) => {
                        if (module_name[0] == selected_module) {
                            $('.selectors').addClass('d-none');
                            $('#permission-selector-' + module_name[1]['code']).removeClass('d-none');
                        }
                    })

                    checkPermissions();
                });


                // permission checkbox checker
                $(document).on("change", 'input[name=permission_values]', function(e) {
                    var type = "";
                    if ($(this).is(':checked')) {
                        console.log("Checkbox is checked..")
                        type = "checked";
                    } else {
                        console.log("Checkbox is not checked..")
                        type = "unchecked";
                    }
                    var perms_key = $(this).val();
                    var perms_level = $(this).attr('data-level');
                    populatePermissionChecker(perms_level, perms_key, type);
                });

                function populatePermissionChecker(perms_level, perms_key, type) {
                    var group_name = $('#group_name').val();
                    var module_name = $('#module_select_layout').val();
                    var obj = {
                        'group_name': group_name,
                        'module_name': module_name,
                        'permission_key': perms_key,
                        'permission_value': perms_level,
                    }

                    //check condition
                    if (type == "checked") {

                        //checks if it exists in uncheck
                        var uncheckPermsFilter = unchecked_permissions.filter(function(uncheck, idx) {
                            return !(uncheck.group_name == obj.group_name &&
                                uncheck.module_name == obj.module_name &&
                                uncheck.permission_key == obj.permission_key &&
                                uncheck.permission_value == obj.permission_value)
                        })

                        //if  its unchecked, it should  be removed or updated
                        if (uncheckPermsFilter.length > 0) {
                            unchecked_permissions = uncheckPermsFilter;
                        } else {
                            //only value in it
                            unchecked_permissions = [];
                        }


                        var otherPerms = [];
                        Object.entries(@json($modulePermsDefs)).forEach((perms) => {
                            //checking if there are other permissions assigned
                            //store only if more than 1
                            if (perms[0] == module_name && perms[1].results.length >= 1) {
                                otherPerms = perms[1];
                            }
                        });
                        //console.log("otherPerms", otherPerms)
                        if (otherPerms.length > 0) {
                            var permResults = otherPerms['results'];

                            if (permResults.length > 1) {

                                //sort by permission level
                                sortedPerms = permResults.sort((a, b) => a.permission_level - b.permission_level);

                                //get the index of the selected value
                                var foundIndex = sortedPerms.findIndex(el => el.permission_level == perms_level);

                                var slicedArray = sortedPerms.splice(foundIndex, sortedPerms.length);

                                slicedArray.forEach((p) => {
                                    if (p.permission_level != perms_level) {
                                        //checking anything under a certain permission hierarchy
                                        checked_permissions.push({
                                            'group_name': group_name,
                                            'module_name': p.module_name,
                                            'permission_key': p.permission_key,
                                            'permission_value': p.permission_level,
                                        });
                                        var checkboxId = otherPerms.code + "_" + p.permission_key;

                                        $('#' + checkboxId).prop("checked", true);
                                    }
                                });
                            }
                        }

                        checked_permissions.push(obj);

                    } else if (type == "unchecked") {

                        var checkfilteredArray = checked_permissions.filter(function(perm, idx) {
                            return !(perm.group_name == obj.group_name &&
                                perm.module_name == obj.module_name &&
                                perm.permission_key == obj.permission_key &&
                                perm.permission_value == obj.permission_value)
                        })

                        var modulesAssignmentsCheck = []

                        //check if it exists in DB
                        if (module_assignments.length > 0) {

                            modulesAssignmentsCheck = module_assignments.filter(function(perm, idx) {
                                return (perm.group_name == obj.group_name &&
                                    perm.module_name == obj.module_name &&
                                    perm.permission_key == obj.permission_key &&
                                    perm.permission_value == obj.permission_value)
                            })
                        }

                        //if it exists in checked permissions, update array
                        if (checkfilteredArray.length > 0) {
                            checked_permissions = checkfilteredArray;
                        } else if (checkfilteredArray.length == 0) {
                            checked_permissions = [];
                        }

                        //only push if its already exist in DB
                        if (modulesAssignmentsCheck.length > 0) {
                            unchecked_permissions.push(obj);
                        }

                    } //end if

                }

                // layout type checker
                $(document).on("change", 'input[name=fixed_layout]', function(e) {
                    var layout_chosen = $(this).val();

                    //fixed layout
                    if (layout_chosen == 1) {
                        $('#top_card_height').attr('disabled', false);
                        $('#middle_card_height').attr('disabled', false);
                        $('#bottom_card_height').attr('disabled', false);
                    } else {
                        //dynamic layout
                        $('#top_card_height').attr('disabled', true);
                        $('#middle_card_height').attr('disabled', true);
                        $('#bottom_card_height').attr('disabled', true);
                    }

                });

                //layout
                $(document).on('click', '.layout_selector', function(e) {
                    e.preventDefault();
                    var fixed_layout =  $("input[type='radio'][name='fixed_layout']:checked").val();
                    var title = $("#layout_navigation_title").val();
                    //console.log('fixed_layout', fixed_layout)

                    if(title){
                        if (fixed_layout > 0){
                            var top_card = $("#top_card_height").val();
                            var middle_card = $("#middle_card_height").val();
                            var bottom_card = $("#bottom_card_height").val();

                            if (top_card < 1){
                                show_toastr("Error", "Top card height is required for fixed layout.", "error");
                            }else if(middle_card < 1){
                                show_toastr("Error", "Middle card height is required for fixed layout.", "error");
                            }else if(bottom_card < 1){
                                show_toastr("Error", "Bottom card height is required for fixed layout.", "error");
                            }else if(top_card < fixed_min_top_height){
                                show_toastr("Error", "Minimum Top height is "+ fixed_min_top_height +"px.", "error");
                            }else if(middle_card < fixed_min_middle_height){
                                show_toastr("Error", "Minimum Middle height is "+ fixed_min_middle_height +"px.", "error");
                            }else if(bottom_card < fixed_min_bottom_height){
                                show_toastr("Error", "Minimum Bottom height is "+ fixed_min_bottom_height +"px.", "error");
                            }else{
                                $('#frm_navigation_store').submit();
                            }
                        }else{
                            $('#frm_navigation_store').submit();
                        }
                    }else{
                        show_toastr("Error", "Layout Title is required.", "error");
                    }
                });

                // Layout & Navigation Search
                $(document).on('keyup', '#layout_navigation_keyword', function() {
                    var value = $(this).val().toLowerCase();
                    $("#layout_navigation_table tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                // End

                // Custom Page Search
                $(document).on('keyup', '#customPage_keyword', function() {
                    var value = $(this).val().toLowerCase();
                    $("#custom_pages_table tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                // End

                var layoutNavigationId = 0;
                $('#layoutCreate, #layoutNavigationEdit').on('click', function() {
                    var attr = $(this).attr('data-id');
                    if (typeof attr !== typeof undefined && attr !== false) {
                        layoutNavigationId = attr;
                        loadLayoutNavigationView(layoutNavigationId);
                    } else {
                        layoutNavigationId = 0;
                        loadLayoutNavigationView(layoutNavigationId);
                    }
                });

                // Submit Layout
                var submitLayout = null;
                $(document).on('click', '#submit_layout', function(e) {
                    e.preventDefault();
                    var layout_data = $('#form_layout').serializeArray();
                    var height = 0;
                    var width = 0;
                    // for list mode and max column
                    let list_mode_toggle = $('#list_mode').is(':checked');
                    var list_mode = list_mode_toggle ? "on" : "off";
                    var max_column = $("#max_column").val();

                    //get the height and width
                    layout_data.forEach(function (object) {
                        if(object.name == "chart_height"){
                            height = parseInt(object.value);
                        }
                        if (object.name == "chart_width") {
                            width = parseInt(object.value);
                        }
                    });

                    layout_data.push({
                        name: 'layout_definition_id',
                        value: layoutNavigationId
                    });

                    var chart_dimensions = [{
                        'height': height ,
                        'width': width,
                    }];

                    var list_mode_settings = [{
                        'list_mode': list_mode,
                        'max_column': max_column
                    }]

                    //remake the adv config for the chart dimensions
                    layout_data.forEach(function (object) {
                        if(object.name == "adv_config"){
                            var color_table = object.value;
                            object.value = JSON.stringify({
                                'color_table' : color_table,
                                'chart_dimensions' : chart_dimensions,
                                'list_mode_settings' : list_mode_settings
                            });
                        }
                    });

                    submitLayout = $.ajax({
                        type: "POST",
                        url: $('#form_layout').attr('action'),
                        data: layout_data,
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (submitLayout != null) {
                                submitLayout.abort();
                            }
                            if (data.is_success == true) {
                                show_toastr('Success', data.message, 'success');
                            } else if (data.is_success == false) {
                                show_toastr('Error', data.message, 'error');
                            }
                        },
                        complete: function(data) {
                            var resp = data.responseJSON;
                            if (resp.is_success == true) {
                                if (submitLayout != null) {
                                    $('#commonModal2').modal('toggle');
                                    loadLayoutNavigationView(layoutNavigationId);
                                }
                            }
                        }
                    });
                });
                // End Submit Layout

                // Submit Navigation
                var submitNavigation = null;
                $(document).on('click', '#submit_navigation', function() {
                    var navigation_data = $('#form_navigation').serializeArray();
                    navigation_data.push({
                        name: 'layout_definition_id',
                        value: layoutNavigationId
                    });
                    submitNavigation = $.ajax({
                        type: "POST",
                        url: $('#form_navigation').attr('action'),
                        data: navigation_data,
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (submitNavigation != null) {
                                submitNavigation.abort();
                            }
                            if (data.is_success == true) {
                                show_toastr('Success', data.message, 'success');
                            } else if (data.is_success == false) {
                                show_toastr('Error', data.message, 'error');
                            }
                        },
                        complete: function(data) {
                            var resp = data.responseJSON;
                            if (resp.is_success != undefined && resp.is_success == true) {
                                if (submitNavigation != null) {
                                    $('#commonModal2').modal('toggle');
                                    loadLayoutNavigationView(layoutNavigationId, true);
                                }
                            }
                        }
                    });
                });
                // End Submit Navigation

                // Common Function for delete
                function deleteChildLayoutNavigation(url, is_true) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data:{
                            _method:"DELETE"
                        },
                        dataType: 'JSON',
                        cache: false,
                        success: function(response, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (!response.is_success) {
                                show_toastr('Error', response.message, 'error');
                            } else {
                                $('[id^=fire-modal]').modal('hide');
                                show_toastr('Success', response.message, 'success');
                            }
                        },
                        error: function(requestObject, error, errorThrown) {
                            console.log("error", error);
                            alert(errorThrown);
                        },
                        complete: function() {
                            loadLayoutNavigationView(layoutNavigationId, is_true);
                        }
                    });
                }

                // Common Function for GetView
                var loadNavigationLayout = null;

                function loadLayoutNavigationView(id = 0, layout = false) {
                    setTimeout(function() {
                        var userGroup = $('#user_group').val();
                        loadNavigationLayout = $.ajax({
                            type: "POST",
                            url: '{{ route('navigation_load.view', tenant('tenant_id')) }}',
                            data: {
                                userGroup: userGroup,
                                id: id
                            },
                            cache: false,
                            beforeSend: function() {
                                if (loadNavigationLayout != null) {
                                    loadNavigationLayout.abort();
                                } else {
                                    $("#layout-navigation-loader").removeClass('d-none');
                                    $('#layout-navigation-content').addClass('d-none');
                                }
                            },
                            success: function(response, status, xhr) {
                                if (!xhr.responseJSON) {
                                    location.reload();
                                    return false;
                                }
                                if (!response.is_success) {
                                    show_toastr('Error', response.message, 'error');
                                } else {
                                    $('#load_navigation_view').empty();
                                    $('#load_navigation_view').html(response.html);
                                    $('[id^=fire-modal]').remove();
                                    loadConfirm();
                                    setTimeout(function() {
                                        if (layout == true) {
                                            $("#load_navigation_view .nav-item .nav-link[href='#layout_navigation']")
                                                .trigger("click");
                                        }
                                    }, 150);
                                }
                            },
                            error: function(requestObject, error, errorThrown) {
                                alert(errorThrown);
                            },
                            complete: function() {
                                if (loadNavigationLayout != null) {
                                    $("#layout-navigation-loader").addClass('d-none');
                                    $('#layout-navigation-content').removeClass('d-none');
                                    loadSortable();
                                }
                            }
                        });
                    }, 200);
                }

                // Jquery That work in modal
                $('body').on('click', '.add_page_layout, .add_page_navigation', function() {
                    $('#commonModal2').on('shown.bs.modal', e => {
                        getSource($('#content_type').val());
                        color_data = $('#adv_config').val();
                        if (color_data !== "" && color_data !== undefined) {
                            color_table_json = JSON.parse(color_data);
                            renderColorTable(color_table_json);
                        }
                    });

                });

                let source
                $('body').on('click', '.edit_page_layout, .edit_navigation', function() {
                    source = $(this).attr('data-source');
                    $('#commonModal2').on('shown.bs.modal', e => {
                        getSource($('#content_type').val(), source);
                        color_data = $('#adv_config').val();
                        if (color_data !== "" && color_data !== undefined) {
                            color_table_json = JSON.parse(color_data);
                            renderColorTable(color_table_json);
                        }

                    });
                });

                // adding color to the color table
                $(document).on('click', '.add-color-pointer', function(e) {
                    //url that renders the UI
                    var url = $(this).attr('data-url');
                    e.preventDefault();
                    var title = $(this).attr('data-title');
                    if (typeof url != 'undefined') {
                        $("#commonModal3 .modal-title").html(title);
                        $("#commonModal3 .modal-dialog").addClass('modal-md');
                        $("#commonModal3").modal('show');
                        $.get(url, {}, function(data) {
                            $('#commonModal3 .modal-body').html(data);
                        });
                        return false;
                    } else {
                        show_toastr('Error', "Url is incorrect", 'error');
                    }
                });

                // editing a table row from color table
                $(document).on('click', 'a.color-data-edit', function(e) {
                    var url = $(this).attr('data-url');
                    var color = $(this).attr('data-color');
                    var value = $(this).attr('data-value');
                    var title = $(this).attr('data-title');
                    var color_id = $(this).attr('data-id');
                    e.preventDefault();
                    if (typeof url != 'undefined') {
                        $("#commonModal3 .modal-title").html(title);
                        $("#commonModal3 .modal-dialog").addClass('modal-md');
                        $("#commonModal3").modal('show');
                        $.get(url, {}, function(data) {
                            $('#commonModal3 .modal-body').html(data);
                        }).then((val) => {
                            $('#commonModal3 .modal-body #colorpicker').val(color);
                            $('#commonModal3 .modal-body #hexcolor').val(color);
                            $('#commonModal3 .modal-body #data_value').val(value);
                            $('#commonModal3 .modal-body #color_id').val(color_id);
                        });

                        return false;
                    } else {
                        show_toastr('Error', "Url is incorrect", 'error');
                    }

                });

                // removing a table row from color table
                $(document).on('click', 'a.color-data-delete', function(e) {
                    var color = $(this).attr('data-color');
                    console.log("delete color:", color);
                    color_table_json = color_table_json.filter(function(item) {
                        return item.color !== color;
                    });
                    //resetting the ids after removing them
                    if (color_table_json.length > 0) {
                        color_table_json = resetColorIds(color_table_json);
                    } else {
                        color_table_json = [];
                    }
                    //rerendering the table
                    renderColorTable(color_table_json);
                });


                $(document).on('click', '#submit_color_select', function(e) {
                    var hex_value = $('#commonModal3 .modal-body #hexcolor').val();
                    var data_value = $('#commonModal3 .modal-body #data_value').val();
                    var color_id = $('#commonModal3 .modal-body #color_id').val();
                    var reg = /^#([0-9a-f]{3}){1,2}$/i; //hexcode test

                    if (reg.test(hex_value) && data_value.length != 0) {
                        if (color_id && color_id > 0) {
                            $("#commonModal3").modal('hide');
                            color_table_json = color_table_json.map(obj => {
                                if (obj.id == color_id) {
                                    return {
                                        ...obj,
                                        "value": data_value,
                                        "color": hex_value
                                    };
                                }
                                return obj;
                            });
                            renderColorTable(color_table_json);
                        } else {
                            $("#commonModal3").modal('hide');
                            color_table_json.push({
                                "id": color_table_json.length + 1,
                                "value": data_value,
                                "color": hex_value
                            });
                            renderColorTable(color_table_json);
                        }
                    } else {
                        show_toastr('Error', "Data or Color values is incorrect or missing", 'error');
                    }
                });

                function resetColorIds(colorloop = color_table_json) {
                    colorloop = colorloop.map((obj, index) => {
                        return {
                            ...obj,
                            "id": index + 1,
                        };
                    });
                    return colorloop;
                }

                // function for Color picker
                $(document).on('input', '#colorpicker', function(e) {
                    $('#hexcolor').val(this.value);
                });
                $(document).on('input', '#hexcolor', function(e) {
                    $('#colorpicker').val(this.value);
                });

                // Function That Ajax and Update Layout Order
                function layoutOrder(ids) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('layout.order', tenant('tenant_id')) }}',
                        data: {
                            ids: ids
                        },
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (!data.is_success) {
                                show_toastr('Error', data.message, 'error');
                            }
                        },
                        error: function(requestObject, error, errorThrown) {
                            alert(errorThrown);
                        },
                    });
                }

                // Function That Call Ajax and Update Navigation Order
                function navigationOrder(ids) {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('navigation.order', tenant('tenant_id')) }}',
                        data: {
                            ids: ids
                        },
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (!data.is_success) {
                                show_toastr('Error', data.message, 'error');
                            }
                        },
                        error: function(requestObject, error, errorThrown) {
                            alert(errorThrown);
                        },
                    });
                }

                $(document).on('click', '#create_tenant', function() {
                    $.ajax({
                        type: "POST",
                        url: '{{ route('validate.tenant', tenant('tenant_id')) }}',
                        data: $('#frm_tenant').serialize(),
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            $('.modal .form-control').removeClass('is-invalid');
                            $('.modal .invalid-feedback').removeClass('d-block')
                            $('.modal .invalid-feedback').addClass('d-none');
                            if (data.is_success == true) {
                                $('#frm_tenant').submit();
                            } else {
                                $.each(data.errors, function(k, v) {
                                    $('#' + k).addClass('is-invalid');
                                    $('#' + k + '-invalid').html('');
                                    $('#' + k + '-invalid').removeClass('d-none');
                                    $('#' + k + '-invalid').addClass('d-block');
                                    $('#' + k + '-invalid').html(v);
                                });
                            }
                        }
                    });
                });
            @endif

            $(document).on('click', '#create_user', function() {
                $.ajax({
                    type: "POST",
                    url: '{{ route('validate.user', tenant('tenant_id')) }}',
                    data: $('#frm_create_user').serialize(),
                    cache: false,
                    success: function(data, status, xhr) {
                        if (!xhr.responseJSON) {
                            location.reload();
                            return false;
                        }
                        $('.modal .form-control').removeClass('is-invalid');
                        $('.modal .invalid-feedback').removeClass('d-block')
                        $('.modal .invalid-feedback').addClass('d-none');
                        if (data.is_success == true) {
                            $('#frm_create_user').submit();
                        } else {
                            $.each(data.errors, function(k, v) {
                                $('#' + k).addClass('is-invalid');
                                $('#' + k + '-invalid').html('');
                                $('#' + k + '-invalid').removeClass('d-none');
                                $('#' + k + '-invalid').addClass('d-block');
                                $('#' + k + '-invalid').html(v);
                            });
                        }
                    }
                });
            });

            @if (user()->account_type == 4)
                $(document).on('change', 'input[name="banner_type"]', function() {
                    var bannerType = $('input[name="banner_type"]:checked').val();
                    if (bannerType == 'image') {
                        $('.banner_img').removeClass('d-none');
                    } else {
                        $('.banner_img').addClass('d-none');
                    }
                });
            @endif
            $(document).on('click', '#submit_permission', function(e) {
                e.preventDefault();
                var url = '{{ route('moduleAssignment.store.permissions', tenant('tenant_id')) }}';

                if (unchecked_permissions.length > 0 || checked_permissions.length > 0) {
                    // $('#checked_permissions').val(JSON.stringify(checked_permissions));
                    // $('#unchecked_permissions').val(JSON.stringify(unchecked_permissions));
                    // $('#module_assignments').val(JSON.stringify(module_assignments));
                    // $('#form_module_assignment').submit();

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            checked_permissions: JSON.stringify(checked_permissions),
                            unchecked_permissions: JSON.stringify(unchecked_permissions),
                            module_assignments: JSON.stringify(module_assignments)
                        },
                        cache: false,
                        success: function(data, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (data.is_success){
                                module_assignments = data.permsAssignment;
                                show_toastr("Success", data.message, "success");
                            }else{
                                show_toastr("Error", data.message, "error");
                            }
                        }
                    });

                } else {
                    show_toastr("Error", "No changes in permissions has been set", "error");
                }

            });


            $(document).on('click', '#btn_edit_user', function(e) {
                e.preventDefault();

                var selected_user_id = $('#selected_user_id').val();
                var url = '{{ route('validate.user.edit', [tenant('tenant_id'), ' + selected_user_id + ']) }}';

                $.ajax({
                    type: "POST",
                    url: url,
                    data: $('#update_profile').serialize(),
                    cache: false,
                    success: function(data, status, xhr) {
                        if (!xhr.responseJSON) {
                            location.reload();
                            return false;
                        }
                        $('.modal .form-control').removeClass('is-invalid');
                        $('.modal .invalid-feedback').removeClass('d-block')
                        $('.modal .invalid-feedback').addClass('d-none');
                        if (data.is_success == true && data.validated == true) {
                            $('#update_profile').submit();
                            console.log('message', data.message)

                        } else if (data.is_success == false && data.validated == false) {
                            $.each(data.errors, function(k, v) {
                                $('#' + k).addClass('is-invalid');
                                $('#' + k + '-invalid').html('');
                                $('#' + k + '-invalid').removeClass('d-none');
                                $('#' + k + '-invalid').addClass('d-block');
                                $('#' + k + '-invalid').html(v);
                            });
                        } else if (data.is_success == false && data.validated == true) {
                            show_toastr('Error', data.message, 'error');
                        }

                    }
                });

            });


            var getSecurityGroups = null;

            function SecurityGroups(data, id = 0) {
                if (data != '' && data != undefined) {
                    getSecurityGroups = $.ajax({
                        type: "GET",
                        url: '{{ route('securitygroup', tenant('tenant_id')) }}',
                        data: {
                            id: id
                        },
                        cache: false,
                        beforeSend: function() {
                            if (getSecurityGroups != null) {
                                getSecurityGroups.abort();
                            } else {
                                $("#layout-security-loader").removeClass('d-none');
                                $('#security_group_div').hide();
                            }
                        },
                        success: function(response, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (response != null || response != '') {
                                $("#security_group_div").html('');
                                $("#security_group_div").css('height', "250px");
                                $("#security_group_div").css('overflow', "auto");
                                $.each(response, function(k, v) {
                                    var group_data = `
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="security_group[]" id="${v.GroupName}" value="${v.GroupName}" ${v.is_select == true ? 'checked' : ''}>
                                            <label class="custom-control-label form-control-label text-muted" for="${v.GroupName}">${v.GroupName}</label>
                                        </div>
                                    `;
                                    $("#security_group_div").append(group_data);
                                });
                            } else {
                                show_toastr('Error', '{{ __('Security groups not found.') }}', 'error');
                            }
                        },
                        complete: function(data) {
                            if (getSecurityGroups != null) {
                                $('#layout-security-loader').addClass('d-none');
                                $('#security_group_div').show();
                            }
                        }
                    });
                } else {
                    show_toastr('Error', '{{ __('Security groups not found.') }}', 'error');
                    setTimeout(function() {
                        $("#commonModal").modal('toggle');
                    }, 300);
                }
            }


            //for Newsfeeds
            function populateTenantsNewsfeeds(tenants, selected_tenants){
                var group_data  = '';
                $.each(tenants, function(k, v) {
                    group_data += `
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="selected_tenants[]" id="${v.tenant_id}" value="${v.tenant_id}" ${ selected_tenants.indexOf(v.tenant_id) != -1 ? 'checked' : ''}>
                            <label class="custom-control-label form-control-label text-muted" for="${v.tenant_id}">${v.company_name}</label>
                        </div>
                    `;

                });

                $('#tenant_news_div').html(group_data).show();

            }

            // REST Integration
            $('#integrationCreate,.integrationEdit').on('click', function() {
                var IntegrationId = 0;
                var attr = $(this).attr('data-id');
                var type = 'first';
                if (typeof attr !== typeof undefined && attr !== false) {
                    IntegrationId = attr;
                }
                loadConfigurationView(IntegrationId, type);
            });
            // Common Function for GetView for REST Integration Configuration
            var loadConfiguration = null;

            function loadConfigurationView(id = 0, type = '') {
                setTimeout(function() {
                    loadConfiguration = $.ajax({
                        type: "POST",
                        url: '{{ route('configuration_load.view', tenant('tenant_id')) }}',
                        data: {
                            id: id,
                            request_type: type
                        },
                        cache: false,
                        beforeSend: function() {
                            if (loadConfiguration != null) {
                                loadConfiguration.abort();
                            } else {
                                $("#configuration-loader").removeClass('d-none');
                                $('#configuration-content').addClass('d-none');
                            }
                        },
                        success: function(response, status, xhr) {
                            if (!xhr.responseJSON) {
                                location.reload();
                                return false;
                            }
                            if (!response.is_success) {
                                show_toastr('Error', response.message, 'error');
                            } else {
                                if (type == 'first') {
                                    $('#load_auth_config').empty();
                                    $('#load_auth_config').html(response.html);
                                } else if (type == 'second') {
                                    $('#load_searchlist_config').empty();
                                    $('#load_searchlist_config').html(response.html);
                                } else if (type == 'third') {
                                    $('#load_sub_config').empty();
                                    $('#load_sub_config').html(response.html);
                                }
                                $('[id^=fire-modal]').remove();
                                loadConfirm();
                            }
                        },
                        error: function(requestObject, error, errorThrown) {
                            alert(errorThrown);
                        },
                        complete: function() {
                            if (loadConfiguration != null) {
                                $("#configuration-loader").addClass('d-none');
                                $('#configuration-content').removeClass('d-none');
                            }
                        }
                    });
                }, 200);
            }
        </script>
    @endpush
</x-layouts.app>
