<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="semi-dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" />
    {{-- select2 --}}
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="{{ asset('assets/plugins/jquery-toast-plugin-master/src/jquery.toast.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/import.css') }}" />
    @stack('styles')

    @vite('resources/js/app.js')
</head>

<body>

    <div class="wrapper">
        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand">
                <div class="mobile-toggle-icon d-xl-none">
                    <i class="bi bi-list"></i>
                </div>
                <div class="top-navbar d-none d-xl-block">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    </ul>
                </div>
                <div class="search-toggle-icon d-xl-none ms-auto">
                    <i class="bi bi-search"></i>
                </div>
                <div class="searchbar d-none d-xl-flex ms-auto">

                </div>
                <div class="top-navbar-right ms-3">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                                data-bs-toggle="dropdown">
                                <div class="user-setting d-flex align-items-center gap-1">
                                    <img src="{{ asset('images/avatar.png') }}" class="user-img" alt="avatar" />
                                    <div class="user-name d-none d-sm-block">{{ auth()->user()->name }}</div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('images/avatar.png') }}" alt class="rounded-circle"
                                                width="60" height="60" />
                                            <div class="ms-3">
                                                <h6 class="mb-0 dropdown-user-name">{{ auth()->user()->name }}</h6>
                                                <small class="mb-0 dropdown-user-designation text-secondary">
                                                    {{ auth()->user()->level }}
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('akun.index') }}">
                                        <div class="d-flex align-items-center">
                                            <div class="setting-icon">
                                                <i class="bi bi-person-badge-fill"></i>
                                            </div>
                                            <div class="setting-text ms-3">
                                                <span>Pengaturan Akun</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" :href="route('logout')" method="post" as="button"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <div class="d-flex align-items-center">
                                                <div class="setting-icon">
                                                    <i class="bi bi-lock-fill"></i>
                                                </div>
                                                <div class="setting-text ms-3">
                                                    <span>Logout</span>
                                                </div>
                                            </div>
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>



                    </ul>
                </div>
            </nav>
        </header>
        <!--end top header-->

        <!--start sidebar -->
        <x-navigation />
        <!--start sidebar -->

        <!--start content-->
        <main class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3 radius-8 mx-1">
                <!-- style="border: 1px solid #e2e3e4; padding: 8px 13px; background-color:#fff"> -->
                <div class="breadcrumb-title pe-3">{{ $title }}</div>
                <div class="ps-3">
                    @if ($crumbs)
                        <nav aria-label="breadcrumb">
                            <x-crumbs :crumbs=$crumbs />
                        </nav>
                    @endif
                </div>

            </div>
            <!--end breadcrumb-->
            {{ $slot }}
        </main>
        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top">
            <i class="bx bxs-up-arrow-alt"></i>
        </a>
        <!--End Back To Top Button-->


    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/plugins/notifications/js/notifications.min.js') }}"></script>

    {{-- select 2 --}}
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    {{-- alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-toast-plugin-master/src/jquery.toast.js') }}">
    </script>

    {{-- custom --}}
    <script type="text/javascript" src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        @if (session()->get('success'))
            $.toast({
                heading: 'Success',
                text: '{{ session()->get('success') }}',
                icon: 'success',
                position: {
                    top: 80,
                    right: 50
                },
                showHideTransition: 'plain',
                hideAfter: 5000
            })
        @endif
        @if (session()->get('error'))
            $.toast({
                heading: 'Error',
                text: '{{ session()->get('error') }}',
                icon: 'error',
                position: {
                    top: 80,
                    right: 50
                },
                showHideTransition: 'plain',
                hideAfter: 5000
            })
        @endif
        @if (session()->get('info'))
            $.toast({
                heading: 'Info',
                text: '{{ session()->get('info') }}',
                icon: 'info',
                position: {
                    top: 80,
                    right: 50
                },
                showHideTransition: 'plain',
                hideAfter: 5000
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
                position: {
                    top: 80,
                    right: 50
                },
                showHideTransition: 'plain',
                hideAfter: 7000
            })
        @endif

        @if (session()->get('open-modal'))
            $(document).ready(function() {
                $('#{{ session()->get('open-modal') }}').modal('show');
                // console.log("test");
            });
        @endif
        @if (session()->get('edit-modal'))
            $(document).ready(function() {

                $('#{{ session()->get('edit-modal') }}').modal('show');
                let action =  "{{ session()->get('action-modal') }}";
                let load_url = "{{ session()->get('load_url') }}";
                $('#form')[0].reset();
                $('#editModal').find('#action_url').val(action);
                $('#editModal').find('#load_url').val(load_url);
                $('#editModal').modal('show').find('form').attr('action', action);
                $('#editModal').modal('show').find('.modal-body').load(load_url, function() {});

                console.log("{{ $errors }}");
            });
        @endif
    </script>

    @stack('scripts')

</body>

</html>
