@extends('layouts.front')
@section('title', 'Interior Accessories')
@section('heading', 'Interior Accessories')
@section('content')
<section class="banner-content-sec">
    <div class="container">
        <div class="banner-content-wrapper">
            <div class="banner-content-heading single-heading">
                <h2>Interior Accessories</h2>
            </div>
        </div>
    </div>
</section>
<section class="page-content-sec bg-white section-padding">
    <div class="container">
        <div class="page-content-wrapper">
            <div class="sp-content-wrapper">
                <div class="interior-content-left">
                    <h3>Categories</h3>
                    <div class="interior-category-tabs">
                        <div class="accordion" id="accordionExample">
                            @foreach (get_category() as $key => $category)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed @if ($parent == $category->id) show @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="true" aria-controls="collapseOne">
                                        {{ $category->name }}
                                    </button>


                                </h2>
                                @foreach (get_subcategory($category->id) as $subcategory)
                                <div id="collapseOne{{ $key }}" class="accordion-collapse collapse @if ($parent == $category->id) show @endif" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="interior-category-content">
                                            <ul>
                                                <li><a href="{{ route(
    auth()->check() && auth()->user()->hasRole('Administrator') 
        ? 'admin.products.interior' 
        : (auth()->check() ? auth()->user()->getRoleNames()->first() . '.products.interior' : 'Dealer.products.interior'), 
    ['category' => $subcategory->id]
) }}" class="categories-item @if ($active_id == $subcategory->id) active @endif">{{ $subcategory->name }}</a>
                                                </li>
                                                {{-- <li><a href="#" class="categories-item">Motor Oil</a></li>
                                                            <li><a href="#" class="categories-item">Motor Oil</a></li>
                                                            <li><a href="#" class="categories-item">Motor Oil</a></li>
                                                            <li><a href="#" class="categories-item">Motor Oil</a></li> --}}
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="interior-content-right" id="interiorComponent">
                    {{-- <h2 class="interior-content-heading">Mirrors</h2> --}}
                    <div class="accessories-parts">
                        <div class="row g-4">
                            {{-- @dd($product->productImage[0]->file_url) --}}
                            @forelse ($products as $product)
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="accessories-parts-box">
                                    <a href="{{ 
    route(
        auth()->check() && auth()->user()->hasRole('Administrator') ? 
            'admin.products.details' : 
            (auth()->check() ? auth()->user()->getRoleNames()->first() . '.products.details' : 'Dealer.products.details'), 
        ['product' => $product->id]
    ) 
}}">

                                        <div class="more-product-cards cstm-card">
                                            <div class="product-cards-img">
                                                <img src="{{ Storage::url($product->productImage[0]->file_url) }}" alt="">
                                            </div>
                                            <div class="product-deails">
                                                <p>{{ $product->name }}® – Model-{{ $product->brand ?? 'Ford' }}
                                                    series-{{ $product->model ?? 'endeavor' }}
                                                    Year-{{ $product->year ?? '2016' }}
                                                </p>
                                                <div class="price-and-cart">
                                                    <div class="discount-price">
                                                        <span>{{ $product->price * 1.5 }}</span>
                                                        <p>{{ $product->price }}</p>
                                                    </div>


                                                    @if (auth()->user())
                                                    @if ($product->user_id !== auth()->user()->id)
                                                    @if (in_array($product->id, authCartProducts()))
                                                    <button class="btn secondary-btn add-cart-btn " id="added_btn">
                                                        <span>added</span>
                                                    </button>
                                                    @elseif($product->stocks_avaliable > 0)
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
                                                    <p class="text-danger">Out of stocks</p>
                                                    @endif
                                                    @else
                                                    @endif
                                                    @else
                                                    <a class="btn secondary-btn add-cart-btn " href="{{ route('login') }}">
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
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="pro-dealer-box">
                                                <h4>Dealer</h4>
                                                <div class="pro-dealer-info">

                                                    <div class="dealer-img-box">

                                                        @if (isset($product->user->profile_picture_url))
                                                        <img src="{{ Storage::url($product->user->profile_picture_url) }}" alt="">
                                                        @endif

                                                    </div>
                                                    <div class="dealer-img-txt">
                                                        <a href="{{ route('Dealer.view.profile', $product->user->id) }}">
                                                            <u>
                                                                <h5>{{ $product->user->name ?? ' ' }}</h5>
                                                            </u>
                                                        </a>
                                                        {{-- <p>{{ $product->user->email ?? ' ' }}</p> --}}
                                                    </div>

                                                    {{-- <a @if (auth()->user()) href="{{ route('dealer.view.profile', $product->user->id) }}" @else href="javascript:void(0)" @endif
                                                    class="btn secondary-btn small-btn">View
                                                    Profile
                                    </a> --}}
                                </div>
                            </div>
                        </div>
                        </a>

                    </div>
                </div>
                @empty
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="accessories-parts-box empty-category ">
                        {{-- <div class=" empty-data"> --}}
                        <img src="{{ asset('assets/images/no-product.svg') }}  " alt="" width="300">
                        <p class="text-center mt-1">Did not found any order</p>
                        {{-- </div> --}}
                    </div>
                </div>
                @endforelse
            </div>
            {{-- <div class="col-md-6 col-lg-4 col-xl-4">
                                        <div class="accessories-parts-box">
                                            <div class="more-product-cards cstm-card">
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                height="18" viewBox="0 0 17 18" fill="none">
                                                                <g clip-path="url(#clip0_324_138)">
                                                                    <path
                                                                        d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                                        fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_324_138">
                                                                        <rect width="16.488" height="16.488" fill="white"
                                                                            transform="translate(0.194336 0.535889)">
                                                                        </rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-dealer-box">
                                                    <h4>Dealer</h4>
                                                    <div class="pro-dealer-info">
                                                        <div class="pro-dealer-img-box">
                                                            <div class="dealer-img-box">
                                                                <img src="images/profile-img.png" alt="">
                                                            </div>
                                                            <div class="dealer-img-txt">
                                                                <h5>James Bergson</h5>
                                                                <p>jamesmullican@gmail.com</p>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="btn secondary-btn small-btn">View Profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4">
                                        <div class="accessories-parts-box">
                                            <div class="more-product-cards cstm-card">
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                height="18" viewBox="0 0 17 18" fill="none">
                                                                <g clip-path="url(#clip0_324_138)">
                                                                    <path
                                                                        d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                                        fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_324_138">
                                                                        <rect width="16.488" height="16.488" fill="white"
                                                                            transform="translate(0.194336 0.535889)">
                                                                        </rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-dealer-box">
                                                    <h4>Dealer</h4>
                                                    <div class="pro-dealer-info">
                                                        <div class="pro-dealer-img-box">
                                                            <div class="dealer-img-box">
                                                                <img src="images/profile-img.png" alt="">
                                                            </div>
                                                            <div class="dealer-img-txt">
                                                                <h5>James Bergson</h5>
                                                                <p>jamesmullican@gmail.com</p>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="btn secondary-btn small-btn">View Profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4">
                                        <div class="accessories-parts-box">
                                            <div class="more-product-cards cstm-card">
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                height="18" viewBox="0 0 17 18" fill="none">
                                                                <g clip-path="url(#clip0_324_138)">
                                                                    <path
                                                                        d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                                        fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_324_138">
                                                                        <rect width="16.488" height="16.488" fill="white"
                                                                            transform="translate(0.194336 0.535889)">
                                                                        </rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-dealer-box">
                                                    <h4>Dealer</h4>
                                                    <div class="pro-dealer-info">
                                                        <div class="pro-dealer-img-box">
                                                            <div class="dealer-img-box">
                                                                <img src="images/profile-img.png" alt="">
                                                            </div>
                                                            <div class="dealer-img-txt">
                                                                <h5>James Bergson</h5>
                                                                <p>jamesmullican@gmail.com</p>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="btn secondary-btn small-btn">View Profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4">
                                        <div class="accessories-parts-box">
                                            <div class="more-product-cards cstm-card">
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                height="18" viewBox="0 0 17 18" fill="none">
                                                                <g clip-path="url(#clip0_324_138)">
                                                                    <path
                                                                        d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                                        fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_324_138">
                                                                        <rect width="16.488" height="16.488" fill="white"
                                                                            transform="translate(0.194336 0.535889)">
                                                                        </rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-dealer-box">
                                                    <h4>Dealer</h4>
                                                    <div class="pro-dealer-info">
                                                        <div class="pro-dealer-img-box">
                                                            <div class="dealer-img-box">
                                                                <img src="images/profile-img.png" alt="">
                                                            </div>
                                                            <div class="dealer-img-txt">
                                                                <h5>James Bergson</h5>
                                                                <p>jamesmullican@gmail.com</p>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="btn secondary-btn small-btn">View Profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-4">
                                        <div class="accessories-parts-box">
                                            <div class="more-product-cards cstm-card">
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
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="17"
                                                                height="18" viewBox="0 0 17 18" fill="none">
                                                                <g clip-path="url(#clip0_324_138)">
                                                                    <path
                                                                        d="M6.02344 14.5761C6.02344 15.3751 6.67351 16.0252 7.47255 16.0252C8.2716 16.0252 8.92167 15.3751 8.92167 14.5761C8.92167 13.777 8.2716 13.127 7.47255 13.127C6.67351 13.127 6.02344 13.777 6.02344 14.5761ZM7.47255 14.093C7.7389 14.093 7.95559 14.3097 7.95559 14.5761C7.95559 14.8424 7.7389 15.0591 7.47255 15.0591C7.20621 15.0591 6.98952 14.8424 6.98952 14.5761C6.98952 14.3097 7.20621 14.093 7.47255 14.093Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M10.8857 14.5761C10.8857 15.3751 11.5358 16.0252 12.3349 16.0252C13.1339 16.0252 13.784 15.3751 13.784 14.5761C13.784 13.777 13.1339 13.127 12.3349 13.127C11.5358 13.127 10.8857 13.777 10.8857 14.5761ZM12.3349 14.093C12.6012 14.093 12.8179 14.3097 12.8179 14.5761C12.8179 14.8424 12.6012 15.0591 12.3349 15.0591C12.0685 15.0591 11.8518 14.8424 11.8518 14.5761C11.8518 14.3097 12.0685 14.093 12.3349 14.093Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M16.2 3.46633H3.97322C3.80783 2.88736 3.65371 2.34791 3.52132 1.88454C3.4621 1.67716 3.27253 1.53418 3.05687 1.53418H0.678351C0.411585 1.53418 0.195312 1.75045 0.195312 2.01722C0.195312 2.28398 0.411585 2.50026 0.678351 2.50026H2.69249C3.23266 4.39106 4.49545 8.81097 5.02486 10.6639L4.84186 11.0299C4.35962 11.9945 5.06193 13.1271 6.13801 13.1271H14.2678C14.5346 13.1271 14.7509 12.9108 14.7509 12.6441C14.7509 12.3773 14.5346 12.161 14.2678 12.161H6.13801C5.77876 12.161 5.54545 11.783 5.70595 11.462L5.83946 11.195H14.2678C14.4835 11.195 14.673 11.052 14.7323 10.8446L16.6645 4.08208C16.7525 3.77406 16.5211 3.46633 16.2 3.46633ZM13.9035 10.2289H5.90531C5.64212 9.30766 4.90552 6.72958 4.24923 4.43241H15.5597L13.9035 10.2289Z"
                                                                        fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clipPath id="clip0_324_138">
                                                                        <rect width="16.488" height="16.488" fill="white"
                                                                            transform="translate(0.194336 0.535889)">
                                                                        </rect>
                                                                    </clipPath>
                                                                </defs>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="pro-dealer-box">
                                                    <h4>Dealer</h4>
                                                    <div class="pro-dealer-info">
                                                        <div class="pro-dealer-img-box">
                                                            <div class="dealer-img-box">
                                                                <img src="images/profile-img.png" alt="">
                                                            </div>
                                                            <div class="dealer-img-txt">
                                                                <h5>James Bergson</h5>
                                                                <p>jamesmullican@gmail.com</p>
                                                            </div>
                                                        </div>
                                                        <a href="#" class="btn secondary-btn small-btn">View Profile</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
        </div>
        {{-- <div class="empty-data">
                                <img src="{{ asset('assets/images/no-product.svg') }} " alt="" width="300">
        <p class="text-center mt-1">Did not found any order</p>
    </div> --}}
    </div>
    {{-- @include('components.interior-component') --}}
    <div class="pagination-wrapper">
        {{-- <div class="pagination-boxes">
                                    <div class="pagination-box">
                                        <i class="fa-solid fa-angle-left"></i>
                                    </div>
                                    <div class="pagination-box active">
                                        <p>1</p>
                                    </div>
                                    <div class="pagination-box">
                                        <p>2</p>
                                    </div>
                                    <div class="pagination-box">
                                        <p>3</p>
                                    </div>
                                    <div class="pagination-box">
                                        <p>4</p>
                                    </div>
                                    <div class="pagination-box">
                                        <p>5</p>
                                    </div>
                                    <div class="pagination-box">
                                        <i class="fa-solid fa-angle-right"></i>
                                    </div>
                                </div> --}}
        {{-- {!! $products->links('dealer.pagination') !!} --}}

    </div>
    </div>
    </div>
    </div>

</section>
@endsection
@push('scripts')
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
                    jQuery('.cart-icon').html(response.cart_icon)
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