@extends('layouts.dealer')
@section('title', 'Order Management')
@section('heading', 'Order Management')
@section('content')
    <div class="dashboard-right-box">
        <div class="shipper-page-main-outer">
            <div class="shipper-page-main">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="checkout-main-card cstm-card">
                            <div class="shipment-address-box">
                                <div class="shipment-address-header">
                                    <h3>Pick up Address</h3>
                                    {{-- <a href="#">Edit Resipient</a> --}}
                                </div>
                                <h4>{{ $pickupAddress->first_name . ' ' . $pickupAddress->last_name }}</h4>
                                <p>{{ $pickupAddress->address1 . ' ' . $pickupAddress->city . ',' . $pickupAddress->state . ',' . $pickupAddress->pin_code . ',' . $pickupAddress->country }}
                                </p>
                                <div class="shipment-address-mail-phone">
                                    <a href="#">cyhujequ@mailinator.com</a>
                                    <a href="#">{{ $pickupAddress->phone_number }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="checkout-main-card cstm-card">
                            <div class="shipment-id-box">
                                <div class="shipment-address-box">
                                    <div class="shipment-address-header">
                                        <h3>Shipment-id</h3>
                                        <p>{{ $response_in_array->object_id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="checkout-main-card cstm-card">
                            <div class="order-summary">
                                <h3>Payment</h3>
                                <p>All transactions are secure and encrypted.</p>
                                {{-- <form id="shippmentPaymentForm" action="{{ route('Dealer.order.payment') }}" method="POST"> --}}
                                @csrf
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Card Number</label>
                                                <div class="form-field" id="cardNumberElement">
                                                    <input type="text" class="form-control" placeholder="Card-number">
                                                    <label for="card-number" class="stripe-error-messages"></label>
                                                </div>
                                                <div class="is-invalid stripe-error" id="cardNumberError"></div>
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
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Card Security Code</label>
                                                <div class="form-field" id="cardCVCElement" class="form-control">
                                                    <input type="password" class="form-control" placeholder="****">
                                                </div>
                                                <div class="is-invalid stripe-error" id="cardCVVError"></div>
                                                <input type="hidden" name="stripeCustomer_id"
                                                    value="{{ $stripeCustomer->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Card Holder Name</label>
                                                <div class="form-field">
                                                    <input type="text" name="cardname" id="cardName"
                                                        class="form-control" placeholder="John Doe">
                                                    <label class="cardName-error" for="card-name" id="cardname"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="payNow" class="btn secondary-btn full-btn">Pay Now
                                    $2,390.00</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="checkout-main-card cstm-card shippment-rates-card">
                            <h3>Rates</h3>
                            <p>Transit times may be estimated.</p>
                            <div class="form-group">
                                <label for="">Shipment Date</label>
                                <div class="formfield">
                                    <input type="text" placeholder="07/23/2024" class="form-control">
                                </div>
                            </div>


                            <div class="shipper-rates">
                                <ul class="shipper-rates-list">
                                    <li>
                                        <a href="#" class="">
                                            <div class="shipper-rates-left">
                                                <div class="shipper-rates-img">
                                                    <!-- Add an image if needed -->
                                                </div>
                                                <h3>No Rates available right now.</h3>
                                            </div>
                                            <div class="shipper-rates-prize">
                                                <!-- You can add any message or leave empty -->
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="shipper-rates">
                                <h4>MORE RATES</h4>
                                <ul class="shipper-rates-list">
                                    @isset($response_in_array->rates_list)
                                        @forelse ($response_in_array->rates_list as $rates)
                                            <li>
                                                <a href="#" class="">
                                                    <div class="shipper-rates-left">
                                                        <div class="shipper-rates-img">
                                                            <!-- Add an image if needed -->
                                                        </div>
                                                        <h3>{{ $rates->servicelevel_token }}</h3>
                                                    </div>
                                                    <div class="shipper-rates-prize">
                                                        <h4>${{ $rates->amount }}</h4>
                                                        <p>{{ $rates->days }} days</p>
                                                    </div>
                                                </a>
                                            </li>
                                        @empty

                                            <div class="shipper-rates">
                                                <ul class="shipper-rates-list">
                                                    <li>
                                                        <a href="#" class="">
                                                            <div class="shipper-rates-left">
                                                                <div class="shipper-rates-img">
                                                                    <!-- Add an image if needed -->
                                                                </div>
                                                                <h3>No Rates available right now.</h3>
                                                            </div>
                                                            <div class="shipper-rates-prize">
                                                                <!-- You can add any message or leave empty -->
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endforelse
                                    @endisset
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}')
        const client_secret = "{{ $intent->client_secret }}"
        const cardButton = document.getElementById('payNow');
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


        const form = document.getElementById('shippmentPaymentForm')
        const cardBtn = document.getElementById('payNow')
        const cardHolderName = document.getElementById('cardName')
        const totalPayment = document.getElementById('total_payment').value;
        const shipmethodId = document.getElementById('ship_method').value;


        form.addEventListener('submit', async (e) => {
            e.preventDefault()
            if (!validateTitle()) {
                cardBtn.disabled = false;
                return; // Stop further processing if validation fails
            }
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
                cardBtn.disable = false
            } else {
                cardButton.disabled = true;
                cardButton.innerHTML =
                    '<div class="d-flex align-items-center"><span class="spinner-grow spinner-grow-sm mr-2" role="status" aria-hidden="true"></span><p class="mb-0">  Paying...</p></div>'
                jQuery('#cardError').removeClass('is-invalid');
                jQuery('#cardError').html('');
                stripeTokenHandler(setupIntent);
            }
        })

        function stripeTokenHandler(setupIntent) {
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
            let shippmentMethod = document.createElement('input')
            shippmentMethod.setAttribute('type', 'hidden')
            shippmentMethod.setAttribute('name', 'shipping_Method')
            shippmentMethod.setAttribute('value', shipmethodId)
            form.appendChild(shippmentMethod)
            form.submit();
            jQuery('.page-loader').removeClass('d-none'); //for loader
        }

        function validateTitle() {
            var form = $("#shippmentPaymentForm");
            form.validate({
                rules: {
                    cardname: {
                        required: true,
                        minlength: nameMinLength,
                        maxlength: nameMaxLength,
                        regex: nameRegex,
                    },
                },
                messages: {
                    cardname: {
                        required: `{{ __('customvalidation.payment.cardholdername.required') }}`,
                        regex: `{{ __('customvalidation.payment.cardholdername.regex') }}`,
                        minlength: `{{ __('customvalidation.payment.cardholdername.min') }}`,
                        maxlength: `{{ __('customvalidation.payment.cardholdername.max') }}`,
                    },
                },
                errorClass: "errors",
                success: function(label, element) {
                    $('#title').removeClass('errors');
                },
            });
            if (form.valid() === true) {
                console.log('hlo');
                return true;
            } else {
                return false;
            }
        }
    </script>
@endpush
