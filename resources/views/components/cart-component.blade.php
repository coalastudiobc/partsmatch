<div class="page-content-wrapper">
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
                                @foreach ($carts as $cart)
                                    {{-- @dd($cart) --}}
                                    <tr>
                                        <td>
                                            <div class="cart-product-image">
                                                <img src="{{ Storage::url($cart->cart_product->product->productImage[0]->file_url) }}"
                                                    alt="">
                                            </div>
                                        </td>
                                        <td>{{ $cart->cart_product->product->name }}</td>
                                        <td>{{ $cart->cart_product->product->price }} </td>
                                        <td>
                                            <div class="product-quantity-box">
                                                <div class="quantity-btn quantity-brd">
                                                    <a href="javascript:void(0)" class="minus cartupdateminus"
                                                        cartid="{{ $cart->id }}"
                                                        product-id="{{ $cart->cart_product->product->id }}">-</a>
                                                    <input type="text" name="quantity" class="quantity"
                                                        value="{{ $cart->cart_product->quantity }}" placeholder="">
                                                    <a href="javascript:void(0)" class="plus cartupdateplus"
                                                        cartid="{{ $cart->id }}"
                                                        product-id="{{ $cart->cart_product->product->id }}"
                                                        productQuantity="{{ $cart->cart_product->product->stocks_avaliable }}">+</a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="total">{{ $cart->amount }}
                                        </td>
                                        <td> <a cart_id="{{ $cart->id }}" href="javascript:void(0)"
                                                class="cartDelete"><i style="color: #E13F3F;"
                                                    class="fa-regular fa-trash-can"></i></a></td>
                                    </tr>
                                @endforeach
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
                        <p class="price-txt">{{ number_format($totalamount, 2, '.', ',') }}</p>
                    </div>
                    <div class="cart-wrapper">
                        <p class="cart-txt">Shipping</p>
                        <p class="price-txt">{{ number_format($shippingCharge->value, 2, '.', ',') }}</p>
                    </div>
                    <div class="sub-total-wrapper">
                        <h3>Payable Total</h3>
                        <h3>{{ number_format($totalamount + $shippingCharge->value, 2, '.', ',') }}</h3>
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
