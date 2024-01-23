<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title> {{ config('app.name') }} {{ isset($title) ? '| '. $title : '' }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">
        <meta name="description" content="{{ env("APP_DESCRIPTION") }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <x-fav-icon/>
        <!-- Disable tap highlight on IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <link href="{{ asset('assets/backend/styles/css/icons.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/backend/styles/css/base.min.css') }}" rel="stylesheet">
        <link href="{{asset('assets/backend/vendors/jquery-toast-plugin-master/src/jquery.toast.css')}}" rel="stylesheet" />

        {{-- select2 --}}
        <link href="{{asset('assets/backend/vendors/select2/css/select2.min.css')}}" rel="stylesheet" />

        {{-- alert --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">

        <link href="{{ asset('assets/backend/styles/css/custom.css') }}" rel="stylesheet">
        @stack('styles')
    </head>
    <body>
        <div class="app-container app-theme-white body-tabs-shadow_  body-tabs-line fixed-header fixed-sidebar fixed-footer">
            <div class="app-header header-shadow">
                <div class="app-header__logo">
                    <div class="logo-src" style="height:50px !important; width:200px !important;"></div>
                    <div class="header__pane ms-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="app-header__content">
                    <div class="app-header-right">
                        <div class="header-dots">
                           {{-- Notifications --}}
                            <div class="dropdown">
                                <button type="button" aria-haspopup="true" aria-expanded="false"
                                    data-bs-toggle="dropdown" class="p-0 me-2 btn btn-link">
                                    {{-- <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                        <span class="icon-wrapper-bg bg-danger"></span>
                                        <i class="icon text-danger icon-anim-pulse ion-android-notifications"></i>
                                        <span class="badge rounded-pill bg-danger p-1" style="position: absolute; top:-.2rem; right:-10px; font:menu; font-size:10px; " >1</span>
                                    </span> --}}
                                    <span class="icon-wrapper icon-wrapper-alt rounded-circle">
                                        <span class="icon-wrapper-bg bg-secondary"></span>
                                        <i class="icon text-secondary ion-android-notifications"></i>
                                    </span>
                                </button>
                                <x-notification-body class="dropdown-menu-xl rm-pointers dropdown-menu  dropdown-menu-right"/>

                             
                            </div>                         
                        </div>
                        <div class="header-btn-lg pe-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                                <img width="42" class="rounded-circle" src="{{ asset('assets/backend/images/avatar.png') }}" alt="">
                                                <i class="fa fa-angle-down ms-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true"
                                                class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right pb-0">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-info">
                                                        <div class="menu-header-image opacity-2" style="background-image: url('{{ asset('assets/backend/images/dropdown-header/abstract9.jpg') }}');"></div>
                                                        <div class="menu-header-content text-start">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left me-3">
                                                                        <img width="42" class="rounded-circle" src="{{ asset('assets/backend/images/avatar.png') }}" alt="">
                                                                    </div>
                                                                    <div class="widget-content-left">
                                                                        <div class="widget-heading">{{ auth()->user()->name }}</div>
                                                                        <div class="widget-subheading opacity-8">{{ ucwords(auth()->user()->roles->first()->name) }}</div>
                                                                    </div>
                                                                    <div class="widget-content-right me-2">
                                                                        <form method="POST" action="{{ route('logout') }}">
                                                                            @csrf
                                                                            <button 
                                                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                                                                class="btn-pill btn-shadow btn-shine btn btn-focus"
                                                                            >
                                                                                Logout
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="scroll-area-xs" style="height: 150px;">
                                                    <div class="scrollbar-container ps">
                                                        <ul class="nav flex-column">
                                                            
                                                            <li class="nav-item-header nav-item">
                                                                Akun Saya
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="{{ route('akun.index') }}" class="nav-link">
                                                                    <i class="fa fa-cog fa-fw me-1"></i> 
                                                                    <span>Pengaturan</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="" class="nav-link">
                                                                    <i class="fa fa-history fa-fw me-1"></i> 
                                                                    <span>Logs</span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <form method="POST" action="{{ route('logout') }}">
                                                                    @csrf
                                                                    <a 
                                                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                                                        class="nav-link"
                                                                    >
                                                                        <i class="fa fa-power-off fa-fw me-1"></i> 
                                                                       <span> Logout</span>
                                                                    </a>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="nav flex-column">
                                                    <li class="nav-item-divider mb-0 nav-item"></li>
                                                </ul>

                                                <div class="dropdown-menu-header m-0" >
                                                    <div class="dropdown-menu-header-inner bg-light" style="border-radius:0; border-bottom-left-radius:0.25rem !important; border-bottom-right-radius:0.25rem;">
                                                        <div class="menu-header-image opacity-2" style="background-image: url('{{ asset('assets/backend/images/dropdown-header/abstract8.jpg') }}');"></div>
                                                        <div class="menu-header-content text-start">
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left me-3">
                                                                        <img width="42" class="rounded-circle" src="{{ asset('assets/backend/images/avatar.png') }}" alt="">
                                                                    </div>
                                                                    <div class="widget-content-left">
                                                                        <div class="widget-heading text-muted">Alina Mcloughlin</div>
                                                                        <div class="widget-subheading opacity-8 text-muted">A short profile description</div>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left  ms-3 header-user-info">
                                        <div class="widget-heading text-truncate" style="max-width: 200px;">{{ auth()->user()->name }}</div>
                                        <div class="widget-subheading"> {{ ucwords(auth()->user()->roles->first()->name) }}</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ms-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="mt-2" >
                                    <a href="{{ route('dashboard') }}">
                                        <i class="metismenu-icon pe-7s-browser"></i>
                                        Dashboards
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Data Master</li>
                                <li class="mt-2" >
                                    <a href="{{ route('user.index') }}">
                                        <i class="metismenu-icon pe-7s-user"></i>
                                        Manajemen User
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon pe-7s-rocket"></i>
                                        Dashboards
                                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="{{ route('dashboard') }}">
                                                <i class="metismenu-icon"></i>
                                                Analytics
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboards-commerce.html">
                                                <i class="metismenu-icon"></i>
                                                Commerce
                                            </a>
                                        </li>
                                        <li>
                                            <a href="dashboards-sales.html">
                                                <i class="metismenu-icon"></i>
                                                Sales
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="metismenu-icon"></i>
                                                Minimal
                                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="dashboards-minimal-1.html">
                                                        <i class="metismenu-icon"></i>
                                                        Variation 1
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="dashboards-minimal-2.html">
                                                        <i class="metismenu-icon"></i>
                                                        Variation 2
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="dashboards-crm.html">
                                                <i class="metismenu-icon"></i>
                                                CRM
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                               
                                <li class="app-sidebar__heading">Menu Utama</li>
                              
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    @if($icon)
                                        <div class="page-title-icon">
                                            <i class="{{ $icon }} icon-gradient bg-malibu-beach"></i>
                                        </div>
                                    @endif
                                    <div>
                                        {{ $title ? $title : 'Page' }}
                                        <div class="page-title-subheading">
                                            {{ $subTitle ? $subTitle : '' }}
                                        </div>
                                    </div>
                                </div>
                                @if($crumbs)
                                    <div class="page-title-actions">
                                        <x-crumbs :crumbs=$crumbs/>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{ $slot }}
                    </div>
                    <div class="app-wrapper-footer ">
                        <div class="app-footer bg-white">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <div class="footer-dots">
                                        <div class="dropdown">
                                            <a aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown" class="dot-btn-wrapper">
                                                <i class="dot-btn-icon lnr-bullhorn icon-gradient bg-mean-fruit"></i>
                                                <div class="badge badge-dot badge-abs badge-dot-sm bg-danger">Notifications</div>
                                            </a>
                                           <x-notification-body class="dropdown-menu-xl rm-pointers dropdown-menu" group="g2"/>
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="app-footer-right">
                                    <ul class="header-megamenu nav">
                                        <li class="nav-item">
                                            <a data-bs-placement="top" rel="popover-focus" data-offset="300"
                                                data-toggle="popover-custom" class="nav-link">
                                                &copy; {{ env('APP_AUTHOR') }} 2022
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="body-loading d-none bg-transparent" style="background-color: transparent !important;">
            <div class="loader bg-transparent no-shadow p-0" style="background-color: transparent !important;">
                <div class="ball-grid-pulse bg-transparent" style="background-color: transparent !important;">
                    <div class="bg-white"></div>
                    <div class="bg-white"></div>
                    <div class="bg-white"></div>
                    <div class="bg-white"></div>
                    <div class="bg-white"></div>
                    <div class="bg-white"></div>
                    <div class="bg-white"></div>
                    <div class="bg-white"></div>
                    <div class="bg-white"></div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{ asset('assets/backend/vendors/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/backend/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/backend/vendors/metismenu/dist/metisMenu.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/backend/vendors/perfect-scrollbar/dist/perfect-scrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/backend/vendors/jquery-toast-plugin-master/src/jquery.toast.js')}}"></script>
        <script type="text/javascript" src="{{ asset('assets/backend/vendors/block-ui/jquery.blockUI.js') }}"></script>

        {{-- select2 --}}
	    <script src="{{asset('assets/backend/vendors/select2/js/select2.min.js')}}"></script>
        {{-- alert --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>


        {{-- custom --}}
        <script type="text/javascript" src="{{ asset('assets/backend/js/scrollbar.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/backend/js/app.js') }}"></script>
       

        @stack('scripts')
        <script>
        @if(session()->get('success')) 
            $.toast({
                heading: 'Success',
                text: '{{ session()->get('success') }}',
                icon: 'success',
                position:{top:80, right:50},
                showHideTransition: 'plain',
                hideAfter : 5000
            })
        @endif
        @if(session()->get('error')) 
            $.toast({
                heading: 'Error',
                text: '{{ session()->get('error') }}',
                icon: 'error',
                position:{top:80, right:50},
                showHideTransition: 'plain',
                hideAfter : 5000
            })
        @endif
        @if(session()->get('info')) 
            $.toast({
                heading: 'Info',
                text: '{{ session()->get('info') }}',
                icon: 'info',
                position:{top:80, right:50},
                showHideTransition: 'plain',
                hideAfter : 5000
            })
        @endif

        @if ($errors->any())
            
            $.toast({
                heading: 'Error',
                text: `
                    <ol>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ol>
                `,
                icon: 'error',
                position:{top:80, right:50},
                showHideTransition: 'plain',
                hideAfter : 7000
            })
        @endif

        @if(session()->get('open-modal')) 
            $(document).ready(function() {
                $('#{{ session()->get('open-modal') }}').modal('show')
            });
        @endif
        
       
       
        </script>


    </body>
</html>
