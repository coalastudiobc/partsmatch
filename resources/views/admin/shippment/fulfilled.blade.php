@extends('layouts.admin')
@section('title', 'Fulfilled shipment')

@section('content')
    <div class="dashboard-right-box">
        <x-alert-component />
        <div class="product-detail-table cms-list-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th width="10%">
                            <p>Order ID</p>
                        </th>
                        <th width="10%">
                            <p>Products</p>
                        </th>
                        <th width="10%">
                            <p>Cart Amount</p>
                        </th>
                        <th width="10%">
                            <p>Ship Charges</p>
                        </th>
                        <th width="15%">
                            <p>Buy Date</p>
                        </th>
                        <th width="15%">
                            <p>Fulfilled Date</p>
                        </th>
                        <th width="20%">
                            <p>Delivery Date</p>
                        </th>
                        <th width="10%">
                            {{-- <p>Status</p> --}}
                        </th>
                    </tr>
                    @isset($fulfilledOrders)
                    @forelse($fulfilledOrders as $fulfilledOrder)
                    <tr>
                        <td>
                            <p>{{$fulfilledOrder? ( $fulfilledOrder->id ?? 'N/A') : 'N/A'}}</p>
                        </td>
                        <td>
                            <div class="pro-list-name" data-bs-toggle="modal" data-bs-target="#pickadress-modal">
                                <h4>{{$fulfilledOrder ? (count($fulfilledOrder->orderItem) ?? 'N/A') : 'N/A' }}</h4>
                            </div>
                        </td>
                        <td>
                            <p>${{$fulfilledOrder? ( $fulfilledOrder->total_amount ?? 'N/A') : 'N/A'  }}</p>
                        </td>
                        <td>
                            <p>${{$fulfilledOrder? ( $fulfilledOrder->shipment_price ?? 'N/A') : 'N/A' }}</p>
                        </td>
                        <td>
                            <p>{{ $fulfilledOrder ? ($fulfilledOrder->created_at ? date('m/d/Y', strtotime($fulfilledOrder->created_at)) : 'N/A'):'N/A' }}</p>
                        </td>
                        <td>
                            <p>{{ $fulfilledOrder ? ($fulfilledOrder->created_at ? date('m/d/Y', strtotime($fulfilledOrder->created_at)) : 'N/A'):'N/A' }}</p>
                        </td>
                        <td>
                            <p>{{ $fulfilledOrder ? ($fulfilledOrder->shippoPurchasedLabel->qr_code_url ?
                             date('m/d/Y', strtotime($fulfilledOrder->shippoPurchasedLabel->qr_code_url)) : 
                             \Carbon\Carbon::parse($fulfilledOrder->shippoPurchasedLabel->created_at)->addDays(5)->format('m/d/Y')):'N/A' }}</p>
                        </td>
                        <td>
                            <div class="confirm-badge">
                                <i class="fa-solid fa-check"></i>
                                @if (is_null($fulfilledOrder->shippoPurchasedLabel->rate_provider))
                                    <p>Manually</p>
                                @else
                                    
                                <p>Confirmed</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="no-record-found">
                            <center>Did not found any order </center>
                        </td>
                    </tr>
                    @endforelse
                    @endisset
                </table>
            </div>
        </div>
        @if($fulfilledOrders && count($fulfilledOrders)> 0)
        <div class="pagination-wrapper">
            {!! $fulfilledOrders->links('admin.pagination') !!}
        </div>
        @endif
    </div>

@endsection
