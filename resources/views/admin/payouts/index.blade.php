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
                            <p>Seller</p>
                        </th>
                        <th>
                            <p>Cart Amount</p>
                        </th>
                        <th>
                            <p>Shipment Charges</p>
                        </th>
                        <th>
                            <p>Buy Date</p>
                        </th>
                        {{-- <th>
                            <p>Fullfilled Date</p>
                        </th> --}}
                        <th>
                            <p>Delivered Date</p>
                        </th>
                        <th>
                            <p>Paying Amount</p>
                        </th>
                        <th>
                            <p>Action</p>
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
                            <p>{{$fulfilledOrder? ( $fulfilledOrder->sellerDetail->email ?? 'N/A') : 'N/A'  }}</p>
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
                        {{-- <td>
                            <p>{{ $fulfilledOrder ? ($fulfilledOrder->created_at ? date('m/d/Y', strtotime($fulfilledOrder->created_at)) : 'N/A'):'N/A' }}</p>
                        </td> --}}
                        <td>
                            <p>{{ $fulfilledOrder ? ($fulfilledOrder->created_at ? date('m/d/Y', strtotime($fulfilledOrder->created_at)) : 'N/A'):'N/A' }}</p>
                        </td>
                        <td>
                            <p>${{calculatePayOuts($fulfilledOrder->order_for,$fulfilledOrder->shipment_price,$fulfilledOrder->total_amount)}}</p>
                        </td>
                        <td>
                            @if (isPaid($fulfilledOrder))
                                <div class="confirm-badge">
                                    <i class="fa-solid fa-check"></i>
                                    <p>Confirmed</p>
                                </div>
                            @else
                                    <a href="{{route('admin.payouts.getpayment',$fulfilledOrder)}}" class="btn primary-btn payout"  data-amount="{{calculatePayOuts($fulfilledOrder->order_for,$fulfilledOrder->shipment_price,$fulfilledOrder->total_amount)}}">Pay Out</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="no-record-found">
                            <center>Did not found any payout </center>
                        </td>
                    </tr>
                    @endforelse
        @endisset

                </table>
            </div>
        </div>
        @isset($fulfilledOrders)
        <div class="pagination-wrapper">
        @if($fulfilledOrders)
        {!! $fulfilledOrders ?? $fulfilledOrders->links('admin.pagination')  !!}
        @endif
    </div>
    </div>
@endsection
@push('scripts')
<script>
    jQuery(document).ready(function () {
    jQuery(".payout").click(function (e) {
        e.preventDefault();
        jQuery('body').addClass('modal-open');
       var amount= jQuery(this).attr('data-amount');
        let url = jQuery(this).attr('href');
        swal({
            title: 'Do you want to proceed with the payout?',
            text: 'You will pay out $' + amount ,
            icon: 'warning',
            buttons: true,
            successMode: true,
            buttons: ["No", "Yes"],
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.replace(url)
                } else {
                    jQuery('body').removeClass('modal-open');
                }
            });
    });
});
</script>
    
@endpush
