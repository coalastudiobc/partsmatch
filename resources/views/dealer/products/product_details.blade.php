@extends('layouts.front')
@section('content')
    <section class="single-product-sec">
        <div class="container">
            <div class="single-product-wrapper">

                <div class="songle-product-main">
                    <div class="row ">
                        <div class="col-xl-4 col-lg-12 col-md-12">
                            <div class="sticky-box">
                                <div class="back-page-btn">
                                    <div class="back-round-icon">
                                        <a href="{{ route('welcome.index') }}">
                                            <i class="fa-solid fa-angle-left"></i>
                                        </a>
                                    </div>
                                    <a href="{{ route('welcome.index') }}">
                                        <p>Back</p>
                                    </a>
                                </div>
                                <div class="single-pro-slide">
                                    <div class="slick-product">
                                        <!-- Inside the containing div, add one div for each slide -->

                                        @foreach ($productImages as $image)
                                            <div>
                                                <div class="parts-image-box">
                                                    <img src="{{ Storage::url($image->file_url) }}" alt="">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    {{-- <div class="next-btn-parts">
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                                <div class="prev-btn-parts">
                                    <i class="fa-solid fa-angle-left"></i>
                                </div> --}}
                                </div>

                                <div class="multi-img-slick-wrapper">
                                    <div class="pro-multi-img multi-img-slick">
                                        @foreach ($productImages as $image)
                                            <div class="parts-slider-box">
                                                <div class="multi-img-box">
                                                    <img src="{{ Storage::url($image->file_url) }}" alt="img">
                                                </div>
                                            </div>
                                        @endforeach


                                    </div>
                                    <div class="prev-btn-multi">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </div>
                                    <div class="next-btn-multi">
                                        <i class="fa-solid fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-12">
                            <div class="sticky-box">
                                <div class="single-img-info mt-5">
                                    <div class="product-infography">
                                        {{-- <h2>R1 Concepts® – eLINE Series Plain Brake Rotors</h2> --}}
                                        <h2>{{ $product->name }}® – Model-{{ $product->brand ?? 'Ford' }}
                                            series-{{ $product->model ?? 'endeavor' }}
                                            Year-{{ $product->year ?? '2016' }}
                                        </h2>
                                        <span>{{ $product->category->name }}</span><br>
                                        <span>See more products by: </span> <a
                                            href="{{ route('dealer.view.profile', $userdetails->id) }}">
                                            <u
                                                style="color: #0d6efd">{{ $userdetails->dealership_name ?? 'Dealership Name' }}</u></a>
                                        <h2>${{ $product->price }}</h2>
                                        <p>{{ $product->description }}</p>
                                        {{-- <div class="product-quantity-box">
                                        <p>Quantity</p>
                                        <div class="quantity-btn">
                                            <a href="#">-</a>
                                            <input type="text" placeholder="1">
                                            <a href="#">+</a>
                                        </div>
                                        <div class="left-badge">
                                            <p>Only 3 left</p>
                                        </div>
                                    </div> --}}
                                    </div>
                                    <div class="singlr-pro-detail">
                                        <div class="product-name-detail">
                                            <h3>Product Name : {{ ucfirst($product->name) }}</h3>
                                            <h3>${{ $product->price }}</h3>
                                        </div>
                                        <div class="more-info-box">
                                            {{-- <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#additional-information" aria-expanded="false"
                                                            aria-controls="collapseTwo">
                                                            Description
                                                        </button>
                                                    </h2>
                                                    <div id="additional-information" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>{{ $product->description }} </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> --}}
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#additional-information1" aria-expanded="false"
                                                            aria-controls="collapseTwosumit">
                                                            Additional Information
                                                        </button>
                                                    </h2>
                                                    <div id="additional-information1" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>{{ $product->additional_details }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#additional-information2" aria-expanded="false"
                                                            aria-controls="collapseTwodf">
                                                            Other Specification
                                                        </button>
                                                    </h2>
                                                    <div id="additional-information2" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>{{ $product->other_specification }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#additional-information3" aria-expanded="false"
                                                            aria-controls="collapseTwodfd">
                                                            Field 3
                                                        </button>
                                                    </h2>
                                                    <div id="additional-information3" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>{{ $product->field_3 }} </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="shipping-charge">
                                            <h3>Shipping Charges</h3>
                                            <h5>${{ $shippingCharge->value ?? 'shippingCharge->value' }}</h5>
                                        </div>
                                        <div class="product-total">
                                            <h3>Total</h3>
                                            @isset($shippingCharge->value)
                                                <h5>${{ $product->price + $shippingCharge->value }}</h5>
                                            @else
                                                <h5>there is shipping charges vlaue</h5>
                                            @endisset


                                        </div>
                                    </div>
                                    @if (auth()->user())
                                        <button product-id="{{ $product->id }}"
                                            class="btn secondary-btn full-btn addtocart">Add to
                                            Cart
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19"
                                                viewBox="0 0 20 19" fill="none">
                                                <g clip-path="url(#clip0_162_2238)">
                                                    <path
                                                        d="M6.61281 12.2833H6.61368C6.6144 12.2833 6.61512 12.2832 6.61585 12.2832H16.708C16.9565 12.2832 17.1749 12.1184 17.2432 11.8795L19.4697 4.08652C19.5177 3.91852 19.4841 3.7379 19.379 3.59845C19.2738 3.459 19.1092 3.37695 18.9346 3.37695H5.32905L4.93114 1.58628C4.87446 1.33159 4.64862 1.15039 4.38769 1.15039H1.04785C0.740394 1.15039 0.491211 1.39957 0.491211 1.70703C0.491211 2.01449 0.740394 2.26367 1.04785 2.26367H3.94122C4.01167 2.58099 5.8454 10.8329 5.95092 11.3076C5.35935 11.5648 4.94433 12.1546 4.94433 12.8398C4.94433 13.7606 5.69348 14.5098 6.61425 14.5098H16.708C17.0155 14.5098 17.2646 14.2606 17.2646 13.9531C17.2646 13.6457 17.0155 13.3965 16.708 13.3965H6.61425C6.30738 13.3965 6.05761 13.1467 6.05761 12.8398C6.05761 12.5334 6.30651 12.2841 6.61281 12.2833ZM18.1966 4.49023L16.2881 11.1699H7.06073L5.57635 4.49023H18.1966Z"
                                                        fill="white" />
                                                    <path
                                                        d="M6.05762 16.1797C6.05762 17.1005 6.80676 17.8496 7.72754 17.8496C8.64831 17.8496 9.39746 17.1005 9.39746 16.1797C9.39746 15.2589 8.64831 14.5098 7.72754 14.5098C6.80676 14.5098 6.05762 15.2589 6.05762 16.1797ZM7.72754 15.623C8.03442 15.623 8.28418 15.8728 8.28418 16.1797C8.28418 16.4866 8.03442 16.7363 7.72754 16.7363C7.42066 16.7363 7.1709 16.4866 7.1709 16.1797C7.1709 15.8728 7.42066 15.623 7.72754 15.623Z"
                                                        fill="white" />
                                                    <path
                                                        d="M13.9248 16.1797C13.9248 17.1005 14.6739 17.8496 15.5947 17.8496C16.5155 17.8496 17.2646 17.1005 17.2646 16.1797C17.2646 15.2589 16.5155 14.5098 15.5947 14.5098C14.6739 14.5098 13.9248 15.2589 13.9248 16.1797ZM15.5947 15.623C15.9016 15.623 16.1514 15.8728 16.1514 16.1797C16.1514 16.4866 15.9016 16.7363 15.5947 16.7363C15.2878 16.7363 15.0381 16.4866 15.0381 16.1797C15.0381 15.8728 15.2878 15.623 15.5947 15.623Z"
                                                        fill="white" />
                                                </g>
                                                <defs>
                                                    <clipPath id="clip0_162_2238">
                                                        <rect width="19" height="19" fill="white"
                                                            transform="translate(0.491211)" />
                                                    </clipPath>
                                                </defs>
                                            </svg>
                                        </button>
                                    @endif
                                    {{-- <div class="pro-dealer-box">
                                        <h4>Dealer</h4>
                                        <div class="pro-dealer-info">
                                            <div class="pro-dealer-img-box">
                                                <div class="dealer-img-box">
                                                    <img src="{{ Storage::url($userdetails->profile_picture_url) }}"
                                                        alt="">
                                                </div>
                                                <div class="dealer-img-txt">
                                                    <h5>{{ $userdetails->name }}</h5>
                                                    <p>{{ $userdetails->email }}</p>
                                                </div>
                                            </div>
                                            <a @if (auth()->user()) href="{{ route('dealer.view.profile', $userdetails->id) }}" @else href="javascript:void(0)" @endif
                                                class="btn secondary-btn">View
                                                Profile</a>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="related-pro-sec">
        <div class="container">
            <div class="related-pro-wrapper">
                <div class="dealer-product-header">
                    <h3>Product</h3>
                    <a href="#" class="btn secondary-btn view-btn">
                        View all Products
                    </a>
                </div>
                <div class="dealer-product-category">
                    <div class="dealer-category-box">
                        @foreach ($allproducts as $product)
                            <a href="{{ route('dealer.products.details', $product->id) }}">
                                <div class="collection-box cstm-card ">
                                    <div class="collection-img">
                                        <img src="{{ Storage::url($product->productImage[0]->file_url) }}"
                                            alt="">
                                    </div>
                                    <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                    <h4>${{ $product->price }}</h4>
                                </div>
                            </a>
                        @endforeach
                        {{-- <div class="collection-box cstm-card">
                            <div class="collection-img">
                                <img src="{{ asset('assets/images/collect1.png') }}" alt="">
                            </div>
                            <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                            <h4>$180.00</h4>
                        </div>
                        <div class="collection-box cstm-card">
                            <div class="collection-img">
                                <img src="{{ asset('assets/images/collect1.png') }}" alt="">
                            </div>
                            <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                            <h4>$180.00</h4>
                        </div>
                        <div class="collection-box cstm-card">
                            <div class="collection-img">
                                <img src="{{ asset('assets/images/collect1.png') }}" alt="">
                            </div>
                            <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                            <h4>$180.00</h4>
                        </div>
                        <div class="collection-box cstm-card">
                            <div class="collection-img">
                                <img src="{{ asset('assets/images/collect1.png') }}" alt="">
                            </div>
                            <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                            <h4>$180.00</h4>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $('.slick-product').slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            asNavFor: '.multi-img-slick',
            dots: false,
            prevArrow: $('.prev-btn-parts'),
            nextArrow: $('.next-btn-parts'),
        });
        $('.multi-img-slick').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            asNavFor: '.slick-product',
            prevArrow: $('.prev-btn-multi'),
            nextArrow: $('.next-btn-multi'),
            focusOnSelect: true,
        });
        $('a[data-slide]').click(function(e) {
            e.preventDefault();
            var slideno = $(this).data('slide');
            $('.multi-img-slick').slick('slickGoTo', slideno - 1);
        });
    </script>
    <script>
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
                        window.location.replace(APP_URL + '/' + 'dealer/cart/index')
                        // return toastr.success(response.msg);
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
