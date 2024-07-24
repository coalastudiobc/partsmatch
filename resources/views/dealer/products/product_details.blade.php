@extends('layouts.front')
@section('title', 'Product Details')
@section('content')
<section class="single-product-sec py-3">
    <div class="container">
        <div class="single-product-wrapper">

            <div class="songle-product-main">
                <div class="back-page-btn">
                    <div class="back-round-icon">
                        <a href="{{ route('welcome.index') }}">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </div>
                    <a href="{{ route('welcome.index') }}">
                        <p></p>
                    </a>
                    <div class="cstm-bredcrum ms-4">
                        <a href="{{ route('welcome.index') }}" class="bredcrum-list">Home</a>
                        <a href="{{ route('products', ['category' => $product->category->parent->id]) }}" class="bredcrum-list">{{ $product->category->parent->name }}</a>
                        <a href="{{ route('products', ['category' => $product->subcategory_id]) }}" class="bredcrum-list">{{ $product->category->name ?? '' }}</a>
                        <a href="#" class="bredcrum-list active">{{ $product->name }}</a>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        <div class="sticky-box">

                            <div class="single-pro-slide">
                                <div class="slick-product">
                                    <!-- Inside the containing div, add one div for each slide -->

                                    @forelse ($productImages as $image)
                                    <div>
                                        <div class="parts-image-box">
                                            <img src="{{$image->file_url ?  Storage::url($image->file_url) : asset('assets/images/gear-logo.svg') }}" alt="">
                                        </div>
                                    </div>
                                    @empty
                                    <div>
                                        <div class="parts-image-box">
                                            <img src="{{asset('assets/images/gear-logo.svg') }}" alt="">
                                        </div>
                                    </div>
                                    @endforelse

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
                    <div class="col-xl-4 col-lg-12 col-md-12">
                        <div class="sticky-box">
                            <div class="single-img-info ">
                                <div class="product-infography">
                                    <h2>{{ $product->name }}</h2>
                                    <span>{{ $product->category->name }}</span><br>
                                    <span>See more products by: </span> <a href="{{ route(
                                                auth()->check() && auth()->user()->hasRole('Administrator')
                                                    ? 'admin.view.profile'
                                                    : (auth()->check()
                                                        ? auth()->user()->getRoleNames()->first() . '.view.profile'
                                                        : 'Dealer.view.profile'),
                                                ['product' => $product->id],
                                            ) }}">
                                        <u style="color:#272643">{{ $userdetails->dealership_name ?? 'Dealership Name' }}</u></a>
                                    <h2 class="product-prize-head">${{ $product->price }}</h2>


                                    @auth
                                    @if ($product->user_id !== auth()->user()->id)
                                    @if (!in_array($product->id, authCartProducts()))
                                    <button product-id="{{ $product->id }}" class="btn secondary-btn full-btn addtocart">Add to
                                        Cart
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                                            <g clip-path="url(#clip0_162_2238)">
                                                <path d="M6.61281 12.2833H6.61368C6.6144 12.2833 6.61512 12.2832 6.61585 12.2832H16.708C16.9565 12.2832 17.1749 12.1184 17.2432 11.8795L19.4697 4.08652C19.5177 3.91852 19.4841 3.7379 19.379 3.59845C19.2738 3.459 19.1092 3.37695 18.9346 3.37695H5.32905L4.93114 1.58628C4.87446 1.33159 4.64862 1.15039 4.38769 1.15039H1.04785C0.740394 1.15039 0.491211 1.39957 0.491211 1.70703C0.491211 2.01449 0.740394 2.26367 1.04785 2.26367H3.94122C4.01167 2.58099 5.8454 10.8329 5.95092 11.3076C5.35935 11.5648 4.94433 12.1546 4.94433 12.8398C4.94433 13.7606 5.69348 14.5098 6.61425 14.5098H16.708C17.0155 14.5098 17.2646 14.2606 17.2646 13.9531C17.2646 13.6457 17.0155 13.3965 16.708 13.3965H6.61425C6.30738 13.3965 6.05761 13.1467 6.05761 12.8398C6.05761 12.5334 6.30651 12.2841 6.61281 12.2833ZM18.1966 4.49023L16.2881 11.1699H7.06073L5.57635 4.49023H18.1966Z" fill="white" />
                                                <path d="M6.05762 16.1797C6.05762 17.1005 6.80676 17.8496 7.72754 17.8496C8.64831 17.8496 9.39746 17.1005 9.39746 16.1797C9.39746 15.2589 8.64831 14.5098 7.72754 14.5098C6.80676 14.5098 6.05762 15.2589 6.05762 16.1797ZM7.72754 15.623C8.03442 15.623 8.28418 15.8728 8.28418 16.1797C8.28418 16.4866 8.03442 16.7363 7.72754 16.7363C7.42066 16.7363 7.1709 16.4866 7.1709 16.1797C7.1709 15.8728 7.42066 15.623 7.72754 15.623Z" fill="white" />
                                                <path d="M13.9248 16.1797C13.9248 17.1005 14.6739 17.8496 15.5947 17.8496C16.5155 17.8496 17.2646 17.1005 17.2646 16.1797C17.2646 15.2589 16.5155 14.5098 15.5947 14.5098C14.6739 14.5098 13.9248 15.2589 13.9248 16.1797ZM15.5947 15.623C15.9016 15.623 16.1514 15.8728 16.1514 16.1797C16.1514 16.4866 15.9016 16.7363 15.5947 16.7363C15.2878 16.7363 15.0381 16.4866 15.0381 16.1797C15.0381 15.8728 15.2878 15.623 15.5947 15.623Z" fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_162_2238">
                                                    <rect width="19" height="19" fill="white" transform="translate(0.491211)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </button>
                                    @else
                                    <a href="{{ route('Dealer.cart.cart.index') }}" class="btn secondary-btn full-btn ">Go to Cart</a>
                                    @endif
                                    @endif
                                    @endauth
                                    @guest
                                    <a href="{{ route('login') }}" class="btn secondary-btn full-btn ">Add to
                                        Cart
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                                            <g clip-path="url(#clip0_162_2238)">
                                                <path d="M6.61281 12.2833H6.61368C6.6144 12.2833 6.61512 12.2832 6.61585 12.2832H16.708C16.9565 12.2832 17.1749 12.1184 17.2432 11.8795L19.4697 4.08652C19.5177 3.91852 19.4841 3.7379 19.379 3.59845C19.2738 3.459 19.1092 3.37695 18.9346 3.37695H5.32905L4.93114 1.58628C4.87446 1.33159 4.64862 1.15039 4.38769 1.15039H1.04785C0.740394 1.15039 0.491211 1.39957 0.491211 1.70703C0.491211 2.01449 0.740394 2.26367 1.04785 2.26367H3.94122C4.01167 2.58099 5.8454 10.8329 5.95092 11.3076C5.35935 11.5648 4.94433 12.1546 4.94433 12.8398C4.94433 13.7606 5.69348 14.5098 6.61425 14.5098H16.708C17.0155 14.5098 17.2646 14.2606 17.2646 13.9531C17.2646 13.6457 17.0155 13.3965 16.708 13.3965H6.61425C6.30738 13.3965 6.05761 13.1467 6.05761 12.8398C6.05761 12.5334 6.30651 12.2841 6.61281 12.2833ZM18.1966 4.49023L16.2881 11.1699H7.06073L5.57635 4.49023H18.1966Z" fill="white" />
                                                <path d="M6.05762 16.1797C6.05762 17.1005 6.80676 17.8496 7.72754 17.8496C8.64831 17.8496 9.39746 17.1005 9.39746 16.1797C9.39746 15.2589 8.64831 14.5098 7.72754 14.5098C6.80676 14.5098 6.05762 15.2589 6.05762 16.1797ZM7.72754 15.623C8.03442 15.623 8.28418 15.8728 8.28418 16.1797C8.28418 16.4866 8.03442 16.7363 7.72754 16.7363C7.42066 16.7363 7.1709 16.4866 7.1709 16.1797C7.1709 15.8728 7.42066 15.623 7.72754 15.623Z" fill="white" />
                                                <path d="M13.9248 16.1797C13.9248 17.1005 14.6739 17.8496 15.5947 17.8496C16.5155 17.8496 17.2646 17.1005 17.2646 16.1797C17.2646 15.2589 16.5155 14.5098 15.5947 14.5098C14.6739 14.5098 13.9248 15.2589 13.9248 16.1797ZM15.5947 15.623C15.9016 15.623 16.1514 15.8728 16.1514 16.1797C16.1514 16.4866 15.9016 16.7363 15.5947 16.7363C15.2878 16.7363 15.0381 16.4866 15.0381 16.1797C15.0381 15.8728 15.2878 15.623 15.5947 15.623Z" fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_162_2238">
                                                    <rect width="19" height="19" fill="white" transform="translate(0.491211)" />
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </a>
                                    @endguest
                                    <div class="singlr-pro-detail">
                                        <!-- <div class="product-name-detail">
                                    <h3>Product Name : {{ ucfirst($product->name) }}</h3>
                                    <h3>${{ $product->price }}</h3>
                                </div> -->
                                        <div class="more-info-box">
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#additional-information" aria-expanded="false" aria-controls="collapseTwo">
                                                            Description
                                                        </button>
                                                    </h2>
                                                    <div id="additional-information" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>{{ $product->description }} </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="accordion" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#additional-information1" aria-expanded="false" aria-controls="collapseTwosumit">
                                                            Additional Information
                                                        </button>
                                                    </h2>
                                                    <div id="additional-information1" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                        <div class="accordion-body">
                                                            <p>{{ $product->additional_details }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <!-- <div class="product-total">
                                                <h3>Total</h3>
                                                <h5>${{ $product->price ? $product->price : 'Total product price' }}</h5>
                                            </div> -->
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</section>
<section class="related-pro-sec py-3">
    <div class="container">
        <div class="related-pro-wrapper">
            <div class="dealer-product-header">
                <h3>Product</h3>
                {{-- <a href="#" class="btn secondary-btn view-btn">
                    View all Products
                </a> --}}
            </div>
            <div class="dealer-product-category">
                <div class="dealer-category-box">
                    @foreach ($allproducts as $product)
                    <a href="{{
    route(
        auth()->check() && auth()->user()->hasRole('Administrator') ?
            'admin.products.details' :
            (auth()->check() ? auth()->user()->getRoleNames()->first() . '.products.details' : 'Dealer.products.details'),
        ['product' => $product->id]
    )
}}">

                    </a>
                    <div class="collection-box cstm-card ">
                        <div class="collection-img">
                            <img src="{{$product->productImage && count($product->productImage) ? Storage::url($product->productImage[0]->file_url) : asset('assets/images/gear-logo.svg') }}" alt="">
                        </div>
                        <p>{{$product->name}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <h4>${{ $product->price }}</h4>
                            @auth
                            @if ($product->user_id !== auth()->user()->id)
                            @if (!in_array($product->id, authCartProducts()))
                            <button product-id="{{ $product->id }}" class="btn secondary-btn add-cart-btn addtocart">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="18" viewBox="0 0 17 18" fill="none">
                                    <g clip-path="url(#clip0_324_138)">
                                        <path d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z" fill="white" />
                                        <path d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z" fill="white" />
                                        <path d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z" fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_324_138">
                                            <rect width="16.488" height="16.488" fill="white" transform="translate(0.194336 0.535889)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </button>
                            @else
                            <a href="{{ route('Dealer.cart.cart.index') }}" class="btn secondary-btn full-btn ">Go to Cart</a>
                            @endif
                            @endif
                            @endauth
                            @guest
                            <a href="{{ route('login') }}" class="btn secondary-btn full-btn ">Add to
                                Cart
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                                    <g clip-path="url(#clip0_162_2238)">
                                        <path d="M6.61281 12.2833H6.61368C6.6144 12.2833 6.61512 12.2832 6.61585 12.2832H16.708C16.9565 12.2832 17.1749 12.1184 17.2432 11.8795L19.4697 4.08652C19.5177 3.91852 19.4841 3.7379 19.379 3.59845C19.2738 3.459 19.1092 3.37695 18.9346 3.37695H5.32905L4.93114 1.58628C4.87446 1.33159 4.64862 1.15039 4.38769 1.15039H1.04785C0.740394 1.15039 0.491211 1.39957 0.491211 1.70703C0.491211 2.01449 0.740394 2.26367 1.04785 2.26367H3.94122C4.01167 2.58099 5.8454 10.8329 5.95092 11.3076C5.35935 11.5648 4.94433 12.1546 4.94433 12.8398C4.94433 13.7606 5.69348 14.5098 6.61425 14.5098H16.708C17.0155 14.5098 17.2646 14.2606 17.2646 13.9531C17.2646 13.6457 17.0155 13.3965 16.708 13.3965H6.61425C6.30738 13.3965 6.05761 13.1467 6.05761 12.8398C6.05761 12.5334 6.30651 12.2841 6.61281 12.2833ZM18.1966 4.49023L16.2881 11.1699H7.06073L5.57635 4.49023H18.1966Z" fill="white" />
                                        <path d="M6.05762 16.1797C6.05762 17.1005 6.80676 17.8496 7.72754 17.8496C8.64831 17.8496 9.39746 17.1005 9.39746 16.1797C9.39746 15.2589 8.64831 14.5098 7.72754 14.5098C6.80676 14.5098 6.05762 15.2589 6.05762 16.1797ZM7.72754 15.623C8.03442 15.623 8.28418 15.8728 8.28418 16.1797C8.28418 16.4866 8.03442 16.7363 7.72754 16.7363C7.42066 16.7363 7.1709 16.4866 7.1709 16.1797C7.1709 15.8728 7.42066 15.623 7.72754 15.623Z" fill="white" />
                                        <path d="M13.9248 16.1797C13.9248 17.1005 14.6739 17.8496 15.5947 17.8496C16.5155 17.8496 17.2646 17.1005 17.2646 16.1797C17.2646 15.2589 16.5155 14.5098 15.5947 14.5098C14.6739 14.5098 13.9248 15.2589 13.9248 16.1797ZM15.5947 15.623C15.9016 15.623 16.1514 15.8728 16.1514 16.1797C16.1514 16.4866 15.9016 16.7363 15.5947 16.7363C15.2878 16.7363 15.0381 16.4866 15.0381 16.1797C15.0381 15.8728 15.2878 15.623 15.5947 15.623Z" fill="white" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_162_2238">
                                            <rect width="19" height="19" fill="white" transform="translate(0.491211)" />
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                            @endguest
                        </div>
                    </div>
                    @endforeach
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
        // focusOnSelect: true,
    });
    $('a[data-slide]').click(function(e) {
        e.preventDefault();
        var slideno = $(this).data('slide');
        $('.multi-img-slick').slick('slickGoTo', slideno - 1);
    });
</script>

<script>
    $(document).ready(function() {
        $('.addtocart').on('click', function(e) {
            var product_id = $(this).attr('product-id')
            url = APP_URL + '/dealer/add/to/cart/' + product_id
            var quantity = jQuery('.quantityvalue').val();
            var formData = new FormData()
            formData.append('quantity', quantity)
            var response = ajaxCall(url, 'post', null, false);
            response.then(handleStateData).catch(handleStateError)

            function handleStateData(response) {
                if (response.success == true) {
                    console.log('hererererer');
                    jQuery('#fullPageLoader').removeClass('d-none');
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
        jQuery('.checkout').on('click', function(e) {
            jQuery('#fullPageLoader').removeClass('d-none');
            setTimeout(() => {
                jQuery('#fullPageLoader').addClass('d-none');
            }, 3000);
        })
    });
</script>
@endpush