@extends('layouts.front')
@section('content')
    <section class="page-content-sec">
        <div class="container">
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
                                                    <td>{{ $cart->amount }} </td>
                                                    <td>
                                                        <div class="product-quantity-box">
                                                            <div class="quantity-btn quantity-brd">
                                                                <button class="minus">-</button>
                                                                <input type="text"
                                                                    placeholder="{{ $cart->cart_product->quantity }}"
                                                                    id="quantity">
                                                                <button class="plus">+</button>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>$700</td>
                                                    <td> <a
                                                            href="{{ route('dealer.cart.remove', ['cart_id' => $cart->id]) }}"><i
                                                                style="color: #E13F3F;"
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
                                    <p class="price-txt">$2800.00</p>
                                </div>
                                <div class="cart-wrapper">
                                    <p class="cart-txt">Shipping</p>
                                    <p class="price-txt">$50.00</p>
                                </div>
                                <div class="sub-total-wrapper">
                                    <h3>Payable Total</h3>
                                    <h3>$2850.00</h3>
                                </div>
                            </div>

                        </div>
                        <div class="cart-checkout">
                            <a href="#" class="btn secondary-btn view-btn">
                                Checkout
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Start -->
            <!-- End -->
    </section>
@endsection
@include('layouts.include.footer')
<script>
    $(document).ready(function() {

        $('#plus').click(function() {
            var quan = $('#quantity').attr('placeholder')
            console.log(quan, "quantity");
        });

    });
</script>
