@extends('layouts.front')
@section('title', 'welcome')
@section('content')
    <section class="hero-section">
        <div class="container">
            <x-alert-component />

            <div class="hero-wrapper">
                <div class="slick-carousel">
                    <!-- Inside the containing div, add one div for each slide -->
                    <div>
                        <!-- You can put an image or text inside each slide div -->
                        <div class="hero-main">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="hero-txt">
                                        <div class="hero-badge">
                                            Lorem ipsum dolor sit amet
                                        </div>
                                        <h4>New Top Product</h4>
                                        <h1>High Quality</h1>
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page when looking at its layout.</p>
                                        <a href="#" class="btn secondary-btn">
                                            Shop Now
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_110_878)">
                                                    <path
                                                        d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z"
                                                        fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_110_878">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="hero-img">
                                        <img src="images/hero-banner-img.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="hero-main">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="hero-txt">
                                        <div class="hero-badge">
                                            Lorem ipsum dolor sit amet
                                        </div>
                                        <h4>New Top Product</h4>
                                        <h1>High Quality</h1>
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page when looking at its layout.</p>
                                        <a href="#" class="btn secondary-btn">
                                            Shop Now
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_110_878)">
                                                    <path
                                                        d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z"
                                                        fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_110_878">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="hero-img">
                                        <img src="images/hero-banner-img.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="hero-main">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="hero-txt">
                                        <div class="hero-badge">
                                            Lorem ipsum dolor sit amet
                                        </div>
                                        <h4>New Top Product</h4>
                                        <h1>High Quality</h1>
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page when looking at its layout.</p>
                                        <a href="#" class="btn secondary-btn">
                                            Shop Now
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_110_878)">
                                                    <path
                                                        d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z"
                                                        fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_110_878">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="hero-img">
                                        <img src="images/hero-banner-img.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="hero-main">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="hero-txt">
                                        <div class="hero-badge">
                                            Lorem ipsum dolor sit amet
                                        </div>
                                        <h4>New Top Product</h4>
                                        <h1>High Quality</h1>
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page when looking at its layout.</p>
                                        <a href="#" class="btn secondary-btn">
                                            Shop Now
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_110_878)">
                                                    <path
                                                        d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z"
                                                        fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_110_878">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="hero-img">
                                        <img src="images/hero-banner-img.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="hero-main">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <div class="hero-txt">
                                        <div class="hero-badge">
                                            Lorem ipsum dolor sit amet
                                        </div>
                                        <h4>New Top Product</h4>
                                        <h1>High Quality</h1>
                                        <p>It is a long established fact that a reader will be distracted by the
                                            readable content of a page when looking at its layout.</p>
                                        <a href="#" class="btn secondary-btn">
                                            Shop Now
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 20 20" fill="none">
                                                <g clip-path="url(#clip0_110_878)">
                                                    <path
                                                        d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z"
                                                        fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_110_878">
                                                        <rect width="20" height="20" fill="white" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="hero-img">
                                        <img src="images/hero-banner-img.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="prev-btn">
                    <i class="fa-solid fa-angle-left"></i>
                </div>
                <div class="next-btn">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
                <div class="search-box">
                    <input type="text" placeholder="part number">
                    <a href="#" class="btn primary-btn">Search</a>
                </div>
            </div>
        </div>
    </section>
    <section class="top-categories-sec">
        <div class="container">
            <div class="top-categories-wrapper">
                <h2 class="sec-heading">Top Categories</h2>
                <div class="categories-boxes">
                    @foreach ($category as $category)
                        <div class="categories-box">
                            <img src="images/categorie1.png" alt="">
                            <p>{{ $category->name }}</p>
                        </div>
                    @endforeach
                    {{-- <div class="categories-box">
                        <img src="images/categorie2.png" alt="">
                        <p>Truck</p>
                    </div>
                    <div class="categories-box">
                        <img src="images/categorie3.png" alt="">
                        <p>Bus</p>
                    </div>
                    <div class="categories-box">
                        <img src="images/categorie4.png" alt="">
                        <p>Motor Bikes</p>
                    </div>
                    <div class="categories-box">
                        <img src="images/categorie5.png" alt="">
                        <p>Sports Bikes</p>
                    </div>
                    <div class="categories-box">
                        <img src="images/categorie6.png" alt="">
                        <p>Train</p>
                    </div>
                    <div class="categories-box">
                        <img src="images/categorie7.png" alt="">
                        <p>Crane</p>
                    </div>
                    <div class="categories-box">
                        <img src="images/categorie8.png" alt="">
                        <p>Cycle</p>
                    </div> --}}
                </div>
                <a href="#" class="btn secondary-btn view-btn">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                        fill="none">
                        <g clip-path="url(#clip0_110_878)">
                            <path
                                d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z"
                                fill="white" />
                        </g>
                        <defs>
                            <clipPath id="clip0_110_878">
                                <rect width="20" height="20" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    <section class="collection-sec">
        <div class="container">
            <div class="collection-wrapper">
                <h2 class="sec-heading">Collections</h2>
                <p class="sec-para">It is a long established fact that a reader will be distracted by the readable
                    content.</p>
            </div>
            <div class="collection-main">
                <div class="collect-tab-btns">
                    <a href="#" class="btn primary-btn filter-btn">
                        Filter
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                            fill="none">
                            <g clip-path="url(#clip0_162_3174)">
                                <path
                                    d="M0.4375 2.46796H7.09857C7.29933 3.38177 8.11538 4.06779 9.0886 4.06779C10.0618 4.06779 10.8779 3.38179 11.0786 2.46796H13.5625C13.8041 2.46796 14 2.27207 14 2.03046C14 1.78886 13.8041 1.59296 13.5625 1.59296H11.0784C10.8773 0.679629 10.0601 -0.00683594 9.0886 -0.00683594C8.11658 -0.00683594 7.2998 0.67952 7.09874 1.59296H0.4375C0.195891 1.59296 0 1.78886 0 2.03046C0 2.27207 0.195891 2.46796 0.4375 2.46796ZM7.92632 2.03161C7.92632 2.03005 7.92635 2.02847 7.92635 2.02691C7.92827 1.38797 8.44963 0.868191 9.0886 0.868191C9.72666 0.868191 10.2481 1.38726 10.2508 2.0259L10.2509 2.03232C10.2499 2.67236 9.72888 3.19282 9.0886 3.19282C8.44859 3.19282 7.92775 2.67288 7.9263 2.03323L7.92632 2.03161ZM13.5625 11.5319H11.0784C10.8772 10.6186 10.0601 9.9321 9.0886 9.9321C8.11658 9.9321 7.2998 10.6185 7.09874 11.5319H0.4375C0.195891 11.5319 0 11.7278 0 11.9694C0 12.211 0.195891 12.4069 0.4375 12.4069H7.09857C7.29933 13.3207 8.11538 14.0067 9.0886 14.0067C10.0618 14.0067 10.8779 13.3207 11.0786 12.4069H13.5625C13.8041 12.4069 14 12.211 14 11.9694C14 11.7278 13.8041 11.5319 13.5625 11.5319ZM9.0886 13.1317C8.44859 13.1317 7.92775 12.6118 7.9263 11.9721L7.92632 11.9705C7.92632 11.969 7.92635 11.9674 7.92635 11.9658C7.92827 11.3269 8.44963 10.8071 9.0886 10.8071C9.72666 10.8071 10.2481 11.3262 10.2508 11.9648L10.2509 11.9712C10.25 12.6113 9.72893 13.1317 9.0886 13.1317ZM13.5625 6.56245H6.90143C6.70067 5.64864 5.88462 4.96264 4.9114 4.96264C3.93818 4.96264 3.12214 5.64864 2.92138 6.56245H0.4375C0.195891 6.56245 0 6.75834 0 6.99994C0 7.24158 0.195891 7.43744 0.4375 7.43744H2.9216C3.12277 8.35075 3.93991 9.03725 4.9114 9.03725C5.88342 9.03725 6.7002 8.35086 6.90126 7.43744H13.5625C13.8041 7.43744 14 7.24158 14 6.99994C14 6.75834 13.8041 6.56245 13.5625 6.56245ZM6.07368 6.9988C6.07368 7.00038 6.07365 7.00194 6.07365 7.0035C6.07173 7.64244 5.55037 8.16222 4.9114 8.16222C4.27334 8.16222 3.75195 7.64315 3.74918 7.00454L3.7491 6.99814C3.75006 6.35802 4.27109 5.83764 4.9114 5.83764C5.55141 5.83764 6.07225 6.35756 6.0737 6.99724L6.07368 6.9988Z"
                                    fill="#5C5C5C" />
                            </g>
                            <defs>
                                <clipPath id="clip0_162_3174">
                                    <rect width="14" height="14" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <div>
                        <div class="slick-tab ">
                            <a href="#" class="tab-inner-box active">

                                Body Parts

                            </a>
                            <a href="#" class="tab-inner-box">

                                Electronics

                            </a>
                            <a href="#" class="tab-inner-box">

                                Lighting

                            </a>
                            <a href="#" class="tab-inner-box">

                                Performance parts

                            </a>
                            <a href="#" class="tab-inner-box">

                                Repair parts

                            </a>


                        </div>

                    </div>

                    <a href="#" class="btn secondary-btn view-btn">
                        View All
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <g clip-path="url(#clip0_110_878)">
                                <path
                                    d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z"
                                    fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_110_878">
                                    <rect width="20" height="20" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
                <div class="collection-boxes">
                    @foreach ($products as $product)
                        <div class="collection-box">
                            <div class="collection-img">
                                @if (isset($product->productImage[0]))
                                    <img src="{{ Storage::url($product->productImage[0]->file_url) }}" alt="">
                                @else
                                    <img src="{{ asset('assets/images/collect1.png') }}" alt="img">
                                @endif

                            </div>
                            <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                            <h4>{{ $product->price }}</h4>
                        </div>
                    @endforeach
                    {{-- <div class="collection-box">
                        <div class="collection-img">
                            <img src="images/collect2.png" alt="">
                        </div>
                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                        <h4>$180.00</h4>
                    </div>
                    <div class="collection-box">
                        <div class="collection-img">
                            <img src="images/collect3.png" alt="">
                        </div>
                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                        <h4>$180.00</h4>
                    </div>
                    <div class="collection-box">
                        <div class="collection-img">
                            <img src="images/collect4.png" alt="">
                        </div>
                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                        <h4>$180.00</h4>
                    </div>
                    <div class="collection-box">
                        <div class="collection-img">
                            <img src="images/collect5.png" alt="">
                        </div>
                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                        <h4>$180.00</h4>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <section class="more-product-sec">
        <div class="container">
            <div class="more-product-wrapper">
                <div class="heading-with-tab">
                    <h2>More Products</h2>
                    <div class="heading-tab">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#head-tab-1" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Interior Accessories</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#head-tab-2" type="button" role="tab"
                                    aria-controls="profile-tab-pane" aria-selected="false">Motor Oils</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#head-tab-3" type="button" role="tab"
                                    aria-controls="contact-tab-pane" aria-selected="false">Tires and Wheels</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#head-tab-4" type="button" role="tab"
                                    aria-controls="contact-tab-pane" aria-selected="false">Motor Oils</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#head-tab-5" type="button" role="tab"
                                    aria-controls="contact-tab-pane" aria-selected="false">
                                    View All
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"
                                        viewBox="0 0 14 12" fill="none">
                                        <path
                                            d="M13.9075 5.80869L10.7257 3.09486C10.6114 2.98103 10.4106 2.96776 10.2771 3.06527C10.1436 3.16275 10.1281 3.33408 10.2424 3.44791C10.2531 3.45852 10.2647 3.46843 10.2771 3.47751L12.9148 5.72998H0.318166C0.142458 5.72998 0 5.85149 0 6.00138C0 6.15127 0.142458 6.27275 0.318166 6.27275H12.9148L10.2771 8.52249C10.1436 8.61998 10.1281 8.7913 10.2424 8.90514C10.3567 9.01897 10.5576 9.03224 10.691 8.93473C10.7035 8.92563 10.7151 8.91575 10.7257 8.90514L13.9075 6.19131C14.0308 6.0855 14.0308 5.91455 13.9075 5.80869Z"
                                            fill="#272643" />
                                    </svg>
                                </button>
                            </li>
                        </ul>

                    </div>
                </div>
                <div class="more-product-box">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="head-tab-1" role="tabpanel"
                            aria-labelledby="home-tab" tabindex="0">
                            <div class="more-product-boxes">
                                @foreach ($products as $product)
                                    <div class="more-product-cards">
                                        <div class="product-cards-img">
                                            @if (isset($product->productImage[0]))
                                                <img src="{{ Storage::url($product->productImage[0]->file_url) }}"
                                                    alt="">
                                            @else
                                                <img src="{{ asset('assests/images/product2.png') }}" alt="">
                                            @endif
                                        </div>
                                        <div class="product-deails">
                                            <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                            <div class="price-and-cart">
                                                <div class="discount-price">
                                                    <span>{{ $product->price * 2 }}</span>
                                                    <p>{{ $product->price }}</p>
                                                </div>
                                                <button product-id="{{ $product->id }}"
                                                    class="btn secondary-btn add-cart-btn addtocart">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                        viewBox="0 0 17 18" fill="none">
                                                        <g clip-path="url(#clip0_324_138)">
                                                            <path
                                                                d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                                fill="white" />
                                                            <path
                                                                d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                                fill="white" />
                                                            <path
                                                                d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                                fill="white" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_324_138">
                                                                <rect width="16.488" height="16.488" fill="white"
                                                                    transform="translate(0.194336 0.535889)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product2.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product3.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product4.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product5.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="head-tab-2" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">
                            <div class="more-product-boxes">
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product1.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product2.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product3.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product4.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product5.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="head-tab-3" role="tabpanel" aria-labelledby="contact-tab"
                            tabindex="0">
                            <div class="more-product-boxes">
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product1.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product2.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product3.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product4.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product5.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="head-tab-4" role="tabpanel" aria-labelledby="contact-tab"
                            tabindex="0">
                            <div class="more-product-boxes">
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product1.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product2.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product3.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product4.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product5.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="head-tab-5" role="tabpanel" aria-labelledby="contact-tab"
                            tabindex="0">
                            <div class="more-product-boxes">
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product1.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product2.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product3.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product4.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="more-product-cards">
                                    <div class="product-cards-img">
                                        <img src="images/product5.png" alt="">
                                    </div>
                                    <div class="product-deails">
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <div class="price-and-cart">
                                            <div class="discount-price">
                                                <span>$250.99</span>
                                                <p>$180.00</p>
                                            </div>
                                            <a href="#" class="btn secondary-btn add-cart-btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18"
                                                    viewBox="0 0 17 18" fill="none">
                                                    <g clip-path="url(#clip0_324_138)">
                                                        <path
                                                            d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                            fill="white" />
                                                        <path
                                                            d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                            fill="white" />
                                                    </g>
                                                    <defs>
                                                        <clipPath id="clip0_324_138">
                                                            <rect width="16.488" height="16.488" fill="white"
                                                                transform="translate(0.194336 0.535889)" />
                                                        </clipPath>
                                                    </defs>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="shop-by-brands-sec">
        <div class="container">
            <div class="shop-by-brands-wrapper">
                <div class="brands-header">
                    <h3>shops by brands</h3>
                </div>
                <div class="brands-btn">
                    <a href="#" class="btn secondary-btn view-btn">
                        View All
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"
                            fill="none">
                            <g clip-path="url(#clip0_110_878)">
                                <path
                                    d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z"
                                    fill="white"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_110_878">
                                    <rect width="20" height="20" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>

                <div class="sp-brands">
                    <div class="brands-image">
                        <img src="./images/car-logo1.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Mercedes Benz</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo2.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>BMW</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo3.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Infinity</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo4.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Audi</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo5.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Hondaz</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo6.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Volkswagen</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo1.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Ford</h6>
                        </div>
                    </div>
                    <!--  -->
                    <div class="brands-image">
                        <img src="./images/car-logo2.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Mercedes Benz</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo3.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>BMW</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo4.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Infinity</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo5.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Audi</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo6.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Honda</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo1.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>BMW</h6>
                        </div>
                    </div>
                    <div class="brands-image">
                        <img src="./images/car-logo2.png" alt="" class="">
                        <div class="brands-image-content">
                            <h6>Audi</h6>
                        </div>
                    </div>


                </div>

            </div>
        </div>
        </div>
    </section>
@endsection
@include('layouts.include.footer')
@push('scripts')
    <script>
        $('.slick-carousel').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,

            dots: false,
            prevArrow: $('.prev-btn'),
            nextArrow: $('.next-btn'),
        });


        $(document).ready(function() {
            $('.addtocart').on('click', function() {
                console.log('hrerererer');
                var product_id = $(this).attr('product-id')
                url = APP_URL + '/dealer/add/to/cart/' + product_id
                console.log(url);
                var response = ajaxCall(url, 'post', null, false);
                response.then(handleStateData).catch(handleStateError)

                function handleStateData(response) {
                    if (response.success == true) {
                        console.log('hererererer')
                        return toastr.success(response.msg);
                    } else {
                        jQuery('#errormessage').html(response.error);
                    }
                }

                function handleStateError(error) {
                    console.log('error', error)

                }
            });
        });
    </script>
@endpush
