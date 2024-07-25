@extends('layouts.front')
@section('title', 'Dealer Profile')
@section('content')
<section class="banner-content-sec">
    <div class="container">
        <div class="banner-content-wrapper">
            <div class="banner-content-heading single-heading">
                <h2>Dealer Profile</h2>
            </div>
        </div>
    </div>
</section>
<section class="page-content-sec section-padding">
    <div class="container">
        <div class="page-content-wrapper">
            <div class="dealer-profile-box">
                <div class="cstm-bredcrum ms-4">
                    <a href="{{ route('welcome.index') }}" class="bredcrum-list">Home</a>
                    <a href="{{ route('products', ['category' => $product->category->parent->id]) }}" class="bredcrum-list">{{ $product->category->parent->name ?? 'category'}}</a>
                    <a href="{{ route('products', ['category' => $product->subcategory_id]) }}" class="bredcrum-list">{{ $product->category->name ?? 'sub Category' }}</a>
                    <a href="{{ route(auth()->check() && auth()->user()->hasRole('Administrator') ? 'admin.products.details' : (auth()->check() ? auth()->user()->getRoleNames()->first() . '.products.details' : 'Dealer.products.details'), $product->id) }}" class="bredcrum-list">{{ $product->name ?? 'product name' }}</a>
                    <a href="#" class="bredcrum-list active">{{ $user->name }}</a>
                </div>
                <div class="dealer-profile-content">
                    <div class="dealer-profile-form-box">
                        <div class="dealer-profile-detail-form">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="dealer-profile-upload-box">
                                            <div class="upload-img">
                                                <div class="file-upload-box">
                                                    <label for="file-upload" style="cursor:auto;">
                                                        <div class="profile-without-img">
                                                            <img src="{{ Storage::url($user->profile_picture_url) }} " alt="img">
                                                            {{-- <div class="upload-icon">
                                                                    <i class="fa-sharp fa-solid fa-pen"></i>
                                                                </div> --}}
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <div class="form-field">
                                                <input type="text" value="{{ $user->name }}" class="form-control" placeholder="" disabled readonly>

                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <div class="form-field">
                                                    <input type="email" value="{{ $user->email }}" disabled class="form-control"
                                    placeholder="" readonly>

                                </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Phone Number</label>
                                                <div class="form-field">
                                                    <input type="tel" value="{{ $user->phone_number }}"
                    class="form-control" placeholder="" readonly>

                </div>
            </div>
        </div> --}}
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Industry</label>
                <div class="form-field">
                    <input type="text" value="{{ $user->industry_type }}" class="form-control" placeholder="" disabled readonly>

                </div>
            </div>
        </div>

        {{-- <div class="col-md-12">
                                            <div class="dealer-profile-form-btn">
                                                @if (auth()->user()->id === $user->id)
                                                @else
                                                    <a href="{{ route('dealer.chat.inbox.view', ['user_id' => jsencode_userdata($user->id)]) }}"
        class="btn primary-btn sendMessage"
        data-id="{{ jsencode_userdata($user->id) }}">Send Message</a>
        @endif
    </div>
    </div> --}}
    </div>

    </form>
    </div>
    </div>
    <div class="dealer-product-bxx">
        <div class="dealer-product-header">
            <h3>Product</h3>
            <a href="#" class="btn secondary-btn view-btn">
                View all products
            </a>
        </div>
        <div class="dealer-product-category">
            <div class="dealer-category-box">
                @foreach ($allproducts as $product)
                {{-- @dd($product) --}}
                <div class="collection-box cstm-card">
                    <a href="{{ route('Dealer.products.details', $product->id) }}">
                        <div class="collection-img">
                            <img src="{{ Storage::url($product->productImage[0]->file_url) }}" alt="">
                        </div>
                    </a>
                    <p>{{$product->name}}</p>
                    <div class="price-and-cart">
                        <h4>${{ $product->price }}</h4>
                        @if ($product->user_id != auth()->user()->id)
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
                        @endif
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Start -->
    <!-- End -->
</section>
@endsection

@push('scripts')
{{-- <script>
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
                    // location.reload();
                    jQuery(".cart-icon").html(response.cart_icon);
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
</script> --}}
@endpush