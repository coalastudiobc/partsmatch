<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/login-register.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toaster.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/slick-theme.css') }}">
    @include('layouts.include.favicon')

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.css  "> -->

    @includeFirst(['validation'])

</head>

<body>
    <header>
        <div class="custm-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <a class="navbar-brand" href="{{ route('welcome') }}">
                        <div class="header-logo">
                            <img src="{{ asset('assets/admin/images/header-logo.png') }}  " alt="">
                        </div>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse ms-auto" id="navbarNav">
                        <div class="custm-nav-menu login-nav">
                            @auth
                                <ul class="navbar-nav">
                                    <li>
                                        <div class="nav-profile">
                                            <div class="nav-profile-img">

                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{ Storage::url($authUser->profile_picture_url) }}"
                                                            alt="">
                                                        {{ $authUser->name }}
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('admin.profile.view') }}">Profile</a></li>
                                                        {{-- <li><a class="dropdown-item" href="#">Another action</a></li> --}}
                                                        <li><a class="dropdown-item" href="{{ route('logout') }}">
                                                                Logout
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                    </li>
                                </ul>
                            @endauth
                        </div>

                    </div>
                </nav>
            </div>
        </div>
    </header>
    <section class="banner-content-sec">
        <div class="container">
            <div class="banner-content-wrapper">
                <div class="banner-content-heading">
                    <h2>
                        @yield('heading')
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <main>
        <section class="page-content-sec">
            <div class="container">
                <div class="page-content-wrapper">
                    <div class="dc-content-wrapper">
                        @include('admin.sidebar')
                        @yield('content')
                    </div>

                </div>
            </div>
        </section>
    </main>

    <footer class="footer-sec">
        <div class="footer-main">
            <div class="container">
                <div class="footer-small">
                    <p class="right-reserve">@2024 partsmatch.com All Right Reserved</p>
                </div>
            </div>
        </div>

    </footer>
    <script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/admin/js/slick.js') }}"></script>
    <script src="{{ asset('assets/admin/js/validate.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/toaster.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
    <script src="{{ asset('assets/admin/js/common.js') }}?ver={{ now() }}"></script>
    @stack('scripts')
</body>

</html>
