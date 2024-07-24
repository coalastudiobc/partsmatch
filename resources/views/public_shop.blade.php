@extends('layouts.front')
@section('title', 'Products')
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
                        <a href="{{route('products')}}">Clear All</a>
                    </div>
                    @if((request()->has('brand') && count(request()->brand)) || (request()->has('year') && count(request()->year)) || (request()->has('model') && count(request()->model)) )
                        <div class="interior-filter-box filter-preview">
                            <div class="filter-selected-data">
                                @if(request()->has('brand') && count(request()->brand))
                                    @forelse(request()->brand as $brand)
                                            <div class="filter-selected-box">
                                                <a href="javascript:void(0)" data-action="brand" class="delete-filter">✕</a>
                                                <p>{{$brand}}</p>
                                            </div>
                                    @empty
                                    @endforelse
                                @endif
                                @if(request()->has('year') && count(request()->year))
                                    @forelse(request()->year as $year)
                                            <div class="filter-selected-box">
                                                <a href="javascript:void(0)" data-action="year" class="delete-filter">✕</a>
                                                <p>{{$year}}</p>
                                            </div>
                                    @empty
                                    @endforelse
                                @endif
                                @if(request()->has('model') && count(request()->model))
                                    @forelse(request()->model as $model)
                                            <div class="filter-selected-box">
                                                <a href="javascript:void(0)" data-action="model" class="delete-filter">✕</a>
                                                <p>{{$model}}</p>
                                            </div>
                                    @empty
                                    @endforelse
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="interior-filter-body">
                        <div class="interior-filter-box">

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button p-0 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4>Categories</h4>
                                    </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body p-0">
                                            <div class="category-list">
                                                <div class="form-group">
                                                    <div class="formfield">
                                                        <input type="text" class="form-control filter-serach" placeholder="Search">
                                                        <span class="filter-serach-icon">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </span>
                                                    </div>
                                                </div>
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
                        </div>
                        <form id="filters" method="POST" action="">
                            @csrf
                            <div class="interior-filter-box">

                                <div class="accordion" id="accordionExample1">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <h4>Makes</h4>
                                        </button>
                                      </h2>
                                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample1">
                                        <div class="accordion-body">
                                            <div id="brandContainer" class="interior-filter-inner">
                                                <div class="form-group">
                                                    <div class="formfield">
                                                        <input type="text" class="form-control filter-serach" placeholder="Search">
                                                        <span class="filter-serach-icon">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                @foreach ($brands as $key => $brand )
                                                    <div class="custm-check make ">
                                                        <input type="checkbox" id="{{'brand'.$key}}" name="brand[]" @if(request()->has('brand') && count(request()->brand) && in_array($brand->makes , request()->brand)) class="selected-entry" checked @endif  value="{{$brand->makes}}">
                                                        <label for="{{'brand'.$key}}">{{$brand->makes}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="cat-count"><span class="see-more-less-make">See More</span></div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            
                            <div class="interior-filter-box">

                                <div class="accordion" id="accordionExample2">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <h4>years</h4>
                                        </button>
                                      </h2>
                                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample2">
                                        <div class="accordion-body">
                                            <div id="yearContainer" class="interior-filter-inner">
                                                <div class="form-group">
                                                    <div class="formfield">
                                                        <input type="text" class="form-control filter-serach" placeholder="Search">
                                                        <span class="filter-serach-icon">
                                                            <i class="fa-solid fa-magnifying-glass"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                @foreach ($years as $key => $year )
                                                    <div class="custm-check year">
                                                        <input type="checkbox" id="{{'year'.$key}}" name="year[]" @if(request()->has('year') && count(request()->year) && in_array($year , request()->year)) class="selected-entry" checked @endif value="{{$year}}">
                                                        <label for="{{'year'.$key}}">{{$year}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="cat-count"><span class="see-more-less-year">See More</span></div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                            </div>

                            <div class="interior-filter-box">

                                <div class="accordion" id="accordionExample3">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            <h4>Models</h4>
                                        </button>
                                      </h2>
                                      <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample3">
                                        <div class="accordion-body">
                                            <div id="modelContainer" class="interior-filter-inner">
                                                @foreach ($models as $key => $model )
                                                    <div class="custm-check model">
                                                        <input type="checkbox" id="{{'model'.$key}}" name="model[]" @if(request()->has('model') && count(request()->model) && in_array($model->value, request()->model)) class="selected-entry" checked @endif value="{{$model->value}}">
                                                        <label for="{{'model'.$key}}">{{$model->value}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="cat-count"><span class="see-more-less-model">See More</span></div>
                                     </div>
                                      </div>
                                    </div>
                                </div>
                            </div>
                                <div class="interior-filter-box">
                                    <h4>Price</h4>
                                    <div class="custom-wrapper"> 
                                        <div class="price-input-container"> 
                                            <div class="price-input"> 
                                                <div class="price-field left"> 
                                                    <input type="number" disabled
                                                    name="min_value"
                                                        class="min-input" 
                                                        value="0"> 
                                                </div> 
                                                <div class="price-field right"> 
                                                    <input type="number" disabled
                                                    name="max_value"
                                                        class="max-input" 
                                                        value="10000"> 
                                                </div> 
                                            </div> 

                                            <div class="test d-none"> 
                                                <div class="test-field left"> 
                                                    <input type="number" id="selectedMinValue"
                                                    name="min_value1"
                                                        class="min-input-1" 
                                                        value="0"> 
                                                </div> 
                                                <div class="test-field right"> 
                                                    <input type="number" id="selectedMaxValue"
                                                    name="max_value1"
                                                        class="max-input-1" 
                                                        value="10000"> 
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
                                                value="0" 
                                                step="1"> 
                                            <input type="range" 
                                                class="max-range" 
                                                min="0" 
                                                max="10000" 
                                                value="10000" 
                                                step="1"> 
                                        </div> 
                                    </div>    
                                </div> 
                        </form>


                    </div>
                    <div class="interior-content-right-outer">
                        <div class="interior-content-right" id="interiorComponent">
                            {{-- <h2 class="interior-content-heading">Mirrors</h2> --}}
                            <!-- <h3>Result : </h3>  -->
                            <div class="accessories-parts">
                                <div class="row g-4">
                                    {{-- @dd($product->productImage[0]->file_url) --}}
                                    @forelse ($products as $product)
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="accessories-parts-box">
    
                                                <div class="more-product-cards cstm-card">
                                            <a href="{{ route(auth()->check() && auth()->user()->hasRole('Administrator') ? 'admin.products.details' : (auth()->check() ? auth()->user()->getRoleNames()->first() . '.products.details' : 'Dealer.products.details'), ['product' => $product->id]) }}">
                                                    <div class="product-cards-img">
                                                        <img src="{{ $product->productImage && count($product->productImage) ? Storage::url($product->productImage[0]->file_url) : asset('assets/images/gear-logo.svg') }}" alt="">
                                                    </div>
                                            </a>

                                                    <div class="product-deails">
                                                        <p>{{ $product->name }}</p>
                                                        <div class="price-and-cart">
                                                            <div class="discount-price">
                                                                <!-- <span>{{ $product->price * 1.5 }}</span> -->
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
                </div>
            </div>
        </div>
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
@section('modals')
@include('modals.restrict_multiple')
@endsection
@push('scripts')


<script>
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

    delayFormSubmission('filters', 100);
</script>
<script>
    $(document).ready(function() {

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

        $('.delete-filter').on('click', function() {
            var filter = $(this).siblings('p').html();
            filter = $("label:contains('"+filter+"')").attr('for')
            $("#"+filter).prop('checked',false);
            $('#filters').submit();
        });


    });
</script>

<script>
    const rangevalue = document.querySelector(".slider-container .price-slider"); 
    const rangeInputvalue = document.querySelectorAll(".range-input input"); 
    let priceGap = 500; 
    const priceInputvalue = document.querySelectorAll(".price-input input"); 
    for (let i = 0; i < priceInputvalue.length; i++) { 
        priceInputvalue[i].addEventListener("input", e => { 
            let minp = parseInt(priceInputvalue[0].value); 
            let maxp = parseInt(priceInputvalue[1].value); 
            let diff = maxp - minp 
            if (minp < 0) { 
                alert("minimum price cannot be less than 0"); 
                priceInputvalue[0].value = 0; 
                minp = 0; 
            } 
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
        for (let i = 0; i < rangeInputvalue.length; i++) { 
            rangeInputvalue[i].addEventListener("input", e => { 
                let minVal = 
                    parseInt(rangeInputvalue[0].value); 
                let maxVal = 
                    parseInt(rangeInputvalue[1].value); 

                let diff = maxVal - minVal 
                if (diff < priceGap) { 
                    if (e.target.className === "min-range") { 
                        rangeInputvalue[0].value = maxVal - priceGap; 
                    } 
                    else { 
                        rangeInputvalue[1].value = minVal + priceGap; 
                    } 
                } 
                else { 
                    priceInputvalue[0].value = minVal; 
                    priceInputvalue[1].value = maxVal; 
                    $('#selectedMinValue').val(minVal);
                    $('#selectedMaxValue').val(maxVal);
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