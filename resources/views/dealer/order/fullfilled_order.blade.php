@extends('layouts.dealer')
@section('title', 'Order Management')
@section('heading', 'Order Management')
@section('content')
<div class="dashboard-right-box">
            <div class="serach-and-filter-box justify-content-end">
                <div class="pro-search-box">
                    <input type="text" class="form-control" name="filter_by_name" placeholder="Search">
                    <a href="#" class="btn primary-btn"><i class="fa-solid fa-magnifying-glass"></i></a>
                </div>
        </div>
     <div class="product-detail-table product-list-table">
        <x-alert-component />
        <div class="table-responsive">
            <div class="test">
                <table class="table">
                    <tr>
                        <th>
                            <p>Order ID</p>
                        </th>
                        <th>
                            <p>Total products</p>
                        </th>
                        <th>
                            <p>Amount</p>
                        </th>

                        <th>
                            <p>Shippment price</p>
                        </th>
                        <th>
                            <p>Date</p>
                        </th>
                        <th>
                            <p>Action</p>
                        </th>
                    </tr>
                 @isset ($fulfilledOrders)
                    @forelse ($fulfilledOrders as $order)
                    <tr>
                        <td>
                            <p>{{ $order->id }}</p>
                        </td>
                        <td>
                            <div class="pro-list-name">
                                <h4>{{ count($order->orderItem) }}</h4>
                            </div>
                        </td>

                        <td>
                            <p>${{ $order->total_amount }}</p>
                        </td>
                        <td>
                            <p>${{ $order->shipment_price }}</p>
                        </td>
                        <td>
                            <p>{{ date('d-m-Y', strtotime($order->created_at)) }}</p>
                        </td>

                        {{-- <td>
                                            <div class="invoive-download">
                                                <a href="#" class="invoice-download">
                                                    <img src="images/invoice-download.png" alt="">
                                                    Download
                                                </a>

                                            </div>
                                        </td> --}}
                        <td>
                            <a class="btn primary-btn" href="{{route('Dealer.order.fullfilled.shippment.details',['order_id'=>$order->id])}}">
                            Track Details</a>
                        </td>
                    </tr>
                    @empty
                    <div class="empty-data">
                        <img src="{{ asset('assets/images/no-product.svg') }}  " alt="" width="300">
                        <p class="text-center mt-1">Did not found any fullfilled order</p>
                    </div>
                    @endforelse
                 @endisset
                </table>
            </div>
        </div>
    </div>

</div>
 </div>
@endsection