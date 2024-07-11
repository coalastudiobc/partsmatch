<div class="page-content-wrapper cart-page-wrapper">
    <div class="row g-3">
        <div class="col-xl-8 col-lg-12 col-md-12">
            <div class="cart-table-wrapper">
                <div class="db-table-box">
                    <div class="tb-table table-responsive">
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
                                @if (isset($cart->cartProducts))
                                    @forelse ($cart->cartProducts as $product)
                                        <tr>
                                            <td>
                                                <div class="cart-product-image">
                                                    <img src="{{ isset($product->product->productImage[0]) ? Storage::url($product->product->productImage[0]->file_url) : '' }}"
                                                        alt="">
                                                </div>
                                            </td>
                                            <td>{{ $product->product ? $product->product->name : '' }}</td>
                                            <td>{{ $product->product ? $product->product->price : '' }} </td>
                                            <td>
                                                <div class="product-quantity-box">
                                                    <div class="quantity-btn quantity-brd">
                                                        @if ($product->quantity != 1)
                                                            <a href="javascript:void(0)" class="minus cartupdate"
                                                                data-product_id="{{ $product->id }}"
                                                                data_quantity_id="{{ '#quantity' . $product->id }}"
                                                                data-stocks="{{ $product->product ? $product->product->stocks_avaliable : '' }}">-</a>
                                                        @endif
                                                        <input type="text" name="quantity" class="quantity"
                                                            id="{{ 'quantity' . $product->id }}"
                                                            value="{{ $product->quantity ?? '' }}"
                                                            data-product_id="{{ $product->id }}"
                                                            data_quantity_id="{{ '#quantity' . $product->id }}"
                                                            placeholder="">
                                                        <a href="javascript:void(0)" class="plus cartupdate"
                                                            data-product_id="{{ $product->id }}"
                                                            data_quantity_id="{{ '#quantity' . $product->id }}"
                                                            data-stocks="{{ $product->product ? $product->product->stocks_avaliable : '' }}">+</a>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- @dd($product->quantity, $product->product->price); --}}
                                            <td class="total">
                                                {{ $product->quantity ? ($product->product ? $product->quantity * $product->product->price : ' ') : ' ' }}
                                            </td>
                                            <td> <a data-product_id="{{ $product->id }}" href="javascript:void(0)"
                                                    class="cartDelete delete"><i style="color: #E13F3F;"
                                                        class="fa-regular fa-trash-can"></i></a></td>
                                        </tr>
                                    @empty
                                        <div class="empty-data">No product in the cart</div>
                                    @endforelse
                                @else
                                    <p class="empty-data">No product in the cart</p>
                                @endif
                                {{-- <tr>
                                            <td>
                                                <div class="cart-product-image">
                                                    <img src="./images/product4.png" alt="">
                                                </div>
                                            </td>
                                            <td>Car Engine</td>
                                            <td>$700</td>
                                            <td>
                                                <div class="product-quantity-box">
                                                    <div class="quantity-btn quantity-brd">
                                                        <a href="#">-</a>
                                                        <input type="text" placeholder="1">
                                                        <a href="#">+</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>$700</td>
                                            <td> <a href="#"><i style="color: #E13F3F;"
                                                        class="fa-regular fa-trash-can"></i></a></td>
                                        </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-xl-4 col-lg-12 col-md-12">
            <div class="cart-sidebar-box">
                <div class="cart-box-header">
                    <h3>Cart Totals</h3>
                </div>
                <div class="cart-box-content">
                    <div class="cart-wrapper">
                        <p class="cart-txt">SubTotal</p>
                        <p class="price-txt">
                            {{ isset($cart->amount) ? number_format($cart->amount, 2, '.', ',') : '' }}</p>
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

            </div>
            <div class="cart-checkout">
                <a href="{{ route('dealer.checkout.create') }}" class="btn secondary-btn view-btn">
                    Checkout
                </a>
            </div>

        </div>
    </div>
