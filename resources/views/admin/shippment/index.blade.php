@extends('layouts.admin')
@section('content')
    <div class="dashboard-right-box">
        <x-alert-component />
        <div class="product-detail-table cms-list-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Order Id</p>
                        </th>
                        <th>
                            <p>Products</p>
                        </th>
                        <th>
                            <p>Cart Amount</p>
                        </th>
                        <th>
                            <p>Shipment Amount</p>
                        </th>
                        <th>
                            <p>Buy Date</p>
                        </th>
                        <th>
                            <p>Fullfilled date</p>
                        </th>
                        <th>
                            <p>Action</p>
                        </th>
                    </tr>
                    @forelse($fulfilledOrders as $fulfilledOrder)
                    <tr>
                        <td>
                            <p>{{$fulfilledOrder? ( $fulfilledOrder->order_id ?? 'N/A') : 'N/A'}}</p>
                        </td>
                        <td>
                            <div class="pro-list-name" data-bs-toggle="modal" data-bs-target="#pickadress-modal">
                                <h4>{{$fulfilledOrder ? (count($fulfilledOrder->orderDetails->orderItem) ?? 'N/A') : 'N/A' }}</h4>
                            </div>
                        </td>
                        <td>
                            <p>${{$fulfilledOrder? ( $fulfilledOrder->orderDetails->total_amount ?? 'N/A') : 'N/A'  }}</p>
                        </td>
                        <td>
                            <p>${{$fulfilledOrder? ( $fulfilledOrder->orderDetails->shipment_price ?? 'N/A') : 'N/A' }}</p>
                        </td>
                        <td>
                            <p>{{ $fulfilledOrder ? ($fulfilledOrder->orderDetails->created_at ? date('m/d/Y', strtotime($fulfilledOrder->orderDetails->created_at)) : 'N/A'):'N/A' }}</p>
                        </td>
                        <td>
                            <p>{{ $fulfilledOrder ? ($fulfilledOrder->created_at ? date('m/d/Y', strtotime($fulfilledOrder->created_at)) : 'N/A'):'N/A' }}</p>
                        </td>
                        <td>
                            {{-- <a class="btn primary-btn" href="{{route('admin.shippment.rate.shipment',jsencode_userdata($fulfilledOrder->id))}}">
                            Create Label</a> --}}
                            <div class="dropdown shipment-data-dropdown">
                                <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                  <li><a class="dropdown-item" href="{{route('admin.shippment.rate.shipment',jsencode_userdata($fulfilledOrder->id))}}">Create Label</a></li>
                                  <li><a class="dropdown-item" href="{{route('admin.shippment.manual',jsencode_userdata($fulfilledOrder->id))}}">Manual</a></li>
                                </ul>
                              </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="no-record-found">
                            <center>Did not found any shipment </center>
                        </td>
                    </tr>
                    @endforelse
                </table>
            </div>
        </div>
        <div class="pagination-wrapper">
            {!! $fulfilledOrders->links('admin.pagination') !!}
        </div>
    </div>

@endsection
