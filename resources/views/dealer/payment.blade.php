@extends('layouts.front')
@section('content')
<section class="page-content-sec section-padding">
    <div class="container">
        <div class="page-content-wrapper">
            <div class="row g-3">
                <div class="col-xl-8 col-lg-12 col-md-12 payment-page">
                    <div class="order-summary cstm-card payment-field-card">
                        <h3>Payment</h3>
                        <p>All transactions are secure and encrypted.</p>
                        <form id="paymentform" action="{{ route('order.payment') }}" method="POST">
                            @csrf
                            <div class="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Card Number<span class="required-field">*</span></label>
                                            <div class="form-field" id="cardNumberElement">
                                                <input type="text" class="form-control" placeholder="Card-number">
                                                <label for="card-number" class="stripe-error-messages"></label>
                                            </div>
                                            <div class="is-invalid stripe-error" id="cardNumberError"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Card Expiration Date<span class="required-field">*</span></label>
                                            <div class="form-field" id="cardExpiryElement">
                                                <input type="text" class="form-control" placeholder="MM / YY">
                                                <label for="card-expiry" class="stripe-error-messages"></label>
                                            </div>
                                            <div class="is-invalid stripe-error" id="cardExpiryError"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Card Security Code<span class="required-field">*</span></label>
                                            <div class="form-field" id="cardCVCElement" class="form-control">
                                                <input type="password" class="form-control" placeholder="****">
                                            </div>
                                            <div class="is-invalid stripe-error" id="cardCVVError"></div>
                                            <input type="hidden" name="stripeCustomer_id" value="{{ $stripeCustomer->id }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Card Holder Name<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <input type="text" name="cardname" id="cardName" class="form-control" placeholder="John Doe">
                                                <label class="cardName-error" for="card-name" id="cardname"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{ $grandTotal }}" id="total_payment">
                            <button type="submit" id="payNow" class="btn secondary-btn full-btn">Pay Now
                                ${{ isset($grandTotal) ? number_format($grandTotal, 2, '.', ',') : '' }}</button>
                        </form>
                    </div>

                </div>
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="order-summary cstm-card">
                        <h2>Order Summary</h2>
                        <div class="shipping-list">
                            <h3>Shipping Method</h3>
                            <input type="hidden" id="ship_method" name="shipping_Method" class="d-none" value="{{ $selectedShipping->id ?? '' }}">
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
                                            <img src="{{$products->productImage && count($products->productImage) ?  Storage::url($products->productImage[0]->file_url) : asset('assets/images/gear-logo.svg') }}" alt="">
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
@includeFirst(['validation'])
@endsection
@push('scripts')
{{-- purchase product --}}
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


    const form = document.getElementById('paymentform')
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
        var form = $("#paymentform");
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