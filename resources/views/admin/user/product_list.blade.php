@extends('layouts.admin')
@section('title', 'product')
@section('heading', 'product list')

@section('content')

    <div class="dashboard-right-box">
        <h2>{{ $user->name }}</h2>
        <div class="product-detail-table user-list-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Name</p>
                        </th>
                        <th>
                            <p>stocks_avaliable</p>
                        </th>
                        <th>
                            <p>price</p>
                        </th>
                        <th>
                            <p>shipping_price</p>
                        </th>
                        <th>
                            <p>Status</p>
                        </th>
                    </tr>
                    @forelse ($products as $key => $product)
                        <tr>
                            <td>
                                <p>{{ $product->name ? $product->name : 'N/A' }}</p>
                            </td>
                            <td>
                                <p>{{ $product->stocks_avaliable ? $product->stocks_avaliable : 'N/A' }}</p>
                            </td>
                            <td>
                                <p>{{ $product->price ? $product->price : 'N/A' }}</p>
                            </td>
                            <td>
                                <p>{{ $product->shipping_price ? $product->shipping_price : 'N/A' }}</p>
                            </td>

                            <td>
                                <div class="toggle-btn">
                                    <input type="checkbox" id="switch{{ $key }}" class=""
                                        @if ($product->status == '1') checked="checked" @endif
                                        onchange="toggleStatus(this, 'Product', '{{ $product->id }}');"
                                        url="{{ route('product.status') }}"><label for="switch{{ $key }}"></label>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="no-record-found">
                                <center>Did not found any product </center>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
