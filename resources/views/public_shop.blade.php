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
<section class="page-content-sec bg-white ">
    
        <div class="page-content-wrapper">
            <div class="sp-content-wrapper">
                <div class="interior-content-left">
                    <div class="interior-filter-head">
                        <h3>Filter</h3>
                        <a href="#">Clear All</a>
                    </div>
                    <div class="interior-filter-body">
                        <div class="interior-filter-box">

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button p-0 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <h4>Categories</h4>
                                    </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-0">
                                            <div class="category-list">
                                                <ul class="ps-3 mb-2 ">
                                                    @foreach ($categories as $category )
                                                   <li>
                                                       <div>
                                                                <p>
                                                            <a href="{{route('products',['category'=>$category->id])}}" class="@if($category->id == request()->get('category'))active @endif">
                                                                    {{$category->name}}
                                                            </a>
                                                                </p>
                                                            <ul  class="ps-3 category-sublist">
                                                                @foreach($category->children as $subCategory)
                                                                    <li>
                                                                        <a href="{{route('products',['category'=>$subCategory->id])}}" class="@if($subCategory->id == request()->get('category'))active @endif">
                                                                            {{$subCategory->name}}
                                                                        </a>
                                                                    </li> 
                                                                @endforeach
                                                            </ul>
                                                       </div>
                                                   </li> 
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

{{-- 
                            <h4>Categories</h4>
                            <div class="interior-filter-inner">
                                <div class="accordion" id="accordionExample">
                                    @foreach ($categories as $category )
                                    <div class="accordion-item">
                                            <h2 class="accordion-header" id="{{'heading'.$category->id}}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="{{'#collapse'.$category->id}}" aria-expanded="false" aria-controls="{{'collapse'.$category->id}}">
                                        <a href="{{route('products',['category'=>$category->id])}}">
                                                    {{$category->name}}
                                        </a>
                                                </button>
                                            </h2>
                                        <div id="{{'collapse'.$category->id}}" class="accordion-collapse collapse" aria-labelledby="{{'#heading'.$category->id}}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                            @foreach($category->children as $subCategory)
                                        <a href="{{route('products',['category'=>$subCategory->id])}}">

                                                <p>{{$subCategory->name}}</p>
                                                </a>
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </div> --}}
                        </div>
                        <form id="filters" method="POST" action="">
                            @csrf
                            <div class="interior-filter-box">
                                <h4>Makes</h4>
                                <div id="brandContainer" class="interior-filter-inner">
                                    @foreach ($brands as $key => $brand )
                                        <div class="custm-check make ">
                                            <input type="checkbox" id="{{'brand'.$key}}" name="brand[]" @if(request()->has('brand') && count(request()->brand) && in_array($brand->makes , request()->brand)) class="selected-entry" checked @endif  value="{{$brand->makes}}">
                                            <label for="{{'brand'.$key}}">{{$brand->makes}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cat-count"><span class="see-more-less-make">See More</span></div>
                            </div>
                            
                            <div class="interior-filter-box">
                                <h4>years</h4>
                                <div id="yearContainer" class="interior-filter-inner">
                                    @foreach ($years as $key => $year )
                                        <div class="custm-check year">
                                            <input type="checkbox" id="{{'year'.$key}}" name="year[]" @if(request()->has('year') && count(request()->year) && in_array($year , request()->year)) class="selected-entry" checked @endif value="{{$year}}">
                                            <label for="{{'year'.$key}}">{{$year}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cat-count"><span class="see-more-less-year">See More</span></div>
                            </div>

                            <div class="interior-filter-box">
                                <h4>models</h4>
                                <div id="modelContainer" class="interior-filter-inner">
                                    @foreach ($models as $key => $model )
                                        <div class="custm-check model">
                                            <input type="checkbox" id="{{'model'.$key}}" name="model[]" @if(request()->has('model') && count(request()->model) && in_array($model->value, request()->model)) class="selected-entry" checked @endif value="{{$model->value}}">
                                            <label for="{{'model'.$key}}">{{$model->value}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="cat-count"><span class="see-more-less-model">See More</span></div>
                            </div>


                            <button type="submit">test</button>
                                <div class="custom-wrapper"> 
                        
                                    <div class="price-input-container"> 
                                        <div class="price-input"> 
                                            <div class="price-field"> 
                                                <input type="number" 
                                                name="min_value"
                                                    class="min-input" 
                                                    value="{{old('min_value',0)}}"> 
                                            </div> 
                                            <div class="price-field"> 
                                                <input type="number" 
                                                name="max_value"
                                                    class="max-input" 
                                                    value="{{old('max_value',10000)}}"> 
                                            </div> 
                                        </div> 
                                        <div class="slider-container"> 
                                            <div class="price-slider"> 
                                            </div> 
                                        </div> 
                                    </div> 
                        
                                    <!-- Slider -->
                                    <div class="range-input"> 
                                        <input type="range" 
                                            class="min-range" 
                                            min="0" 
                                            max="10000" 
                                            value="{{old('min_value',0)}}" 
                                            step="1"> 
                                        <input type="range" 
                                            class="max-range" 
                                            min="0" 
                                            max="10000" 
                                            value="{{old('max_value',10000)}}" 
                                            step="1"> 
                                    </div> 
                                </div> 
                        </form>


                    </div>
                </div>
                
                <div class="interior-content-right-outer">
                    <div class="interior-content-right" id="interiorComponent">
                        {{-- <h2 class="interior-content-heading">Mirrors</h2> --}}
                        <h3>Categories by: Cars</h3>
                        <div class="accessories-parts">
                            <div class="row g-4">
                                {{-- @dd($product->productImage[0]->file_url) --}}
                                @forelse ($products as $product)
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="accessories-parts-box">
                                        <a href="{{ route(auth()->check() && auth()->user()->hasRole('Administrator') ? 'admin.products.details' : (auth()->check() ? auth()->user()->getRoleNames()->first() . '.products.details' : 'Dealer.products.details'), ['product' => $product->id]) }}">

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

                                                {{-- <div class="pro-dealer-box">
                                                    <h4>Dealer</h4>
                                                    <div class="pro-dealer-info">

                                                        <div class="dealer-img-box">

                                                            @if (isset($product->user->profile_picture_url))
                                                            <img src="{{ Storage::url($product->user->profile_picture_url) }}" alt="">
                                                            @endif
                                                        </div>

                                                    </div>
                                                    <div class="dealer-img-txt">
                                                        <a href="{{ route('Dealer.view.profile', $product->id) }}">
                                                            <u>
                                                                <h5>{{ $product->user->name ?? ' ' }}</h5>
                                                            </u>
                                                        </a>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @empty
                                <div class="col-md-12 col-lg-12 col-xl-12">
                                    <div class="accessories-parts-box empty-category ">
                                        <img src="{{ asset('assets/images/no-product.svg') }}  " alt="" width="300">
                                        <p class="text-center mt-1">Did not found any order</p>
                                    </div>
                                </div>
                                @endforelse

                            </div>

                        </div>
                    </div>
                </div>
                {{-- @empty
                
                @endforelse --}}
            </div>
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

        $('.see-more-less-make').on('click', function() {
            $('#brandContainer').toggleClass('full-data-view');
            if($(this).html() == "See More"){
                $(this).html('See less');
            } else{
                $(this).html('See More');
            }
            
        });
        $('.see-more-less-year').on('click', function() {
            $('#yearContainer').toggleClass('full-data-view');
            if($(this).html() == "See More"){
                $(this).html('See less');
            } else{
                $(this).html('See More');
            }
        });
        $('.see-more-less-model').on('click', function() {
            $('#modelContainer').toggleClass('full-data-view');
            if($(this).html() == "See More"){
                $(this).html('See less');
            } else{
                $(this).html('See More');
            }
        });


    });
</script>
<script>
        // Function to delay form submission
        function delayFormSubmission(formId, delay) {
            const form = document.getElementById(formId);
            
            if (!form) {
                console.error(`Form with id ${formId} not found.`);
                return;
            }

            let timeout;

            form.addEventListener('change', () => {
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    form.submit();
                }, delay);
            });
        }

        // Call the function with the form id and delay time in milliseconds (2000ms = 2 seconds)
        delayFormSubmission('filters', 100);
    </script>
<script>
    // Script.js 
    const rangevalue = 
        document.querySelector(".slider-container .price-slider"); 
    const rangeInputvalue = 
        document.querySelectorAll(".range-input input"); 

    // Set the price gap 
    let priceGap = 500; 

    // Adding event listners to price input elements 
    const priceInputvalue = 
        document.querySelectorAll(".price-input input"); 
    for (let i = 0; i < priceInputvalue.length; i++) { 
        priceInputvalue[i].addEventListener("input", e => { 

            // Parse min and max values of the range input 
            let minp = parseInt(priceInputvalue[0].value); 
            let maxp = parseInt(priceInputvalue[1].value); 
            let diff = maxp - minp 

            if (minp < 0) { 
                alert("minimum price cannot be less than 0"); 
                priceInputvalue[0].value = 0; 
                minp = 0; 
            } 

            // Validate the input values 
            if (maxp > 10000) { 
                alert("maximum price cannot be greater than 10000"); 
                priceInputvalue[1].value = 10000; 
                maxp = 10000; 
            } 

            if (minp > maxp - priceGap) { 
                priceInputvalue[0].value = maxp - priceGap; 
                minp = maxp - priceGap; 

                if (minp < 0) { 
                    priceInputvalue[0].value = 0; 
                    minp = 0; 
                } 
            } 

            // Check if the price gap is met 
            // and max price is within the range 
            if (diff >= priceGap && maxp <= rangeInputvalue[1].max) { 
                if (e.target.className === "min-input") { 
                    rangeInputvalue[0].value = minp; 
                    let value1 = rangeInputvalue[0].max; 
                    rangevalue.style.left = `${(minp / value1) * 100}%`; 
                } 
                else { 
                    rangeInputvalue[1].value = maxp; 
                    let value2 = rangeInputvalue[1].max; 
                    rangevalue.style.right = 
                        `${100 - (maxp / value2) * 100}%`; 
                } 
            } 
        }); 

        // Add event listeners to range input elements 
        for (let i = 0; i < rangeInputvalue.length; i++) { 
            rangeInputvalue[i].addEventListener("input", e => { 
                let minVal = 
                    parseInt(rangeInputvalue[0].value); 
                let maxVal = 
                    parseInt(rangeInputvalue[1].value); 

                let diff = maxVal - minVal 
                
                // Check if the price gap is exceeded 
                if (diff < priceGap) { 
                
                    // Check if the input is the min range input 
                    if (e.target.className === "min-range") { 
                        rangeInputvalue[0].value = maxVal - priceGap; 
                    } 
                    else { 
                        rangeInputvalue[1].value = minVal + priceGap; 
                    } 
                } 
                else { 
                
                    // Update price inputs and range progress 
                    priceInputvalue[0].value = minVal; 
                    priceInputvalue[1].value = maxVal; 
                    rangevalue.style.left = 
                        `${(minVal / rangeInputvalue[0].max) * 100}%`; 
                    rangevalue.style.right = 
                        `${100 - (maxVal / rangeInputvalue[1].max) * 100}%`; 
                } 
            }); 
        } 
    }

</script>
@endpush
@section('extra_css')
    <link rel="stylesheet" href="{{ asset('assets/css/price_slider.css') }}">
@endSection