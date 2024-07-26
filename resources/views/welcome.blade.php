@extends('layouts.front')
@section('title', 'Partsmatch')
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <g clip-path="url(#clip0_110_878)">
                                                <path d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z" fill="white" />
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
                                    {{-- <img src="images/hero-banner-img.png" alt=""> --}}
                                    <img src="{{ asset('assets/images/hero-banner-img.png') }}" alt="">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <g clip-path="url(#clip0_110_878)">
                                                <path d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z" fill="white" />
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
                                    {{-- <img src="images/hero-banner-img.png" alt=""> --}}
                                    <img src="{{ asset('assets/images/hero-banner-img.png') }}" alt="">

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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <g clip-path="url(#clip0_110_878)">
                                                <path d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z" fill="white" />
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
                                    {{-- <img src="images/hero-banner-img.png" alt=""> --}}
                                    <img src="{{ asset('assets/images/hero-banner-img.png') }}" alt="">

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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <g clip-path="url(#clip0_110_878)">
                                                <path d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z" fill="white" />
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
                                    {{-- <img src="images/hero-banner-img.png" alt=""> --}}
                                    <img src="{{ asset('assets/images/hero-banner-img.png') }}" alt="">

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
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <g clip-path="url(#clip0_110_878)">
                                                <path d="M19.8678 9.67956L15.3225 5.13417C15.1592 4.94351 14.8722 4.92128 14.6816 5.0846C14.4909 5.24788 14.4687 5.53483 14.632 5.72549C14.6472 5.74326 14.6638 5.75986 14.6816 5.77506L18.4497 9.54773H0.454523C0.203512 9.54773 0 9.75124 0 10.0023C0 10.2533 0.203512 10.4568 0.454523 10.4568H18.4497L14.6816 14.2249C14.4909 14.3882 14.4687 14.6751 14.632 14.8658C14.7953 15.0565 15.0822 15.0787 15.2729 14.9154C15.2907 14.9001 15.3073 14.8836 15.3225 14.8658L19.8679 10.3204C20.0441 10.1432 20.0441 9.85686 19.8678 9.67956Z" fill="white" />
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
                                    {{-- <img src="images/hero-banner-img.png" alt=""> --}}
                                    <img src="{{ asset('assets/images/hero-banner-img.png') }}" alt="">

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
            {{-- <div class="search-box">
                <input type="text" placeholder="part number">
                <a href="#" class="btn primary-btn">Search</a>
            </div> --}}
        </div>
    </div>
</section>
@if (isset($category[0]))
<section class="top-categories-sec">
    <div class="container">
        <div class="top-categories-wrapper">
            <!-- <h2 class="sec-heading">Top Categories</h2> -->
            <div class="categories-boxes-main">
                <div class="categories-boxes-outer">
                    <div class="categories-boxes">

                        <div class="categories-loop-boxes-outer">
                            <div class="categories-loop-boxes">
                                @foreach ($category as $key => $category)
                                @if ($loop->iteration > 7)
                                @break
                                @endif
                                <a href="{{ route('products', ['category' => $category->id]) }}">
                                    <div class="categories-box">
                                        <img src="{{ asset('assets/images/categorie1.svg') }}" alt="">
                                        <p>{{ $category->name }}</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{ route('products') }}">
                            <div class="categories-box">
                                <img src="{{ asset('assets/images/categorie1.svg') }}" alt="">
                                <p>View All</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@if (isset($collections[0]))
<section class="collection-sec">
    <div class="container">
        <div class="collection-wrapper">
            <h2 class="sec-heading">Collections</h2>
            <p class="sec-para">It is a long established fact that a reader will be distracted by the readable
                content.</p>
        </div>
        <div class="collection-main">
            <div class="collect-tab-btns">
                <div>
                    <div class="slick-tab ">

                        <div class="collect-tab-slider-main">
                            <div class="collect-tab-slider">
                                @foreach ($collections as $collection)
                                <a href="javascript:void(0)" data-url="{{ route('products', ['category' => $collection->id]) }}" data-id="{{ $collection->id }}" class="tab-inner-box collectionSubcategory {{ $loop->first ? 'active' : '' }} ">
                                    {{ $collection->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                        <a href="{{route('products')}}" class="tab-inner-box"> View All </a>
                    </div>
                </div>
            </div>
            <div class="collection-boxes productIndex">
                @include('components.home-product', ['products' => $collections[0]->productForWelcome])
            </div>
        </div>
    </div>
</section>
@endif
@if (isset($subcategories[0]))
<section class="more-product-sec">
    <div class="container">
        <div class="more-product-wrapper">
            <div class="heading-with-tab">
                <h2>More Products</h2>
                <div class="heading-tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        @foreach ($subcategories as $subcategory)
                        <li class="nav-item {{ $loop->first ? 'active' : '' }}" role="presentation">
                            <button data-url="{{ route('products', ['category' => $subcategory->id]) }}" data-id="{{ $subcategory->id }}" class="nav-link navButton productsubcategory {{ $loop->first ? 'active' : '' }}" type="button">{{ $subcategory->name }}</button>
                        </li>
                        @endforeach


                        <li class="nav-item" role="presentation">
                            <a href="{{ route('products') }}" class="nav-link" id="subcategoryViewAll">
                                View All
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
                                    <path d="M13.9075 5.80869L10.7257 3.09486C10.6114 2.98103 10.4106 2.96776 10.2771 3.06527C10.1436 3.16275 10.1281 3.33408 10.2424 3.44791C10.2531 3.45852 10.2647 3.46843 10.2771 3.47751L12.9148 5.72998H0.318166C0.142458 5.72998 0 5.85149 0 6.00138C0 6.15127 0.142458 6.27275 0.318166 6.27275H12.9148L10.2771 8.52249C10.1436 8.61998 10.1281 8.7913 10.2424 8.90514C10.3567 9.01897 10.5576 9.03224 10.691 8.93473C10.7035 8.92563 10.7151 8.91575 10.7257 8.90514L13.9075 6.19131C14.0308 6.0855 14.0308 5.91455 13.9075 5.80869Z" fill="#272643" />
                                </svg>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="more-product-box">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="head-tab-1" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="more-product-boxes tabProduct">
                            @include('components.home-product-tab', [
                            'products' => $subcategories[0]->productForWelcome,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<section class="shop-by-brands-sec">
    <div class="container">
        <div class="shop-by-brands-wrapper">
            <div class="brands-header">
                <div></div>
                <h3>Shop by brands</h3>
                <div class="brands-btn">
                    <a href="javascript:void(0)" class="btn secondary-btn view-btn see-more-less-brands" data-action="see_more">See more</a>
                </div>
            </div>

            <div id="brandContainer" class="sp-brands brand-height-fix">
                @foreach($brands as $brand)
                <div class="brands-image brand-container make-filter" data-make="{{$brand->makes}}">
                    <img src="{{ $brand->image_url ? $brand->image_url : asset('assets/images/car-logo2.png') }}" alt="" class="">
                    <div class="brands-image-content">
                        <h6>{{$brand->makes}}</h6>
                    </div>
                </div>
                @endforeach
            </div>
            <form id="brandFilter" method="POST" action="{{route('products')}}" class="d-none">
                @csrf
                <input type="hidden" id="searchFieldMake" name="brand[]" class="max-input">
            </form>

        </div>
    </div>
    </div>
</section>
@endsection
@section('modals')
@include('modals.restrict_multiple')
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
    $('.categories-loop-boxes').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        dots: false,
        prevArrow: $('.prev-loop-btn'),
        nextArrow: $('.next-loop-btn'),
        responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 425,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }

        ]
    });
    // $('.collect-tab-slider').slick({
    //     infinite: true,
    //     slidesToShow: 8,
    //     slidesToScroll: 1,
    //     arrows: true,
    //     dots: false,
    //     prevArrow: $('.prev-loop-btn'),
    //     nextArrow: $('.next-loop-btn'),
    //     responsive: [
    //       {
    //         breakpoint: 1200,
    //         settings: {
    //           slidesToShow: 5,
    //           slidesToScroll: 2,
    //         }
    //       },
    //       {
    //         breakpoint: 1024,
    //         settings: {
    //           slidesToShow: 4,
    //           slidesToScroll: 2,
    //         }
    //       },
    //       {
    //         breakpoint: 767,
    //         settings: {
    //           slidesToShow: 2,
    //           slidesToScroll: 1,
    //         }
    //       },
    //       {
    //         breakpoint: 425,
    //         settings: {
    //           slidesToShow: 1,
    //           slidesToScroll: 1,
    //         }
    //       }

    //     ]
    // });

    $(document).ready(function() {


        $('.collectionSubcategory').on('click', function() {
            element = jQuery(this);
            dataUrl = $(this).attr('data-url');
            jQuery('#collectioViewAll').attr('href', dataUrl);
            id = $(this).attr('data-id');
            url = APP_URL + '/get/categorized/collection/products/' + id;
            var response = ajaxCall(url, 'get', id, false);
            response.then(handleCategoriezedData).catch(handleCategoriezedError)

            function handleCategoriezedData(response) {
                if (response.status == true) {
                    jQuery('.productIndex').html(response.data)
                    jQuery('.collectionSubcategory').removeClass('active');
                    element.addClass('active');
                } else {
                    console.log('error', response.message)
                }
            }

            function handleCategoriezedError(error) {
                console.log('error', error)

            }
        });

        $('.productsubcategory').on('click', function() {
            console.log('here');
            element = jQuery(this)
            dataUrl = $(this).attr('data-url');
            jQuery('#subcategoryViewAll').attr('href', dataUrl);
            id = $(this).attr('data-id');
            url = APP_URL + '/get/categorized/products/' + id;
            var response = ajaxCall(url, 'get', id, false);
            response.then(handleCategoriezedData).catch(handleCategoriezedError)

            function handleCategoriezedData(response) {
                if (response.status == true) {
                    jQuery('.tabProduct').html(response.data)
                    jQuery('.productsubcategory').removeClass('active');
                    element.addClass('active');
                } else {
                    console.log('error', response.message)
                }
            }

            function handleCategoriezedError(error) {
                console.log('error', error)

            }
        });

        $('.see-more-less-brands').on('click', function() {
            $('#brandContainer').toggleClass('brand-height-fix');
            if ($(this).attr('data-action') == "see_more") {
                $(this).attr('data-action', "see_less");
                $(this).html(' See less ');
            } else {
                $(this).attr('data-action', "see_more");
                $(this).html('See more');
            }

        });

        $('.make-filter').on('click', function() {
            var make = $(this).attr('data-make');
            $('#searchFieldMake').val(make);
            $('#brandFilter').submit();
        });


    });
</script>
@endpush