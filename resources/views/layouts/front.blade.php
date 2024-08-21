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
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.1/css/select2.min.css" rel="stylesheet" />


    @yield('extra_css')
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
                <nav class="navbar  bg-body-tertiary">
                    <a class="navbar-brand" href="{{ route('welcome') }}">
                        <div class="header-logo">
                            <img src="{{ asset('assets/images/header-logo.svg') }}  " alt="">
                        </div>
                    </a>
                    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}
                    @if (!in_array(Route::current()->getName(), ['register','login']))  
                        <div class="navbar-serch-box">
                            <ul>
                                <li>
                                    <form action="{{ route('search') }}" method="GET">
                                        <div class="pro-search-box">
                                            <input type="text" name="globalquery" class="form-control" value="{{request()->has('search_parameter') ? request()->search_parameter : ''}}"
                                            placeholder="Search">
                                            <button type="submit" class="btn primary-btn"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                        </div>
                    @endif
                    <div class="" id="navbarNav">

                        <div class="custm-nav-menu login-nav">
                            <ul class="navbar-nav">

                                @auth
                                    @if (!auth()->user()->hasRole('User'))
                                        <li class="nav-item">
                                            <a class="nav-link dasboard-btn" style="color: #fff; padding: 3px 6px !important;" title="Dashboard" aria-current="page"
                                                href="{{ route('redirect-to-dashboard') }}">
                                                <span>
                                                    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="14" height="14">
                                                        <path d="m9,9H2c-1.103,0-2-.897-2-2v-2C0,2.243,2.243,0,5,0h4c1.103,0,2,.897,2,2v5c0,1.103-.897,2-2,2Zm10,15h-4c-1.103,0-2-.897-2-2v-5c0-1.103.897-2,2-2h7c1.103,0,2,.897,2,2v2c0,2.757-2.243,5-5,5Zm3-11h-7c-1.103,0-2-.897-2-2V2c0-1.103.897-2,2-2h4c2.757,0,5,2.243,5,5v6c0,1.103-.897,2-2,2Zm-13,11h-4c-2.757,0-5-2.243-5-5v-6c0-1.103.897-2,2-2h7c1.103,0,2,.897,2,2v9c0,1.103-.897,2-2,2Z" fill="CurrentColor" />
                                                    </svg>
                                                </span>
                                                Dashboard
                                            </a>
                                        </li>
                                    @endif
                                @endauth
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
                                                                href="{{ route('Dealer.profile') }}"><i
                                                                    class="fa-solid fa-user"></i> Profile</a>
                                                        </li>
                                                        @if (auth()->user()->hasRole('User'))
                                                        <li><a class="dropdown-item"
                                                            href="{{ route('Dealer.myorder.orderlist') }}"><i
                                                            class="fa-solid fa-user"></i> My Orders</a>
                                                        </li>
                                                        @endif
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('Dealer.subscription.plan') }}"><i
                                                                    class="fa-solid fa-crown"></i> Subscription
                                                                Plan</a>
                                                        </li>
                                                        {{-- <li><a class="dropdown-item" href="#">Another action</a></li> --}}
                                                        <li><a class="dropdown-item" href="{{ route('logout') }}">
                                                                <i class="fa-solid fa-right-from-bracket"></i> Logout
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
        {{-- Loader --}}
        <div id="fullPageLoader" class="page-loader d-none">
            <div class="sk-circle">
                <div class="sk-circle1 sk-child"></div>
                <div class="sk-circle2 sk-child"></div>
                <div class="sk-circle3 sk-child"></div>
                <div class="sk-circle4 sk-child"></div>
                <div class="sk-circle5 sk-child"></div>
                <div class="sk-circle6 sk-child"></div>
                <div class="sk-circle7 sk-child"></div>
                <div class="sk-circle8 sk-child"></div>
                <div class="sk-circle9 sk-child"></div>
                <div class="sk-circle10 sk-child"></div>
                <div class="sk-circle11 sk-child"></div>
                <div class="sk-circle12 sk-child"></div>
            </div>
        </div>
        {{-- end loader --}}
        @yield('modals')
    </main>
    @yield('footer')
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/toaster.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick.js') }}"></script>
    <script src="{{ asset('assets/js/validate.min.js') }}"></script>
    <script src="{{ asset('assets/js/common.js') }}?ver={{ now() }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
    function capitalizeFirst(string) {
        if (!string) return string; // handle empty or null strings
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
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
