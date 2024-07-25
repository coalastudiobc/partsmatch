@extends('layouts.dealer')
@section('title', 'My Orders')
@section('heading', 'Order')

@section('content')

<div class="dashboard-right-box">
    <div class="product-detail-table product-list-table">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>product Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Status</th>
                </tr>
                @forelse ($orderItem as $key => $order)
                <tr>
                    <td>
                        <div class="product-view-img">
                            <a href="{{ route('Dealer.products.details', productByOrderItem($order->product_id)->id)}}">
                                <img src="{{ asset('storage/' . (productByOrderItem($order->product_id)->productImage[0]->file_url ?? '')) }}" alt="Product Image">
                            </a>
                        </div>
                    </td>
                    <td>
                        <p>{{productByOrderItem($order->product_id)->name ?? 'N/A' }}</p>
                    </td>
                    <td>
                        <p>${{ productByOrderItem($order->product_id)->price ?? 'N/A' }}</p>
                    </td>
                    <td>
                        <p>{{ productByOrderItem($order->product_id)->productCompatible[0]->make ?? 'N/A' }}</p>
                    </td>
                    <td>
                        <p>{{ productByOrderItem($order->product_id)->productCompatible[0]->model ?? 'N/A' }}</p>
                    </td>
                    <td>
                        <div class="pro-status">

                            <div class="dropdown">

                                <div class="badge complete-badge" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-check"></i> Complete
                                </div>

                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <div class="empty-data">
                    <img src="{{ asset('assets/images/no-product.svg') }}  " alt="" width="300">
                    <p class="text-center mt-1">Did not found any order</p>
                </div>
                @endforelse

            </table>
        </div>
    </div>
</div>
@endsection