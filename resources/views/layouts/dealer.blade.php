<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login-register.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toaster.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
    @include('layouts.include.favicon')

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.css  "> -->

    @includeFirst(['validation'])
    <script>
        const APP_URL = "{{ url('') }}";
    </script>
</head>

<body>
    <header>
        <div class="custm-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <a class="navbar-brand" href="{{ route('welcome') }}">
                        <div class="header-logo">
                            <img src="{{ asset('assets/images/header-logo.png') }}  " alt="">
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
                                    <li> <a href="{{ route('welcome.index') }}" class="btn primary-btn">shop</a></li>
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
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('dealer.profile') }}">Profile</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('dealer.subscription.plan') }}">Subscription
                                                                Plan</a>
                                                        </li>
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
                <div class="banner-content-heading single-heading">
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
                        @include('dealer.sidebar')
                        @yield('content')
                    </div>

                </div>

            </div>
        </section>
    </main>
    @include('layouts.include.footer')
    @yield('footer')
    {{-- <footer class="footer-sec">
        <div class="footer-main">
            <div class="container">
                <div class="footer-small">
                    <p class="right-reserve">@2024 partsmatch.com All Right Reserved</p>
                </div>
            </div>
        </div>

    </footer> --}}
    @yield('modals')
    @yield('view_manager_modals')



    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/js/toaster.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}?ver={{ now() }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Check if the CSS file(s) are loaded
            var cssLoaded = false;

            // Function to check if CSS is loaded
            function checkCSSLoaded() {
                var stylesheets = document.styleSheets;
                for (var i = 0; i < stylesheets.length; i++) {
                    if (stylesheets[i].href && stylesheets[i].href.indexOf('your-style.css') !== -1) {
                        cssLoaded = true;
                        break;
                    }
                }
                return cssLoaded;
            }

            // Check CSS load status every 100 milliseconds
            var checkInterval = setInterval(function() {
                if (checkCSSLoaded()) {
                    clearInterval(checkInterval);
                    // CSS is loaded, now you can proceed with page load
                    console.log("CSS is loaded, proceeding with page load...");
                    // Here you can trigger the rest of your page load functionality
                }
            }, 100);
        });
    </script>
    @stack('scripts')
</body>

</html>
