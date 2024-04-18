@extends('layouts.dealer')
@section('title', 'plans')
@section('heading', 'Subscription Plans')

@section('content')

    <div class="plan-wrapper">
        <x-alert-component />

        <div class="row g-4 align-items-center">
            @forelse  ($plans as $plan)
                <div class="col-xl-4 col-lg-4 col-md-6 col-12">
                    <div class="cards" id="card{{ $plan->id }}">
                        <div class="card-details">
                            <span>{{ $plan->billing_cycle }}</span>
                            <h3>${{ $plan->price }}<span>/{{ $plan->billing_cycle }}</span></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi</p>
                            <ul class="card-list">
                                <li>
                                    <p>Lorem ipsum dolor sit</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit</p>
                                </li>
                                <li>
                                    <p>Lorem ipsum dolor sit</p>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <a href="javascript:void(0)" class="btn secondary-btn full-btn parchase"
                                data-plan-id="{{ jsencode_userdata($plan->id) }}"
                                data-plan-price="{{ $plan->price }}">Parchase</a>

                        </div>
                    </div>
                </div>
            @empty
                <div>No Plans</div>
            @endforelse
        </div>
    </div>

@endsection

<!-- Modal -->
<div class="modal fade" id="card-parchase-Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="payment-page">
                    <h3>Payment</h3>
                    <p>All transactions are secure and encrypted.</p>
                    <form id="card-details" action="{{ route('dealer.subscription.plan.purchase') }}"
                        enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="plan_id" value="">
                        <div class="card-detail-box">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">name</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control" id="card-holder-name"
                                                name="name" placeholder="Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Card Number</label>
                                        <div class="form-field" id="cardNumberElement">

                                            <label for="card-number" class="stripe-error-messages"></label>

                                        </div>
                                        <div class="is-invalid" id="cardNumberError"></div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Expiration date</label>
                                        <div class="form-field" id="cardExpiryElement">

                                            <label for="card-expiry" class="stripe-error-messages"></label>
                                            <input type="text" name="svev" class="form-control" id="">
                                        </div>
                                        <div class="is-invalid" id="cardExpiryError"></div>

                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">CVV</label>
                                        <div class="form-field" id="cardCVCElement">


                                        </div>
                                        <div class="is-invalid" id="cardCVVError"></div>

                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="form-checkbox">
                                        <input type="checkbox" class="custm-check" id="form-check">
                                        <label for="form-check">Use shipping address as billing address</label>
                                        <label for="card-cvc" class="stripe-error-messages"></label>

                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <button type="submit" id="payNow" class="btn secondary-btn full-btn pay-now">Pay Now
                        </button>
                        <div id="card-errors" role="alert" class="text-danger"></div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{ asset('assets/js/custom/card.js') }}"></script>
    <script>
        jQuery(document).ready(function() {

            jQuery('.parchase').on('click', function() {
                jQuery('#card-parchase-Modal').modal('show');
                var planprice = jQuery(this).attr('data-plan-price');
                var planid = jQuery(this).attr('data-plan-id');
                jQuery('.pay-now').text('Pay Now' + ' $' + planprice);
                jQuery(document).find('input[name="plan_id"]').val(planid);
            })
        });
    </script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}')
        const client_secret = "{{ $intent->client_secret }}"
        const elements = stripe.elements()


        var cardNumberElement = elements.create('cardNumber');
        cardNumberElement.mount('#cardNumberElement');
        var cardExpiryElement = elements.create('cardExpiry');
        cardExpiryElement.mount('#cardExpiryElement');
        var cardCvcElement = elements.create('cardCvc');
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


        const form = document.getElementById('card-details')
        const cardBtn = document.getElementById('payNow')
        const cardHolderName = document.getElementById('card-holder-name')

        form.addEventListener('submit', async (e) => {
            e.preventDefault()

            cardBtn.disabled = true
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
                let token = document.createElement('input')
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                form.submit();
            }
        })
    </script>
@endpush
