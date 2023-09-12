<x-layouts.app title="{{ __('Chat') }}" header="{{ __('Chat') }}">@push('css')
        <meta name="route" content="{{ $route }}">
        <meta name="url"
            content="{{ url('') . '/' . str_replace('{tenant}', tenant('tenant_id'), config('chatify.routes.prefix')) }}"
            data-user="{{ user()->id }}">

        {{-- scripts --}}
        <script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
        <script src="{{ asset('js/chatify/autosize.js') }}"></script>
        <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

        {{-- styles --}}
        <link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css' />
        <link href="{{ asset('css/chatify/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/chatify/' . $dark_mode . '.mode.css') }}" rel="stylesheet" />

        {{-- Messenger Color Style --}}
        @include('Chatify::layouts.messengerColor')
    @endpush

    {{-- @include('Chatify::layouts.headLinks') --}}

    <div class="messenger rounded min-h-750 overflow-hidden">
        <div class="messenger-listView">
            <div class="m-header">
                <nav>
                    <nav class="m-header-right">
                        <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                    </nav>
                </nav>
                <input type="text" class="messenger-search" placeholder="Search" />
                <div class="messenger-listView-tabs">
                    <a href="#" @if ($route == 'user') class="active-tab" @endif data-view="users">
                        <span class="fas fa-clock" title="{{ __('Recent') }}"></span>
                    </a>
                    <a href="#" @if ($route == 'group') class="active-tab" @endif data-view="groups">
                        <span class="fas fa-users" title="{{ __('Members') }}"></span>
                    </a>
                </div>
            </div>
            <div class="m-body">
                <div class="@if ($route == 'user') show @endif messenger-tab app-scroll" data-view="users">
                    <div class="favorites-section">
                        <p class="messenger-title">{{ __('Favorites') }}</p>
                        <div class="messenger-favorites app-scroll-thin"></div>
                    </div>
                    {!! view('Chatify::layouts.listItem', ['get' => 'saved', 'id' => $id])->render() !!}
                    <div class="listOfContacts" style="width: 100%;height: calc(100% - 200px);/*position: relative;*/">
                    </div>
                </div>

                <div class="all_members @if ($route == 'group') show @endif messenger-tab app-scroll" data-view="groups">
                    <p style="text-align: center;color:grey;">{{ __('Soon will be available') }}</p>
                </div>

                <div class="messenger-tab app-scroll" data-view="search">
                    <p class="messenger-title">{{ __('Search') }}</p>
                    <div class="search-records">
                        <p class="message-hint center-el"><span>{{ __('Type to search..') }}</span></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ----------------------Messaging side---------------------- --}}
        <div class="messenger-messagingView">
            {{-- header title [conversation name] amd buttons --}}
            <div class="m-header m-header-messaging">
                <nav>
                    {{-- header back button, avatar and user name --}}
                    <div style="display: inline-block;">
                        {{-- <div style="display: inline-flex;"> --}}
                        <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                        @if (!empty(user()->avatar))
                            <div class="avatar av-s header-avatar"
                                style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;background-image: url('{{ asset('/storage/' . user()->avatar) }}');">
                            </div>
                        @else
                            <div class="avatar av-s header-avatar"
                                style="margin: 0px 10px; margin-top: -5px; margin-bottom: -5px;background-image: url('{{ asset('/storage/avatars/avatar.png') }}');">
                            </div>
                        @endif
                        <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                    </div>
                    {{-- header buttons --}}
                    <nav class="m-header-right">
                        <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                        <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                    </nav>
                </nav>
            </div>
            {{-- Internet connection --}}
            <div class="internet-connection">
                <span class="ic-connected">{{ __('Connected') }}</span>
                <span class="ic-connecting">{{ __('Connecting...') }}</span>
                <span class="ic-noInternet">{{ __('No internet access') }}</span>
            </div>
            {{-- Messaging area --}}
            <div class="m-body app-scroll">
                <div class="messages">
                    <p class="message-hint center-el"><span>{{ __('Please select a chat to start messaging') }}</span>
                    </p>
                </div>
                {{-- Typing indicator --}}
                <div class="typing-indicator">
                    <div class="message-card typing">
                        <p>
                            <span class="typing-dots">
                                <span class="dot dot-1"></span>
                                <span class="dot dot-2"></span>
                                <span class="dot dot-3"></span>
                            </span>
                        </p>
                    </div>
                </div>
                {{-- Send Message Form --}}
                @include('Chatify::layouts.sendForm')
            </div>
        </div>
        {{-- ---------------------- Info side ---------------------- --}}
        <div class="messenger-infoView app-scroll">
            {{-- nav actions --}}
            <nav>
                <a href="#"><i class="fas fa-times"></i></a>
            </nav>
            {!! view('Chatify::layouts.info')->render() !!}
        </div>
    </div>

    @include('Chatify::layouts.modals')

    @push('script')
        @include('Chatify::layouts.footerLinks')
    @endpush
</x-layouts.app>
