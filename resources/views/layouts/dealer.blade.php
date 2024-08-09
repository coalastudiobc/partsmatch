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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- jQuery UI JS -->
    @include('layouts.include.favicon')

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick-theme.min.css"> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.8/slick.css  "> -->

    @includeFirst(['validation'])
    <script>
        const APP_URL = "{{ url('') }}";
        const CSRF = "{{ csrf_token() }}";
    </script>
</head>

<body>
    <header>
        <div class="custm-nav dasboard-nav">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-body-tertiary">
                    <a class="navbar-brand" href="{{ route('welcome') }}">
                        <div class="header-logo">
                            <img src="{{ asset('assets/images/header-logo.svg') }}  " alt="">
                        </div>
                    </a>
                    <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                    </button> -->
                    <div class="navbar-collapse" id="navbarNav">
                        <div class="custm-nav-menu login-nav">
                            @auth
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link btn secondary-btn sm-btn shop-btn" style="color: #fff; padding: 3px 6px !important;" aria-current="page" href="{{ route('welcome.index') }}">
                                            <i class="fa-solid fa-shop"></i>
                                            Shop
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="{{ route('welcome.index') }}" class="btn primary-btn" title="shop">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17"
                                                viewBox="0 0 17 17" fill="#272643">
                                                <g opacity="1">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M2.45698 4.2498H4.5268V5.37372C4.5268 5.56962 4.68561 5.72843 4.88151 5.72843C5.07741 5.72843 5.23622 5.56962 5.23622 5.37372V4.2498H8.95125V5.37372C8.95125 5.56962 9.11006 5.72843 9.30596 5.72843C9.50186 5.72843 9.66067 5.56962 9.66067 5.37372V4.2498H11.7305C11.9604 4.2498 12.1509 4.42362 12.172 4.65259L12.5056 8.28285C12.3478 8.26645 12.1876 8.25791 12.0254 8.25791C9.4907 8.25791 7.43589 10.3127 7.43589 12.8474C7.43589 13.4709 7.56044 14.0651 7.78559 14.607H2.05227C1.79923 14.607 1.58138 14.5109 1.41085 14.324C1.24029 14.137 1.16452 13.9113 1.18766 13.6593L2.01548 4.65259C2.03653 4.42362 2.22702 4.2498 2.45698 4.2498ZM4.5268 4.19139V2.92689C4.5268 2.22062 4.81547 1.57881 5.28054 1.11373C5.74562 0.648653 6.38744 0.359985 7.0937 0.359985C7.79996 0.359985 8.44178 0.648653 8.90686 1.11373C9.37193 1.57881 9.6606 2.22066 9.6606 2.92689V4.19139H8.95122V2.92689C8.95122 2.41645 8.74214 1.95211 8.40529 1.6153C8.06844 1.27845 7.60417 1.06937 7.0937 1.06937C6.58327 1.06937 6.11896 1.27845 5.78211 1.6153C5.44526 1.95211 5.23619 2.41642 5.23619 2.92689V4.19139H4.5268ZM12.0254 9.05479C9.93077 9.05479 8.23273 10.7528 8.23273 12.8474C8.23273 14.9421 9.93077 16.6401 12.0254 16.6401C14.12 16.6401 15.8181 14.9421 15.8181 12.8474C15.8181 10.7528 14.12 9.05479 12.0254 9.05479ZM10.1715 13.072L11.3062 14.114C11.4652 14.2603 11.7113 14.2526 11.8608 14.0984L13.8855 12.1598C14.0437 12.0077 14.0486 11.7561 13.8964 11.598C13.7443 11.4398 13.4927 11.435 13.3346 11.5871L11.57 13.2766L10.7101 12.4868C10.5485 12.3381 10.2969 12.3486 10.1482 12.5101C9.99947 12.6717 10.0099 12.9233 10.1715 13.072Z"
                                                        fill="#272643"></path>
                                                </g>
                                            </svg>
                                        </a>
                                    </li> --}}
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
                                                                    class="fa-solid fa-user"></i> Profile</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('Dealer.subscription.plan') }}"><i
                                                                    class="fa-solid fa-crown"></i> Subscription
                                                                Plan</a>
                                                        </li>
                                                        <li><a class="dropdown-item" href="{{ route('logout') }}">
                                                                <i class="fa-solid fa-right-from-bracket"></i> Logout
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                    </li>
                                    <li>
                                        <div class="sidebar-opener">
                                            <i class="fa-solid fa-bars"></i>
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


            <div class="page-content-wrapper">
                <div class="dc-content-wrapper">
                    @include('dealer.sidebar')
                    @yield('content')
                </div>

            </div>

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
    <script src="{{ asset('assets/js/additional_method.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/common.js') }}?ver={{ now() }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
jQuery(document).ready(function (e) {
    jQuery('.sidebar-opener').on('click',function (event) {
        jQuery('.dashboard-left-box').addClass('open');
        jQuery('.cross-sidebar').removeClass('open');
    })
    jQuery('.cross-sidebar').on('click',function (event) {
        jQuery('.dashboard-left-box').removeClass('open');
    })
})



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
    <script>
        // jQuery(document).ready(function (e) {
        //     jQuery('#ordermanagemebt').on('click',function (e) {
                // jQuery('.analyics-tabs-btns').removeClass('active');
                // jQuery(this).addClass('active');
        //     })
        // })
    </script>
    @stack('scripts')
</body>

</html>
