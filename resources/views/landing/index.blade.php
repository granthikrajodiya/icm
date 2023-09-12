<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{(Utility::getValByName('header_text')) ?? config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('landingpage/assets/images/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/main-style.css')}}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/responsive.css')}}">
</head>

<body>
    <!-- header start -->
    <header class="site-header header-style-one">
        <div class="container">
            <div class="main-navigationbar">
                <div class="navigationbar-row d-flex justify-content-between align-items-center">
                    <div class="logo-col">
                        <h1>
                            <a href="index.html">
                                <img src="{{ tenant()?->logo_path ?? asset('assets/img/base_img/logo.png') }}" alt="">
                            </a>
                        </h1>
                    </div>
                    <div class="header-info-right">
                        <ul class="menu-right d-flex justify-content-end">
                            @if(isset($tenantId) && !empty($tenantId))
                                <li><a href="{{ route('login',$tenantId) }}" class="btn">{{__('Login')}}</a></li>
                                @if(tenant()->user_register)
                                    <li><a href="{{ route('register',$tenantId) }}" class="btn">{{__('Register')}}</a></li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="wrapper">
        <section class="main-home-first-section">
            <div class="banner-image">
                <img src="{{ asset('landingpage/assets/images/banner-img.png')}}" alt="">
            </div>
            <div class="container">
                <div class="home-banner-content">
                    <div class="home-banner-content-inner">
                        <img src="{{ asset('landingpage/assets/images/ILINX-Logo.png')}}" alt="">
                        <h2 class="h1">{{__('ENGAGE')}}</h2>
                        <h4>{{__('Bring your back office document and process information into the front office and beyond.')}}</h4>
                        @if(isset($tenantId) && !empty($tenantId))
                            @if(tenant()->user_register)
                                <a href="{{ route('register',$tenantId) }}" class="btn">{{__('Register')}}</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <section class="dashboard-preview-section padding-bottom">
            <div class="container">
                <div class="dashboard-preview-image">
                    <img src="{{ asset('landingpage/assets/images/dash-board.png')}}" alt="">
                </div>
            </div>
        </section>
        <section class="user-centric-section padding-bottom">
            <div class="container">
                <div class="section-title text-center">
                    <h2>{{__('Put any of your process information into a')}} <br> {{__('user-centric experience.')}}</h2>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12 experience-card">
                        <div class="experience-card-inner">
                            <div class="ex-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="78.168" height="78.29" viewBox="0 0 78.168 78.29">
                                    <g id="streamlinehq-interface-logout-circle-interface-essential-600" transform="translate(2.5 2.532)">
                                      <line id="Line_21" data-name="Line 21" x2="39.427" transform="translate(33.741 36.669)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <path id="Path_137" data-name="Path 137" d="M11.5,5,22.765,16.265,11.5,27.53" transform="translate(50.403 20.404)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <path id="Path_138" data-name="Path 138" d="M63.539,62.449a36.611,36.611,0,1,1,0-50.693" transform="translate(-0.51 -0.49)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                    </g>
                                  </svg>
                            </div>
                            <h4>{{__('Initiate')}}</h4>
                            <p>{{__('Start processes via built-in workflow, eForms and real-time chat.')}}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 experience-card">
                        <div class="experience-card-inner">
                            <div class="ex-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="78.222" height="78.223" viewBox="0 0 78.222 78.223">
                                    <g id="streamlinehq-mail-chat-bubble-typing-square-mail-600" transform="translate(2.5 2.5)">
                                      <ellipse id="Ellipse_8" data-name="Ellipse 8" cx="2.816" cy="2.816" rx="2.816" ry="2.816" transform="translate(18.305 30.979)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <ellipse id="Ellipse_9" data-name="Ellipse 9" cx="2.816" cy="2.816" rx="2.816" ry="2.816" transform="translate(36.611 30.979)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <ellipse id="Ellipse_10" data-name="Ellipse 10" cx="2.816" cy="2.816" rx="2.816" ry="2.816" transform="translate(54.916 30.979)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <path id="Path_133" data-name="Path 133" d="M23.03,68.091.5,73.723l5.632-16.9V6.133A5.633,5.633,0,0,1,11.765.5H68.09a5.633,5.633,0,0,1,5.632,5.633V62.458a5.633,5.633,0,0,1-5.632,5.633Z" transform="translate(-0.5 -0.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                    </g>
                                  </svg>
                            </div>
                            <h4>{{__('Collaborate')}}</h4>
                            <p>{{__('Publish and share documents, lists, calendars, and charts.')}}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 experience-card">
                        <div class="experience-card-inner">
                            <div class="ex-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="76.881" height="78.29" viewBox="0 0 76.881 78.29">
                                    <g id="streamlinehq-interface-edit-paint-interface-essential-600" transform="translate(2.523 2.561)">
                                      <ellipse id="Ellipse_5" data-name="Ellipse 5" cx="5.632" cy="5.633" rx="5.632" ry="5.633" transform="translate(38.681 14.087)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <ellipse id="Ellipse_6" data-name="Ellipse 6" cx="2.816" cy="2.816" rx="2.816" ry="2.816" transform="translate(18.967 47.882)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <ellipse id="Ellipse_7" data-name="Ellipse 7" cx="5.632" cy="5.633" rx="5.632" ry="5.633" transform="translate(16.151 22.536)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <path id="Path_132" data-name="Path 132" d="M50.691,66.856A5.633,5.633,0,0,0,47.03,61.9a11.265,11.265,0,0,1,3.548-21.967H61.111A11.265,11.265,0,0,0,71.756,24.893,36.611,36.611,0,1,0,37.229,73.728a35.484,35.484,0,0,0,9.8-1.352A5.069,5.069,0,0,0,50.691,66.856Z" transform="translate(-0.632 -0.499)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                    </g>
                                  </svg>
                            </div>
                            <h4>{{__('Customize')}}</h4>
                            <p>{{__('Add and remove capabilities with no-code, drag-drop functions.')}}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 experience-card">
                        <div class="experience-card-inner">
                            <div class="ex-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="78.222" height="72.591" viewBox="0 0 78.222 72.591">
                                    <g id="streamlinehq-interface-user-multiple-interface-essential-600" transform="translate(2.5 2.5)">
                                      <ellipse id="Ellipse_11" data-name="Ellipse 11" cx="12.673" cy="12.673" rx="12.673" ry="12.673" transform="translate(12.673 0)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <path id="Path_134" data-name="Path 134" d="M51.192,38.979H.5V33.346a25.346,25.346,0,1,1,50.692,0Z" transform="translate(-0.5 28.612)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <path id="Path_135" data-name="Path 135" d="M9,1.5A12.673,12.673,0,0,1,9,26.846" transform="translate(38.876 -1.5)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                      <path id="Path_136" data-name="Path 136" d="M10.6,8.19A25.346,25.346,0,0,1,26.934,31.847V38.1H18.485" transform="translate(46.288 29.492)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="5"/>
                                    </g>
                                  </svg>
                            </div>
                            <h4>{{__('Multi-tenant')}}</h4>
                            <p>{{__('Support multiple groups both inside and out with a single deployment.')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="user-forever-section  padding-bottom">
            <div class="section-back">
                <img src="{{ asset('landingpage/assets/images/back-shape.png')}}" alt="">
            </div>
            <div class="container">
                 <div class="user-forever-content">
                    <div class="section-title text-center">
                        <h2>{{__('Change the way you serve your users. ')}}<br> {{__('Forever.')}}</h2>
                    </div>
                    <p>Inside and outside your organization, everyone expects 24x7 engagement without picking up the phone or doing business in person.
                        Organizations and departments everywhere need an easy, protected, and traceable way to initiate and interact within business processes,
                        share information and track engagement. <br> <b>ILINX Engage is the answer.</b> <br> With ILINX Engage, creating experiences that delight your user communities is quick and easy.</p>
                 </div>
            </div>
        </section>
        <section class="process-section padding-bottom padding-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12 pro-list-wrap">
                        <h3>Employee Processes</h3>
                        <ul class="pro-list">
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    New employee onboarding
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Training & certification tracking
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Personnel management
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Requisitions and approvals
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Expense reporting and approvals
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 pro-list-wrap">
                        <h3>External <br> Processes</h3>
                        <ul class="pro-list">
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Accounts payables / receivables
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Support tickets
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Permitting
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Ordering and fulfillment
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Certification processing
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 pro-list-wrap">
                        <h3>Employee <br>Content</h3>
                        <ul class="pro-list">
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Corporate HR documents
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Past expenses
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Policies & Procedures
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    External transactions archive
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Legal and audit
                            </li>

                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12 pro-list-wrap">
                        <h3>External <br> Content</h3>
                        <ul class="pro-list">
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Inflight and archived contracts
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Public corporate docs
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Archived transaction artifacts/documentation
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Disclosed content
                            </li>
                            <li>
                                <span class="icon-check"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <style type="text/css">
                                        .st0{fill:#FFFFFF;}
                                    </style>
                                    <g>
                                        <g>
                                            <path class="st0" d="M500.1,83.7c-15.8-15.9-41.6-15.9-57.4,0L184.2,342.1L69.3,227.3c-15.9-15.9-41.6-15.9-57.4,0    s-15.9,41.6,0,57.4l143.6,143.6c7.9,7.9,18.3,11.9,28.7,11.9s20.8-4,28.7-11.9l287.2-287.2C516,125.3,516,99.5,500.1,83.7z"/>
                                        </g>
                                    </g>
                                    </svg></span>
                                    Personal customer content
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class=" users-love-section padding-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-12">
                        <div class="user-love-img">
                            <img src="{{ asset('landingpage/assets/images/user-love.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="user-love-right">
                            <div class="section-title">
                                <h2>Users will love you – IT will applaud you.</h2>
                            </div>
                            <p>Gather your business requirements, drag & drop a set of killer layouts containing powerful business tools, flick the switch and empower your multiple user communities to get it done!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial padding-top">
                <div class="top-shape">
                    <img src="{{ asset('landingpage/assets/images/rt.png')}}" alt="">
                </div>
                <div class="testimonial-section" >
                    <div class="container" >

                            <div class="testimonials-card" style = "max-width: 900px;padding-left: 20%;">
                                <div class="quote-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="400px" height="274.955" viewBox="0 0 301.691 274.955">
                                        <g id="Group_255" data-name="Group 255" transform="translate(-479.787 -863.211)">
                                          <path id="Path_130" data-name="Path 130" d="M530.12,864.711H674.629V996.95c0,76.394-65.658,139.716-123.587,139.716l.221-53.578c19.381,0,69.6-33.972,69.6-82.479l-90.3.079Z" transform="translate(105.35 0)" fill="none" stroke="#f68b1f" stroke-width="3"/>
                                          <path id="Path_131" data-name="Path 131" d="M481.292,864.711H625.8V996.95c0,76.394-65.658,139.716-123.587,139.716l.221-53.578c19.381,0,69.6-33.972,69.6-82.479l-90.3.079Z" transform="translate(0 0)" fill="none" stroke="#f68b1f" stroke-width="3"/>
                                        </g>
                                      </svg>
                                </div>
                                <div class="testimonials-content">
                                    <p>I saw it and fell in love. It’s so easy to use I don’t have to worry about user training! We’re even considering closing our Help Desk because we’re so bored now.</p>
                                    <p><b>– Kent, Large Finanical Services Group</b></p>
                                </div>
                            </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="site-footer">
        <img src="{{ asset('landingpage/assets/images/footer-mask.png')}}" class="back-mask" alt="">
        <div class="container">
            <div class="footer-top">
                <div class="d-flex justify-content-end">
                    <a href="https://imagesourceinc.com/contact-imagesource/" target="_blank" class="btn">CONTACT</a>
                </div>
            </div>
            <div class="footer-middle">
                <div class="ft-logo-col">
                    <a href="index.html">
                        <img src="{{ asset('landingpage/assets/images/footer-logo.png')}}" alt="">
                    </a>
                </div>
                <div class="footer-widget">
                    <ul>
                        <li><a href="https://imagesourceinc.com/" target="_blank">ILINX PLATFORM</a></li>
                        <li><a href="https://imagesourceinc.com/" target="_blank">SOLUTIONS</a></li>
                        <li><a href="https://imagesourceinc.com/" target="_blank">SMARTS</a></li>
                        <li><a href="https://imagesourceinc.com/" target="_blank">SUCCESS</a></li>
                        <li><a href="https://imagesourceinc.com/about-imagesource-team/" target="_blank">COMPANY</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <ul class="policy-links d-flex align-items-center justify-content-center">
                    <li><a href="https://imagesourceinc.com/privacy-policy-2/" target="_blank">Copyright</a></li>
                    <li><a href="https://imagesourceinc.com/privacy-policy-2/" target="_blank">Policy Privacy</a></li>
                    <li><a href="https://imagesourceinc.com/privacy-policy-2/" target="_blank">Terms and conditions</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <!--scripts start here-->
    <script src="{{ asset('landingpage/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('landingpage/assets/js/slick.min.js')}}" defer="defer"></script>
    <script src="{{ asset('landingpage/assets/js/custom.js')}}" defer="defer"></script>
    <!--scripts end here-->
</body>

</html>
