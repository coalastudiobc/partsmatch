@extends('layouts.front')
@section('content')
    <section class="page-content-sec">
        <div class="container">
            <div class="page-content-wrapper">
                <div class="row g-3">
                    <div class="col-xl-7 col-lg-12 col-md-12 payment-page">
                        <h3>Payment</h3>
                        <p>All transactions are secure and encrypted.</p>
                        {{-- <form action=""> --}}
                        {{-- <div class="card-selector">
            <div class="type-accounts-radio">
                <label class="radio-button-container">Credit card
                    <input type="radio" name="radio">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div> --}}
                        <div class="card-detail-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Card Number</label>
                                        <div class="form-field" id="cardNumberElement">
                                            <input type="text" class="form-control" placeholder="Card-number">
                                            <label for="card-number" class="stripe-error-messages"></label>

                                        </div>
                                        <div class="is-invalid" id="cardNumberError"></div>
                                        {{-- <div class="form-field">
                        <input type="text" class="form-control" placeholder="Card-number">

                    </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Expiration date</label>
                                        <div class="form-field" id="cardExpiryElement">
                                            <input type="text" class="form-control" placeholder="MM / YY">
                                            <label for="card-expiry" class="stripe-error-messages"></label>
                                        </div>
                                        <div class="is-invalid" id="cardExpiryError"></div>

                                        {{-- <div class="form-field">
                        <input type="text" class="form-control" placeholder="MM / YY">

                    </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Security Code</label>
                                        <div class="form-field" id="cardCVCElement">

                                            <input type="password" class="form-control" placeholder="****">

                                        </div>
                                        <div class="is-invalid" id="cardCVVError"></div>
                                        {{-- <div class="form-field">
                        <input type="password" class="form-control" placeholder="****">

                    </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Name On Card</label>
                                        <div class="form-field">
                                            <input type="text" name="name" id="card-holder-name" class="form-control"
                                                placeholder="John Doe">

                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                    <div class="form-checkbox">
                        <input type="checkbox" class="custm-check" id="form-check">
                        <label for="form-check">Use shipping address as billing address</label>
                    </div>
                </div> --}}
                            </div>
                        </div>

                        {{-- <input type="hidden" name="total_amount" value="{{ $total_amount + $shippingCharge->value }}"> --}}
                        <button type="submit" class="btn secondary-btn full-btn">Pay Now
                            {{ isset($total_amount) ? number_format($total_amount + $totalShipping, 2, '.', ',') : '' }}</button>
                        </form>
                    </div>
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        @foreach ($products as $shippingIds => $productList)
                            {{-- Display products --}}
                            <div class="order-summary cstm-card">
                                <h2>Products</h2>
                                <ul class="order-summary-list">
                                    @php
                                        $lastProductId = null;
                                        $count = 0;
                                    @endphp

                                    @foreach ($productList as $index => $product)
                                        {{-- Check if current product ID is different from the previous one --}}
                                        @if ($product->id !== $lastProductId)
                                            {{-- Display previous product if it exists --}}
                                            @if ($index > 0)
                                                <li>
                                                    <div class="summary-list-box">
                                                        <div class="summary-img-txt">
                                                            <div class="summary-img-box">
                                                                <img src="{{ asset('storage/' . $productList[$index - 1]->productImage[0]->file_url) }}"
                                                                    alt="">
                                                                {{-- Display count only if there are more than one product --}}
                                                                @if ($count > 1)
                                                                    <div class="order-sum-number">
                                                                        <span>{{ $count }}</span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="summary-txt-box">
                                                                <h3>{{ $productList[$index - 1]->name ?? 'Product Name' }}
                                                                </h3>
                                                                <p>{{ $productList[$index - 1]->category->name ?? 'Product Category Name' }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <p>${{ isset($productList[$index - 1]->price) ? number_format($productList[$index - 1]->price, 2, '.', ',') : '' }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif

                                            {{-- Reset count for new product ID --}}
                                            @php
                                                $count = 1;
                                            @endphp
                                        @else
                                            {{-- Increment count for consecutive products with the same ID --}}
                                            @php
                                                $count++;
                                            @endphp
                                        @endif

                                        {{-- Update last product ID --}}
                                        @php
                                            $lastProductId = $product->id;
                                        @endphp

                                        {{-- For the last product in the list --}}
                                        @if ($index === count($productList) - 1)
                                            <li>
                                                <div class="summary-list-box">
                                                    <div class="summary-img-txt">
                                                        <div class="summary-img-box">
                                                            <img src="{{ asset('storage/' . $product->productImage[0]->file_url) }}"
                                                                alt="">
                                                            {{-- Display count only if there are more than one product --}}
                                                            @if ($count > 1)
                                                                <div class="order-sum-number">
                                                                    <span>{{ $count }}</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="summary-txt-box">
                                                            <h3>{{ $product->name ?? 'Product Name' }}</h3>
                                                            <p>{{ $product->category->name ?? 'Product Category Name' }}</p>
                                                        </div>
                                                    </div>
                                                    <p>${{ isset($product->price) ? number_format($product->price, 2, '.', ',') : '' }}
                                                    </p>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach

                                </ul>
                            </div>

                            {{-- Display Shipping details for this group of products --}}
                            @if (isset($selectedRateAmounts[$shippingIds]))
                                <div class="order-summary cstm-card">
                                    <h2>Shipping</h2>
                                    <ul class="order-summary-list">
                                        <li>
                                            <div class="summary-list-box">
                                                <div class="summary-img-txt">
                                                    <div class="summary-img-box">
                                                        <img src="{{ $selectedRateAmounts[$shippingIds]->provider_image_75 }}"
                                                            alt="shipping provider logo image">
                                                    </div>
                                                    <div class="summary-txt-box">
                                                        <h3>{{ $selectedRateAmounts[$shippingIds]->provider ?? 'Shipping Provider Name' }}
                                                        </h3>
                                                        <p>Duration:
                                                            {{ $selectedRateAmounts[$shippingIds]->days ?? 'Shipping Duration' }}
                                                            days</p>
                                                    </div>
                                                </div>
                                                <p>${{ isset($selectedRateAmounts[$shippingIds]) ? number_format($selectedRateAmounts[$shippingIds]->amount, 2, '.', ',') : '' }}
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endforeach


                        <div class="order-summary cstm-card">
                            <h2>Order Summary</h2>
                            <ul class="order-summary-list">
                                <li>
                                    <div class="summary-list-box">
                                        <div class="summary-img-txt">
                                            <div class="summary-img-box">
                                                <img src="{{ asset('assets/images/part-img.png') }}" alt="">
                                                {{-- <div class="order-sum-number">
                                        <span>2</span>
                                    </div> --}}
                                            </div>
                                            <div class="summary-txt-box">
                                                <h3>Grand Total</h3>
                                            </div>
                                        </div>
                                        {{-- <p>$ {{ isset($products->product) ? number_format($carts[0]->amount, 2, '.', ',') : 'grand Total amount' }} --}}
                                        <p>$ {{ isset($total_amount) ? number_format($total_amount + $totalShipping, 2, '.', ',') : 'grand Total amount' }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
