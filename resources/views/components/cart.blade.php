<div class="page-content-wrapper cart-page-wrapper">
    <div class="row g-3">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="cart-table-wrapper">
                <div class="db-table-box">
                    <div class="tb-table table-responsive">
                        @if (isset($cart->cartProducts))
                            @if ($cart && $cart->cartProducts && count($cart->cartProducts))
                                <table>
                                    <thead>
                                        <tr>
                                            <th>image</th>
                                            <th>product</th>
                                            <th>price</th>
                                            <th>quantity</th>
                                            <th>total</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cart->cartProducts as $product)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('product.detail',['product' => $product->product_id])}}">
                                                        <div class="cart-product-image">

                                                            <img src="{{ isset($product->product->productImage[0]) ? ($product->product->productImage[0])?( Storage::url($product->product->productImage[0]->file_url)) : asset('assets/images/gear-logo.svg') : asset('assets/images/gear-logo.svg') }}" alt="">
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>{{ $product->product ? $product->product->name : 'N/A' }}</td>
                                                <td>${{ $product->product ? $product->product->price : 'N/A' }} </td>
                                                <td>
                                                    <div class="product-quantity-box targetLoaderDiv">
                                                        <div class="button-loader d-none"></div>
                                                        <div class="quantity-btn quantity-brd">
                                                            @if ($product->quantity != 1)
                                                            <a href="javascript:void(0)" class="minus cartupdate" data-product_id="{{ $product->id }}" data_quantity_id="{{ '#quantity' . $product->id }}" data-stocks="{{ $product->product ? $product->product->stocks_avaliable : '' }}">-</a>
                                                            @endif
                                                            <input type="text" name="quantity" class="quantity" id="{{ 'quantity' . $product->id }}" value="{{ $product->quantity ?? '' }}" data-product_id="{{ $product->id }}" data_quantity_id="{{ '#quantity' . $product->id }}" placeholder="">
                                                            <a href="javascript:void(0)" class="plus cartupdate" data-product_id="{{ $product->id }}" data_quantity_id="{{ '#quantity' . $product->id }}" data-stocks="{{ $product->product ? $product->product->stocks_avaliable : '' }}">+</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="total">${{ $product->quantity ? ($product->product ? $product->quantity * $product->product->price : ' ') : ' ' }}</td>
                                                <td> <a data-product_id="{{ $product->id }}" href="javascript:void(0)" class="cartDelete delete"><i style="color: #E13F3F;" class="fa-regular fa-trash-can"></i></a></td>
                                            </tr>
                                        @empty
                                            <div class="empty-data">
                                                <img src="{{ asset('assets/images/no-product.svg') }}  " alt="" width="300">
                                                <p class="text-center mt-1">Did not found any part</p>
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            @else
                                <div class="empty-data">
                                    <img src="{{ asset('assets/images/no-product.svg') }}  " alt="" width="300">
                                    <p class="text-center mt-1">Did not found any part</p>
                                </div>
                            @endif

                        @else
                            <div class="empty-data">
                                <img src="{{ asset('assets/images/no-product.svg') }}  " alt="" width="300">
                                <p class="text-center mt-1">Did not found any  part</p>
                            </div>
                        @endif
                    </div>
                </div>
                @if($cart && $cart->cartProducts && count($cart->cartProducts)) 
                <div class="d-flex justify-content-end">
                    <a href="{{ $cart && $cart->cartProducts && count($cart->cartProducts) ? route(auth()->user()->getRoleNames()->first() . '.checkout.create') :'#'}}" class="btn secondary-btn view-btn md-btn @if($cart && $cart->cartProducts && count($cart->cartProducts)) @else disabled @endif">
                        Checkout
                    </a>
                </div>
                @endif
            </div>

        </div>
        {{-- <div class="col-xl-4 col-lg-12 col-md-12">
            <div class="cart-sidebar-box">
                <div class="cart-box-header">
                    <h3>Cart Totals</h3>
                </div> --}}
        {{-- <div class="cart-box-content">
                    <div class="cart-wrapper">
                        <p class="cart-txt">SubTotal</p>
                        <p class="price-txt">
                            {{ isset($cart) ? number_format($cart->amount, 2, '.', ',') : '' }}</p>
    </div>
    <div class="cart-wrapper">
        <p class="cart-txt">Shipping</p>
        <p class="price-txt">
            @php
            $shiping_value = 0;
            foreach ($shippingCharges as $charge) {
            if ($cart->amount >= $charge->range_from && $cart->amount <= $charge->range_to) {
                if ($charge->type == 'fixed') {
                $shiping_value = $charge->value;
                } else {
                $shiping_value = $cart->amount * ($charge->value / 100);
                }
                }
                }
                @endphp
                {{ number_format($shiping_value, 2, '.', ',') }}
        </p>
    </div>
    <div class="sub-total-wrapper">
        <h3>Payable Total</h3>
        <h3>{{ isset($cart->amount) ? number_format($cart->amount + $shiping_value, 2, '.', ',') : '' }}
        </h3>
    </div>
</div>

</div> --}}
{{-- <div class="cart-box-content">
            <div class="cart-wrapper">
                <p class="cart-txt">SubTotal</p>
                <p class="price-txt">
                    @if (isset($cart) && $cart->amount)
                    {{ number_format($cart->amount, 2, '.', ',') }}
@else
{{ '0.00' }}
@endif
</p>
</div>
<!-- <div class="cart-wrapper">
                <p class="cart-txt">Shipping</p>
                <p class="price-txt">
                    @php
                    $shiping_value = 0;
                    if (isset($cart) && $cart->amount) {
                    foreach ($shippingCharges as $charge) {
                    if (
                    $cart->amount >= $charge->range_from &&
                    $cart->amount <= $charge->range_to
                        ) {
                        if ($charge->type == 'fixed') {
                        $shiping_value = $charge->value;
                        } else {
                        $shiping_value = $cart->amount * ($charge->value / 100);
                        }
                        }
                        }
                        }
                        @endphp
                        {{ number_format($shiping_value, 2, '.', ',') }}
                </p>
            </div> -->
<div class="sub-total-wrapper">
    <h3>Payable Total</h3>
    <h3>
        @if (isset($cart) && $cart->amount)
        {{ number_format($cart->amount , 2, '.', ',') }}
        @else
        {{ '0.00' }}
        @endif
    </h3>
</div>
</div>
@isset($cart)
@if ($cart->cartProducts->isNotEmpty())
<div class="cart-checkout">
    <a href="{{ route(auth()->user()->getRoleNames()->first() . '.checkout.create') }}" class="btn secondary-btn view-btn " id="checkout-btn">
        Checkout
    </a>
</div>
@else
<div class="cart-checkout">
    <a href="#" class="btn secondary-btn view-btn">
        Checkout
    </a>
</div>
@endif
@endisset --}}

</div>

</div>