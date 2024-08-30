@extends('layouts.admin')
@section('title', 'products')
@section('heading', 'All Products')

@section('content')

    <div class="dashboard-right-box">
        <div class="serach-and-filter-box justify-content-end">
            <form action="">
                <div class="pro-search-box">
                    <input type="text" name="filter_by_name" class="form-control" value="{{ request('filter_by_name') }}" placeholder="Search Product">
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
            <form action="">
                <div class="search-cross-btn">
                    <a href="{{ route('admin.products.list') }}"><i class="fa-solid fa-xmark"></i></a>
                </div>
            </form>
            @endif
        </div>
        <div class="product-detail-table product-list-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Part Number</p>
                        </th>
                        <th>
                            <p>Name</p>
                        </th>
                        <th>
                            <p>Stocks Avaliable</p>
                        </th>
                        {{-- <th>
                            <p>Price</p>
                        </th> --}}
                        {{-- <th>
                            <p>Shipping Price</p>
                        </th> --}}
                        <th>
                            <p>Status</p>
                        </th>
                        <th>
                            <p>View details</p>
                        </th>
                    </tr>
                    @forelse ($products as $key => $product)
                        <tr>
                            <td>
                                <p>{{ $product ? ($product->part_number ?? 'N/A') : 'N/A' }}</p>
                            </td>
                            <td>
                                <p>{{ $product ? ($product->name ?? 'N/A') : 'N/A' }}</p>
                            </td>
                            <td>
                                <p>{{ $product ? ( $product->stocks_avaliable ?? '0') : 'N/A' }}</p>
                            </td>
                            {{-- <td>
                                <p>${{ $product->price ? number_format($product->price,2,'.',',') : 'N/A' }}</p>
                            </td> --}}
                            {{-- <td>
                                <p>{{ $product->shipping_price ? $product->shipping_price : 'N/A' }}</p>
                            </td> --}}

                            <td>
                                <div class="toggle-btn">
                                    <input type="checkbox" id="switch{{ $key }}" class=""
                                        @if ($product->status == '1') checked="checked" @endif
                                        onchange="toggleStatus(this, 'Product', '{{ $product->id }}');"
                                        url="{{ route('product.status') }}"><label for="switch{{ $key }}"></label>
                                </div>
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="btn action-view-btn productDetails"
                                    data-url="{{ route('admin.dealers.product.detail', [$product->id]) }}">View
                                    details</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="no-record-found">
                                <center>Did not found any parts </center>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
        @isset($products)  
        <div class="pagination-wrapper">
            {!! $products->links('admin.pagination') !!}
        </div>
        @endif
    </div>
@endsection
@section('modals')
    <div id="productDetailsModel">
        <div class="modal fade" id="pro-detail-model" tabindex="-1" aria-labelledby="bulk-upload" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" id="ajax-form-html">
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        jQuery(document).ready(function() {
            function loadSlick() {
                jQuery('.product-slider').slick({
                    dots: false,
                    infinite: true,
                    speed: 500,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    arrows: true,
                    responsive: [{
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 400,
                            settings: {
                                arrows: false,
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            }

            jQuery('.productDetails').on('click', function() {
                var url = $(this).attr('data-url');
                var response = ajaxCall(url, 'get', null, false);
                response.then(handleStateData).catch(handleStateError)

                function handleStateData(response) {
                    if (response.success == true) {
                        jQuery('#ajax-form-html').html(response.model)
                        loadSlick();
                        jQuery("#pro-detail-model").modal('show');

                    } else {
                        jQuery('#errormessage').html(response.error);
                    }
                }

                function handleStateError(error) {
                    console.log('error', error)

                }
            })
        });
    </script>
@endpush
