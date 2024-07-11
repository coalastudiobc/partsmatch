<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login-register.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toaster.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}">
    @include('layouts.include.favicon')
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.css  "> -->
    <script>
        const APP_URL = "{{ url('') }}";
    </script>
</head>

<body>
    <div id="overlay">
        <div id="loader"></div>
    </div>
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
                            <ul class="navbar-nav">
                                <li>
                                    <form action="{{ route('search') }}" method="GET">
                                        <div class="pro-search-box">
                                            <input type="text" name="globalquery" class="form-control" value=""
                                                placeholder="Search...">
                                            <button type="submit" class="btn primary-btn"><i
                                                    class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </form>
                                </li>
                                @auth
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page"
                                            href="{{ route('redirect-to-dashboard') }}">
                                            Dashboard
                                        </a>
                                    </li>
                                @endauth
                                @guest
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="{{ route('welcome') }}">

                                            Home
                                        </a>
                                    </li>
                                @endguest
                                {{-- <li class="nav-item">
                                    <a class="nav-link" aria-current="page"
                                        href="{{ route('view', ['slug' => 'about-us']) }}">About Us</a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link" aria-current="page"
                                        href="{{ route('view', ['slug' => 'about-us']) }}">About Us</a>
                                </li> --}}
                                {{-- @auth

                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page"
                                            href="{{ route('welcome.index') }}">Home</a>
                                    </li> --}}
                                {{-- <li class="nav-item">
                                        <a class="nav-link" aria-current="page"
                                            href="{{ route('dealer.chat.view') }}">chat</a>
                                    </li> --}}

                                {{-- @endauth --}}
                            </ul>
                            @guest
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link btn secondary-btn login-btn" aria-current="page"
                                            href="{{ route('login') }}">
                                            Login
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link primary-btn signup-btn" aria-current="page"
                                            href="{{ route('register') }}">
                                            Sign Up
                                        </a>
                                    </li>
                                </ul>
                            @endguest
                            @auth

                                <ul class="navbar-nav">
                                    <div class="cart-icon">
                                        @include('components.cart-icon')
                                    </div>
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
                                                                href="{{ route('dealer.profile') }}">Profile</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('dealer.subscription.plan') }}">Subscription
                                                                Plan</a>
                                                        </li>
                                                        {{-- <li><a class="dropdown-item" href="#">Another action</a></li> --}}
                                                        <li><a class="dropdown-item" href="{{ route('logout') }}">
                                                                Logout
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
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

    <main>
        @yield('content')
    </main>
    @yield('footer')
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/toaster.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}?ver={{ now() }}"></script>
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
