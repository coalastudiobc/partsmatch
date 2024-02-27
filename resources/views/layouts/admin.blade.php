<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') | {{ config('app.name') }}</title>

    <!-- Favicon -->
    @include('layouts.include.favicon')
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href=" {{ asset('assets/css/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toaster.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin-over-ride.css') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/img/favicon/site.webmanifest') }}">

    @stack('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <script>
        const APP_URL = '{{ url('') }}';
    </script>
    @includeFirst(['validation'])

</head>

<body>

    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li>
                            <a href="javascript:void(0);" data-toggle="sidebar"
                                class="nav-link nav-link-lg collapse-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-align-justify">
                                    <line x1="21" y1="10" x2="3" y2="10"></line>
                                    <line x1="21" y1="6" x2="3" y2="6"></line>
                                    <line x1="21" y1="14" x2="3" y2="14"></line>
                                    <line x1="21" y1="18" x2="3" y2="18"></line>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image"
                                src="{{ !is_null($authUser->profile_url) ? Storage::url($authUser->profile_url) : asset('assets/img/user.png') }}"
                                class="user-img-radious-style">
                            <span class="d-sm-none d-lg-inline-block"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">{{ $authUser->name }}</div>
                            <a href="{{ route('admin.show') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href=" {{ route('change.password') }} " class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Change Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href=" {{ route('custom.logout') }} " class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i>Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('admin.dashboard') }}" class="d-inline-block">

                            <h1 style="line-height: 70px;text-transform: none;">{{ config('app.name') }}</h1>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="dropdown {{ 'admin.dashboard' == Request::route()->getName() ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                                    data-feather="monitor"></i><span>Dashboard</span></a>
                        </li>
                        
                        <li class="dropdown {{ Route::is('admin.cms.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.cms.index') }}" class="nav-link"><i
                                    data-feather="maximize"></i><span>Cms Management</span></a>
                        </li>
                        <li class="dropdown {{ Route::is('admin.category*') ? 'active' : '' }} ">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                data-feather="grid"></i><span>Category</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link " href="{{ route('admin.category.index') }}">Categories</a></li>
                                <li><a class="nav-link " href="{{ route('admin.category.add') }}">Add Category</a></li>
                            </ul>
                       </li>
                        {{-- <li class="dropdown {{ Route::is('admin.users.*') ? 'active' : '' }}">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="user"></i><span>Dealers</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link " href="{{ route('admin.users.all') }}">Dealers</a></li>
                                <li><a class="nav-link " href="{{ route('admin.users.deleted') }}">Deleted Users</a>
                                </li>
                            </ul>
                        </li> --}}
                        {{-- <li class="dropdown {{ Route::is('admin.packages.*') ? 'active' : '' }} ">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="briefcase"></i><span>Subscription Plans</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link " href="{{ route('admin.packages.all') }}">Subscription
                                        Plans</a></li>
                                <li><a class="nav-link " href="{{ route('admin.packages.add') }}">Add Subscription
                                        Plan</a></li>
                            </ul>
                        </li>--}}
                       
                        {{-- <li class="dropdown {{ Route::is('admin.cms.*') ? 'active' : '' }}">
                            <a href="#" class="menu-toggle nav-link has-dropdown"><i
                                    data-feather="maximize"></i><span>Cms Management</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link " href="{{ route('admin.cms.index') }}">All Cms Pages</a></li>
                                <li><a class="nav-link " href="{{ route('admin.cms.deleted') }}">Deleted Cms
                                        Pages</a></li>
                            </ul>
                        </li> --}}
                        {{--
                        <li class="dropdown {{ Route::is('admin.payments.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.payments.all') }}" class="nav-link">
                                <i class="fas fa-money-bill ml-0"></i>
                                <span>Payments History</span></a>
                        </li>
                        <li class="dropdown {{ Route::is('admin.settings.*') ? 'active' : '' }}">
                            <a href="{{ route('admin.settings.view') }}" class="nav-link"><i
                                    data-feather="settings"></i><span>Stripe Setting</span></a>
                        </li> --}}
                    </ul>
                </aside>
            </div>

            @yield('content')
            <footer class="main-footer">
                <div class="footer-left">
                    <a style="text-decoration:none" href="{{ route('admin.dashboard') }}">{{ config('app.name') }}</a>
                </div>
                <div class="footer-right"></div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('assets/js/toaster.min.js') }}"></script>
    <script src="{{ asset('assets/js/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/additional_method.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}?ver={{ now() }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    @stack('scripts')
    @yield('modal')
</body>

</html>
