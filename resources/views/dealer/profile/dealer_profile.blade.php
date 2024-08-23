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
                    <a href="{{ route('product.detail', $product->id) }}" class="bredcrum-list">{{ $product->name ?? 'product name' }}</a>
                    {{-- <a href="#" class="bredcrum-list active">{{ $user->name }}</a> --}}
                    <a href="#" class="bredcrum-list active">seller</a>
                </div>
                <div class="dealer-profile-content">
                    {{-- <div class="dealer-profile-form-box">
                        <div class="dealer-profile-detail-form">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="dealer-profile-upload-box" style="cursor: auto;">
                                            <div class="upload-img">
                                                <div class="file-upload-box">
                                                    <label for="file-upload" style="cursor:auto;">
                                                        <div class="profile-without-img">
                                                            <img src="{{ Storage::url($user->profile_picture_url) }} " alt="img">

                                                        </div>
                                                    </label>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Business Name</label>
                                                            <div class="form-field">
                                                                <input type="text" value="{{ $user->dealership_name ?? 'Business Name' }}" class="form-control" placeholder="" disabled readonly>
                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Industry</label>
                                            <div class="form-field">
                                                <input type="text" value="{{ $user->industry_type }}" class="form-control" placeholder="" disabled readonly>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> --}}
                    <div class="dealer-product-bxx">
                        <div class="dealer-product-category">
                            <div class="dealer-category-box">
                                @foreach ($allproducts as $product)
                                    <x-home-product-tab :product="$product" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
