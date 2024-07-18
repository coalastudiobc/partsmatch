@extends('layouts.front')
@section('content')
    <section class="page-content-sec">
        <div class="container">
            <div class="page-content-wrapper">
                <div class="row g-3">
                    <div class="col-xl-7 col-lg-12 col-md-12 payment-page">
                        <h3>Payment</h3>
                        <p>All transactions are secure and encrypted.</p>
                        <form id="paymentform" action="{{ route('order.payment') }}" method="POST">
                            @csrf
                            <div class="card-detail-box">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Card Number</label>
                                            <div class="form-field" id="cardNumberElement">
                                                <input type="text" class="form-control" placeholder="Card-number">
                                                <label for="card-number" class="stripe-error-messages"></label>

                                            </div>
                                            <div class="is-invalid stripe-error" id="cardNumberError"></div>
                                            {{-- <div class="form-field">
                        <input type="text" class="form-control" placeholder="Card-number">

                    </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Card Expiration Date</label>
                                            <div class="form-field" id="cardExpiryElement">
                                                <input type="text" class="form-control" placeholder="MM / YY">
                                                <label for="card-expiry" class="stripe-error-messages"></label>
                                            </div>
                                            <div class="is-invalid stripe-error" id="cardExpiryError"></div>

                                            {{-- <div class="form-field">
                        <input type="text" class="form-control" placeholder="MM / YY">

                    </div> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Card Security Code</label>
                                            <div class="form-field" id="cardCVCElement" class="form-control">
                                                <input type="password" class="form-control" placeholder="****">
                                            </div>
                                            <div class="is-invalid stripe-error" id="cardCVVError"></div>
                                            {{-- <div class="form-field">
                        <input type="password" class="form-control" placeholder="****">

                    </div> --}}
                                            <input type="hidden" name="stripeCustomer_id"
                                                value="{{ $stripeCustomer->id }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Name On Card</label>
                                            <div class="form-field">
                                                <input type="text" name="name" id="card-holder-name"
                                                    class="form-control" placeholder="John Doe">

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
                            <input type="hidden" value="{{ $grandTotal }}" id="total_payment">
                            <button type="submit" id="payNow" class="btn secondary-btn full-btn">Pay Now
                                {{ isset($grandTotal) ? number_format($grandTotal, 2, '.', ',') : '' }}</button>

                    </div>
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        <div class="order-summary cstm-card">
                            <h2>Order Summary</h2>
                            <div class="shipping-list">
                                <h3>Shipping Method</h3>
                                <input type="hidden" id="ship_method" name="shipping_Method" class="d-none"
                                    value="{{ $selectedShipping->id ?? '' }}">
                                <ul class="shipping_carts">
                                    <li>
                                        <label for="ship_method">
                                            <div class="shipping-details">
                                                <h3>{{ $selectedShipping->name ?? 'Free Shipping' }}</h3>
                                            </div>
                                            <p>${{ $selectedShipping->value ?? '0.00' }}</p>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            <ul class="order-summary-list">
                                <h3>Products</h3>
                                @foreach ($allProductsOfCart as $products)
                                    <li>
                                        <div class="summary-list-box">
                                            <div class="summary-img-txt">
                                                <div class="summary-img-box">
                                                    <img src="{{ asset('storage/' . $products->product->productImage[0]->file_url) }}"
                                                        alt="">
                                                    <div class="order-sum-number">
                                                        <span>{{ $products->quantity }}</span>
                                                    </div>
                                                </div>
                                                <div class="summary-txt-box">
                                                    <h3>{{ $products->product->name ?? 'Product Name' }}</h3>
                                                    <p>{{ $products->product->category->name ?? 'Product Category Name' }}
                                                    </p>
                                                </div>
                                            </div>
                                            <p>${{ isset($products->product) ? number_format($products->product->price * $products->quantity, 2, '.', ',') : '' }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="order-summary cstm-card">
                            <h2></h2>
                            <ul class="order-summary-list">
                                <li>
                                    <div class="summary-list-box">
                                        <div class="summary-img-txt">
                                            <div class="summary-txt-box">
                                                <h3>Grand Total</h3>
                                            </div>
                                        </div>
                                        <p>
                                            ${{ isset($grandTotal) ? number_format($grandTotal, 2, '.', ',') : 'grand Total amount' }}
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{-- purchase product --}}
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}')
        const client_secret = "{{ $intent->client_secret }}"
        const elements = stripe.elements()

        var style = {
            base: {
                iconColor: '#666EE8',
                color: '#31325F',
                lineHeight: '40px',
                fontWeight: 300,
                fontFamily: 'Helvetica Neue',
                fontSize: '15px',
                '::placeholder': {
                    color: '#CFD7E0',
                },
                iconStyle: 'solid',
            },
            invalid: {
                color: "#fa755a",
                fontSize: "20px",
            },
        };

        // Customize Stripe Card
        var cardNumberElement = elements.create('cardNumber', {
            style: style,
            showIcon: true,
            placeholder: '1234 1234 1234 1234',
        });
        cardNumberElement.mount('#cardNumberElement');


        var cardExpiryElement = elements.create('cardExpiry', {
            style: style,

        });
        cardExpiryElement.mount('#cardExpiryElement');

        var cardCvcElement = elements.create('cardCvc', {
            style: style,
            showIcon: true,
            placeholder: '123',
        });
        cardCvcElement.mount('#cardCVCElement');

        // var cardNumberElement = elements.create('cardNumber');
        // cardNumberElement.mount('#cardNumberElement');
        // var cardExpiryElement = elements.create('cardExpiry');
        // cardExpiryElement.mount('#cardExpiryElement');
        // var cardCvcElement = elements.create('cardCvc');
        // cardCvcElement.mount('#cardCVCElement');


        cardNumberElement.on('change', function(event) {
            if (event.error) {
                jQuery('#cardNumberError').text(event.error.message);
            } else {
                jQuery('#cardNumberError').text('');
            }
        });
        cardExpiryElement.on('change', function(event) {
            if (event.error) {
                jQuery('#cardExpiryError').text(event.error.message);
            } else {
                jQuery('#cardExpiryError').text('');
            }
        });
        cardCvcElement.on('change', function(event) {
            if (event.error) {
                jQuery('#cardCVVError').text(event.error.message);
            } else {
                jQuery('#cardCVVError').text('');
            }
        });


        const form = document.getElementById('paymentform')
        const cardBtn = document.getElementById('payNow')
        const cardHolderName = document.getElementById('card-holder-name')
        const totalPayment = document.getElementById('total_payment').value;


        form.addEventListener('submit', async (e) => {
            e.preventDefault()
            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                client_secret, {
                    payment_method: {
                        card: cardNumberElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            )
            if (error) {
                // cardBtn.disable = false
            } else {
                let token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                let paymentElement = document.createElement('input')
                paymentElement.setAttribute('type', 'hidden')
                paymentElement.setAttribute('name', 'total_payment')
                paymentElement.setAttribute('value', totalPayment)
                form.appendChild(paymentElement)
                form.submit();
            }
        })
    </script>
@endpush
