@extends('layouts.front')
@section('content')
    <section class="top-categories-sec">
        <div class="container">
            <div class="top-categories-wrapper">
                <h2 class="sec-heading">Top Categories</h2>
                <div class="categories-boxes categoryCard">
                    @foreach ($categories as $key => $category)
                        <div class="categories-box">
                            <img src="{{ asset('assets/images/categorie1.png') }}" alt="">
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
                    </div>
                </div> --}}
                    {{-- <a href="#" class="btn secondary-btn view-btn">
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
            </a> --}}
                </div>
            </div>
    </section>
@endsection
@include('layouts.include.footer')
