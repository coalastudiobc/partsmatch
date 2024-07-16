@extends('layouts.front')
@section('title', 'Partsmatch')
@section('content')
<section class="shop-by-brands-sec">
    <div class="container">
        <div class="shop-by-brands-wrapper">
            <div class="brands-header">
                <h3>Shop by brands</h3>
            </div>
            <div class="sp-brands margin-top-2">
                @foreach($brands as $brand)
                <div class="brands-image">
                    <img src="{{ $brand->image_url ? Storage::url($brand->image_url) : asset('assets/images/car-logo2.png') }}" alt="" class="">
                    <div class="brands-image-content">
                        <h6>{{$brand->makes}}</h6>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
    </div>
</section>
@endsection
@include('layouts.include.footer')
