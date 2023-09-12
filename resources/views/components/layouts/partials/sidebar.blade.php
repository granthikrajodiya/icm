<div>
    @if(\Session::get('navigation_layout') == \App\Models\LayoutDefinition::NAVIGATION_LAYOUT_LIST )

        <div class="nav-application navigation-list clearfix">
            <a href="#" data-link="{{ route('home',tenant('tenant_id')) }}"
                class="btn-list text-sm {{ Session::get('navigation_title') == 'home' ? 'active' : '' }} main_title"
                data-title="home" id="home_menu"
            >
                <div class="row">
                    <div class="col-auto"><i class="fas fa-home" aria-hidden="true"></i>
                    </div>
                    <div class="col ml-n2 nav-text">
                        {{ __('Home') }}
                    </div>
                </div>
            </a>

            @foreach(\App\Models\Navigation::navigationResult('side') as $sideBar)
                @if($sideBar['contentType'] == 'Custom HTML' && $sideBar['advConfig']  == '1')
                    <a href="{{ $sideBar['datasource'] }}" class="btn-list text-sm {{ Session::get('navigation_title') == $sideBar['title'] ? 'active' : '' }} " target="_blank" data-title="{{$sideBar['title']}}" >
                @else
                    <a href="#" data-link="{{ $sideBar['link'] }}"
                    class="btn-list text-sm {{ Session::get('navigation_title') == $sideBar['title'] ? 'active' : '' }} main_title"
                    data-title="{{$sideBar['title']}}" >
                @endif

                        <div class="row ">
                            <div class="col-auto"><i class="{{ $sideBar['icon'] }}" aria-hidden="true"></i>
                            </div>
                            <div class="col ml-n2 nav-text">
                                {{ $sideBar['title'] }}
                            </div>
                        </div>
                    </a>
            @endforeach
        </div>
    @else
        <div class="nav-application clearfix">
            <a href="#" data-link="{{ route('home',tenant('tenant_id')) }}"
            class="btn btn-square text-sm {{ Session::get('navigation_title') == 'home' ? 'active' : '' }} main_title"
            data-title="home" id="home_menu"
            >
                <span class="btn-inner--icon d-block"><i class="fas fa-home fa-2x"></i></span>
                <span class="btn-inner--icon d-block pt-2">{{ __('Home') }}</span>
            </a>

            @foreach(\App\Models\Navigation::navigationResult('side') as $sideBar)
                @if($sideBar['contentType'] == 'Custom HTML' && $sideBar['advConfig']  == '1')
                    <a href="{{ $sideBar['datasource'] }}" class="btn btn-square text-sm {{ Session::get('navigation_title') == $sideBar['title'] ? 'active' : '' }} " target="_blank" data-title="{{$sideBar['title']}}" >
                @else
                    <a href="#" data-link="{{ $sideBar['link'] }}"
                    class="btn btn-square text-sm {{ Session::get('navigation_title') == $sideBar['title'] ? 'active' : '' }} main_title"
                    data-title="{{$sideBar['title']}}"
                    >
                @endif

                    <span class="btn-inner--icon d-block"><i class="{{ $sideBar['icon'] }} fa-2x"></i></span>
                    <span class="btn-inner--icon d-block pt-2">{{ $sideBar['title'] }}</span>
                </a>
            @endforeach
        </div>
    @endif
</div>

@if (!empty(Utility::getValByName('sidebar_editor')))
    <div class="row">
        <div class="col-12 pp-1 @if (Utility::getValByName('sidebar_editor_style') == 'bg_gradient') {{Utility::getValByName('bg_gradient')}} @endif"
            @if (Utility::getValByName('sidebar_editor_style') == 'bg_color') style="background-color: {{Utility::getValByName('sidebar_editor_bg')}}" @endif
        >
            {!! Utility::getValByName('sidebar_editor') !!}
        </div>
    </div>
@endif
