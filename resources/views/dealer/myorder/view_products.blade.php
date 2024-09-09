@extends('layouts.dealer')
@section('title', 'My Orders')
@section('heading', 'Order')

@section('content')

<div class="dashboard-right-box">
    <div class="product-detail-table product-list-table">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Product Image</th>
                    <th>Part Number</th>
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
                            <a href="{{ route('product.detail', $order->product_id)}}">
                                <img src="{{$order->trashedProduct ? (($order->trashedProduct->productImage && count($order->trashedProduct->productImage)) ? Storage::url($order->trashedProduct->productImage[0]->file_url)  : asset('assets/images/gear-logo.svg')) :asset('assets/images/gear-logo.svg') }}" alt="Product Image">
                            </a>
                        </div>
                    </td>
                    <td>
                        <p>{{$order->trashedProduct ? $order->trashedProduct->part_number : 'N/A' }}</p>
                    </td>
                    <td>
                        <p>{{$order->trashedProduct ? $order->trashedProduct->name : 'N/A' }}</p>
                    </td>
                    <td>
                        <p>${{$order->trashedProduct ? $order->trashedProduct->price : 'N/A'  }}</p>
                    </td>
                    <td>
                        <p>{{ $order->trashedProduct
            ? ($order->trashedProduct->productCompatible && isset($order->trashedProduct->productCompatible[0])
                ? $order->trashedProduct->productCompatible[0]->make
                : 'N/A'
            )
            : 'N/A'  }}</p>
                    </td>
                    <td>
                        <p>{{ $order->trashedProduct
            ? ($order->trashedProduct->productCompatible && isset($order->trashedProduct->productCompatible[0])
                ? $order->trashedProduct->productCompatible[0]->model
                : 'N/A'
            )
            : 'N/A'  }}</p>
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