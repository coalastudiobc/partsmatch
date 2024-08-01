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
                            <p>{{$order? ( $order->id ?? 'N/A') : 'N/A'}}</p>
                        </td>
                        <td>
                            <div class="pro-list-name" data-bs-toggle="modal" data-bs-target="#pickadress-modal">
                                <h4>{{$order ? (count($order->orderItem) ?? 'N/A') : 'N/A' }}</h4>
                            </div>
                        </td>

                        <td>
                            <p>${{$order? ( $order->total_amount ?? 'N/A') : 'N/A'  }}</p>
                        </td>
                        <td>
                            <p>${{$order? ( $order->shipment_price ?? 'N/A') : 'N/A' }}</p>
                        </td>
                        <td>
                            <p>{{ $order ? ($order->created_at ? date('d-m-Y', strtotime($order->created_at)) : 'N/A'):'N/A' }}</p>
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
                        <p class="text-center mt-1">Did not found any fulfilled order</p>
                    </div>
                    @endforelse
                 @endisset
                </table>
            </div>
        </div>
    </div>
    @isset($order)
    <div class="modal fade" id="pickadress-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="">
                            <h3 class="pick-address-head">Parcels info</h3>
                            <div class="row groupsOfparcels" >
                                <h3>Group one</h3>
                               <x-view-grouped-products :groups="viewGroups($order)" />
                            </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    @endisset
</div>
@endsection