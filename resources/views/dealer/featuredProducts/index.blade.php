@extends('layouts.dealer')
@section('title', 'Featured products')
@section('content')
<div class="dashboard-right-box">
    <div class="serach-and-filter-box justify-content-end">
        <div class="pro-search-box">
            <form action="">
                <div class="pro-search-box">
                    <input type="text" name="filter_by_name" class="form-control" value="{{ request('filter_by_name') }}" placeholder="Search">
                    <button type="submit" class="btn primary-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
            @if(request('filter_by_name'))
            {{-- <form action="">
                <div class="search-cross-btn">
                    <input type="hidden" name="filter_by_name">
                    <button type="submit" ><i class="fa-solid fa-xmark"></i></button>
                </div>
            </form> --}}
                <div class="search-cross-btn">
                    <a href="{{ route('Dealer.feature.products.view') }}"><i class="fa-solid fa-xmark"></i></a>
                </div>
            @endif
        </div>
        <div >
            {{-- data-bs-toggle="modal" data-bs-target="#exampleModal" --}}
            @if($hasActiveSubscription)
            <a href="javascript:void(0)" class="btn primary-btn addproductbtn"  >
                <img src="{{ asset('assets/images/add-round-icon.svg') }}" alt=""> Add
            </a>
            @else
            <a href="javascript:void(0)" class="btn primary-btn " data-bs-toggle="modal" data-bs-target="#exampleModal1" >
                <img src="{{ asset('assets/images/add-round-icon.svg') }}" alt=""> Add
            </a>
            @endif
        </div>
    </div>

    <div class="product-detail-table product-list-table pro-manage-table">
        <div class="table-responsive">
            <table class="table ">
                <tr>
                    <th width="30%">
                        <p>Part Image</p>
                    </th>
                    <th width="30%">
                        <p>Part Number</p>
                    </th>
                    <th width="30%">
                        <p>Part name</p>
                    </th>
                    <th class="featured-product-qua" width="10%">
                        <p>Quantity</p>
                    </th>
                    {{-- <th>
                        <p>Is Featured</p>
                    </th> --}}
                    {{-- <th>
                        <p>Status</p>
                    </th> --}}
                </tr>
                @forelse ($products as $key => $product)
                    <tr>
                        <td>
                            <div class="pro-img-box">
                                <img src="{{ $product->productImage && count($product->productImage) ? Storage::url($product->productImage[0]->file_url) : asset('assets/images/gear-logo.svg') }}"
                                    alt="img">
                            </div>
                        </td>
                        <td>
                            <p>{{ $product->part_number }}</p>
                        </td>
                        <td>
                            <p>{{ $product->name }}</p>
                        </td>
                        {{-- <td>
                            <p> @if($product && is_numeric($product->price))
                                ${!! number_format((float) $product->price, 2, '.', ',') !!}
                            @else
                                N/A
                            @endif</p>
                        </td> --}}
                        <td>
                            <p>{{ $product->stocks_avaliable }}</p>
                        </td>
                        {{-- <td>
                            <div class="toggle-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to Active/Inactive listing of products">
                                <input type="checkbox" id="switch100{{ $key }}" class="custom-switch-input"
                                    @if ($product->status == '1') checked="checked" @endif
                                    onchange="toggleStatus(this, 'Product', '{{ $product->id }}');"
                                    url="{{ route('Dealer.products.status') }}" ><label
                                    for="switch100{{ $key }}">Toggle</label>
                            </div>
                        </td> --}}

                      {{--  <td>
                         <div class="toggle-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="sponserd products">
                            <input type="checkbox" id="switch1{{ $key }}"
                            data-id=" @if (isset($product->featuredProduct->id)) {{ $product->featuredProduct->id }} @else 0 @endif"
                            product-id="{{ $product->id }}" class="custom-switch-input feature-switch"
                            @if (isset($product->featuredProduct) && $product->featuredProduct != null) checked="checked" @endif
                            @if (!plan_validity()) disabled @endif onchange="toggleStatus(this, 'FeatureProduct', '{{ $product->id }}');"
                            url="{{ route('Dealer.feature.products.status') }}" ><label for="switch1{{ $key }}">Toggle</label>
                        </div>
                     </td>  --}}
                    </tr>
                @empty
                    <div class="empty-data">
                        <img src="{{ asset('assets/images/no-product.svg') }}" alt="" width="300">
                        <p class="text-center mt-1">Did not found any parts</p>
                    </div>
                @endforelse
            </table>
        </div>
    </div>
    {{-- {!! $products->links('dealer.pagination') !!} --}}

@endsection

@section('modals')
    <div class="modal fade add-new-pro-modal" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            </div>
            
        </div>
    </div>

    <div class="modal fade add-new-pro-modal" id="exampleModal1" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="product-detail-table product-list-table pro-manage-table">
                        <div class="table-responsive">
                            <div class="empty-data">
                                <img src="{{ asset('assets/images/no-product.svg') }}" alt="" width="300">
                                <p class="text-center mt-1">To add parts. Please  <a href="{{ route('Dealer.subscription.plan') }}"><u> subscibe </u></a> feature plans first.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
            
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        jQuery(document).ready(function (e)
        {
           jQuery('.addproductbtn').on('click',function (e) 
           {
                var url = APP_URL + '/dealer/products/excludeFeatured';
                let response = ajaxCall(url, 'get',null,false);
                response.then(handleSuccess).catch(handleError)
                function handleSuccess(response)
                 {
                    if (response.status == true) 
                    {
                        jQuery('#exampleModal .modal-content').html(response.data);
                        jQuery('#submit-button').prop('disabled', true); //initially disable the button of submit because if no selection to controller then error show
                        jQuery('#exampleModal').modal('show');
                    } else {
                        jQuery('#errormessage').html(response.error);
                    }
                }

                function handleError(error) 
                {
                    console.log('error', error)
                }  
            });

            const maxLimit = @json($featureLimit); 
            let selectedCount = {{ count($alreadyFeaturedProductIds) }};
            function checkLimit()
            {
                
                if (selectedCount > maxLimit) {
                    jQuery('#limit-message').text('You have exceeded the limit of ' + maxLimit + ' featured products.');
                    jQuery('#submit-button').prop('disabled', true);
                } else {
                    jQuery('#limit-message').text('');
                    jQuery('#submit-button').prop('disabled', false);
                }
            }

            jQuery(document).on('change' , '#featureCheckbox' , function (){
                console.log('chebox');
                if (jQuery(this).is(':checked')) {
                    selectedCount++;
                    console.log(this,selectedCount);
                } else {
                    selectedCount--;
                    console.log(this,selectedCount);
                }
                checkLimit();
            });

            // Run the check on page load
            checkLimit();
        });

    </script>
@endpush