@extends('layouts.admin')
@section('title', 'Featured Product')
@section('content')

    <div class="dashboard-right-box">
        <x-alert-component />

        {{-- <h2>CMS</h2> --}}

        <div class="product-detail-table cms-list-table admin-feature-list">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th width="20%">
                            <p>Part Image</p>
                        </th>
                        <th width="20%">
                            <p>Dealer Name</p>
                        </th>
                        <th width="30%">
                            <p>Part Number</p>
                        </th>
                        <th width="20%">
                            <p>Part Price</p>
                        </th>
                        <th width="10%">
                            <p>Quantity</p>
                        </th>
                        {{-- <th>
                            <p>Featured Status</p>
                        </th> --}}

                        {{-- <th>
                            <p>Action</p>
                        </th> --}}

                    </tr>
                    @forelse($feature_products as $key => $feature_product)
                        <tr>
                            <td>
                                <img src="{{($feature_product->product && count($feature_product->product->productImage)) ? ( Storage::url(@$feature_product->product->productImage[0]->file_url ) ) : asset('assets/images/gear-logo.svg') }}"
                                    alt="img" height="50px" width="50px">
                        </td>

                            <td>
                                <p>{{ $feature_product->product->user ? ($feature_product->product->user->name ?? 'N/A'):'N/A'}}
                                </p>
                            </td>
                            <td>
                                <p>{{ $feature_product->product ? ($feature_product->product->part_number ?? 'N/A'):'N/A'  }}</p>
                            </td>
                            <td>
                                <p> {{ $feature_product->product 
                                    ? number_format($feature_product->product->price, 2, '.', ',') 
                                    : 'N/A' }}</p>
                            </td>
                            <td>
                                <p>{{ $feature_product->product ? ($feature_product->product->stocks_avaliable ?? 0) :'N/A' }}</p>
                            </td>

                          
                            {{-- <td> --}}

                                {{-- <div class="toggle-btn">
                                    <input type="checkbox" id="switch1{{ $key }}"
                                        data-id=" @if (isset($feature_product->id)) {{ $feature_product->id }} @else 0 @endif"
                                        product-id="{{ $feature_product->product->id }}"
                                        class="custom-switch-input feature-switch"
                                        @if (isset($feature_product->product->user->subscription) &&
                                                @$feature_product->product->user->subscription[0]->stripe_status == 'active') checked="checked" @endif
                                        @if (isset($feature_product->product->user->subscription) &&
                                                @$feature_product->product->user->subscription[0]->stripe_status != 'active') disabled @endif><label
                                        for="switch1{{ $key }}"></label>
                                </div> --}}
                               
                            {{-- </td> --}}

                            {{-- <td>
                                <div class="table-pro-quantity">
                                    1
                                </div>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td class="no-record-found">
                                <center>Did not found any User </center>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {{-- <div class="pagination-wrapper">
            <div class="pagination-boxes">
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
            </div>
        </div> --}}
    </div>

@endsection

@push('scripts')
    <script>
        jQuery(document).on('click', ".feature-switch", function() {
            var id = $(this).attr('data-id');
            // console.log(id, "herererererer");
            if (id != 0) {
                $.ajax({
                    url: APP_URL + "/dealer/featured/products/delete/" + id,
                    success: function(result) {
                        if (result.status == true) {
                            $(".feature-switch").addClass('checked', false);
                            location.reload();

                        }

                    }

                })
            } else {
                var id = $(this).attr('product-id');
                $.ajax({
                    url: APP_URL + "/dealer/featured/products/create/" + id,
                    success: function(result) {
                        if (result.status == true) {
                            location.reload();
                        } else {
                            $(".feature-switch").addClass('checked', false);
                        }
                    }

                })
            }
        })
    </script>
@endpush
