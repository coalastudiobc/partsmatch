@extends('layouts.dealer')
@section('title', 'Order Management')
@section('heading', 'Order Management')
@section('content')
<div class="dashboard-right-box">
    <div class="">
        <div class="shipper-page-main">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="checkout-main-card cstm-card">
                        <div class="shipment-address-box">
                            <div class="shipment-address-header">
                                <h3>Pick up Address</h3>
                                {{-- <a href="#">Edit Resipient</a> --}}
                            </div>
                            <p>{{ $pickupAddress->first_name . ' ' . $pickupAddress->last_name }}</p>
                            <h4>{{ $pickupAddress->address1 . ' ' . $pickupAddress->city . ',' . $pickupAddress->state . ',' . $pickupAddress->pin_code . ',' . $pickupAddress->country }}
                            </h4>
                            <div class="shipment-address-mail-phone">
                                <a href="#">cyhujequ@mailinator.com</a>
                                <a href="#">{{ $pickupAddress->phone_number }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-main-card cstm-card">
                        <div class="shipment-address-box">
                            <div class="shipment-address-header">
                                <h3>Reciever Address</h3>
                                {{-- <a href="#">Edit Resipient</a> --}}
                            </div>
                            <p>{{ $reciever_address->name . ' ' . $reciever_address->last_name }}</p>
                            <h4>{{ $reciever_address->address1 . ' ' . $reciever_address->city . ',' . $reciever_address->state . ',' . $reciever_address->pin_code . ',' . $reciever_address->country }}
                            </h4>
                            <div class="shipment-address-mail-phone">
                                <a href="#">cyhujequ@mailinator.com</a>
                                <a href="#">{{ $reciever_address->phone_number }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-main-card cstm-card">
                        <div class="order-summary">
                            <h3>Payment</h3>
                            <p>All transactions are secure and encrypted.</p>
                            <form id="shippmentPaymentForm" action="{{ route('Dealer.order.shippment.payment') }}" method="POST">
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
                                                <input type="hidden" name="stripeCustomer_id" value="{{ $stripeCustomer->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Card Holder Name</label>
                                                <div class="form-field">
                                                    <input type="text" name="cardname" id="cardName" class="form-control" placeholder="John Doe">
                                                    <label class="cardName-error" for="card-name" id="cardname"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="payNow" class="btn secondary-btn full-btn">Pay
                                    Now</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="checkout-main-card cstm-card shippment-rates-card">
                        <div class="shipment-id-box">
                            <div class="shipment-address-box">
                                <div class="shipment-address-header">
                                    <div class="shipment-data-name">
                                        <h3 class="mb-2">Shipment-id</h3>
                                        <h3>Shipment Date</h3>
                                    </div>
                                    <div class="shipment-data-field">
                                        <!-- Shipment-id -->
                                        <p class="mb-2">{{ $response_in_array->object_id }}</p>
                                        <!-- Shipment Date -->
                                        <p>07/23/2024</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="shipper-rates">
                            <h4>RATES</h4>
                            <ul class="shipper-rates-list">
                                @isset($response_in_array->rates_list)
                                @forelse ($response_in_array->rates_list as $rates)
                                <li>
                                    <a href="#" class="shippment-rate ">
                                        <div class="shipper-rates-left">
                                            <div class="shipper-rates-img">
                                                <!-- Add an image if needed -->
                                                <img src="{{ $rates->provider_image_75 }}" alt="">
                                            </div>
                                            <h3>{{ $rates->servicelevel_token }}</h3>
                                        </div>
                                        <div class="shipper-rates-prize">
                                            <h4 class="rate_amount" data-rateId={{ $rates->object_id }} data-amount={{ $rates->amount }}>
                                                ${{ $rates->amount }}</h4>
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
<script>
    var amount = 0;
    jQuery(document).ready(function(e) {
        var selected_rate_id = 0;
        jQuery('.shippment-rate').on('click', function(event) {
            console.log('jshdfjk');
            jQuery('.shippment-rate').removeClass('active'); // Remove 'active' from all
            jQuery(this).addClass('active');
            if (jQuery(this).hasClass('active')) {
                amount = parseFloat(jQuery(this).find('.shipper-rates-prize .rate_amount').attr('data-amount'));
                window.selected_rate_id = jQuery(this).find('.shipper-rates-prize .rate_amount').attr(
                    'data-rateId');
                jQuery('#payNow').text('Pay Now ' + amount);
                console.log('Amount of active element:', amount, selected_rate_id);
            }
            // $(this).toggleClass('active');
        });
    });
</script>
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
        paymentElement.setAttribute('name', 'rate_id')
        paymentElement.setAttribute('value', selected_rate_id)
        form.appendChild(paymentElement)
        let amount1 = document.createElement('input')
        amount1.setAttribute('type', 'hidden')
        amount1.setAttribute('name', 'amount')
        amount1.setAttribute('value', window.amount)
        form.appendChild(amount1)
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
            if ($('.shippment-rate.active').length === 0) {
                toastr.error("Please select at least one shipping rate.");
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
</script>
@endpush