@extends('layouts.front')
@section('content')
    <section class="page-content-sec section-padding">
        <div class="container">
            <div class="page-content-wrapper">
                <div class="row g-3">
                    <div class="col-xl-7 col-lg-12 col-md-12">
                        <div class="checkout-main-card cstm-card">
                            <x-alert-component />
                            <h2>Delivery Address</h2>
                            <div class="delivery-form">
                                <form id="product-card-details" action="{{ route('Dealer.address.to') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Country</label>
                                                {{-- <div class="form-field">
                                                    <!-- <input type="text" class="form-control" placeholder="Select industry"> -->
                                                    <select name="cars" id="industury" class="form-control">
                                                        <option value="volvo">Volvo</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select>
                                                </div> --}}


                                                <div class="custm-dropdown">
                                                    <div class="dropdown">
                                                        <div class="dropdown-toggle " type="button"
                                                            id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <div id="selectedItem">
                                                                {{ $country->name ?? 'Select' }}

                                                            </div>
                                                            <span class="custm-drop-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="23" viewBox="0 0 24 23" fill="none">
                                                                    <path d="M19 9.00006L14 14.0001L9 9.00006"
                                                                        stroke="#151515" stroke-width="1.8"
                                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <ul class="dropdown-menu outer-box" id="country"
                                                            aria-labelledby="dropdownMenuButton1">
                                                            @foreach ($countries as $country)
                                                                <li><a class="dropdown-item custom_dropdown_item"
                                                                        data-value="{{ $country->id }}"
                                                                        data-iso_code="{{ $country->iso_code }}"
                                                                        data-text="{{ $country->name }}"
                                                                        href="javascript:void(0)">{{ $country->name }}</a>
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="country" value="{{ $country->iso_code ?? '' }}"
                                                    class="@error('country') is-invalid @enderror">
                                                @error('country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Phone Number</label>
                                                <input type="number" name="phone_number"
                                                    value="{{ old('number', $deliveryAddress->phone_number ?? '') }}"
                                                    class="form-control @error('phonenumber') is-invalid @enderror">
                                                @error('phonenumber')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Address Type</label>
                                                <div class="add-type-main">
                                                    <label for="s-option">
                                                        <p>Home</p>
                                                        <input type="radio" name="addressType" id="s-option"
                                                            style="display: none" value="Home"
                                                            {{ $deliveryAddress ? ($deliveryAddress->address_type == 'Home' ? 'checked' : '') : '' }}>
                                                    </label>
                                                    <label for="v-option">
                                                        <p>Office</p>
                                                        <input type="radio" name="addressType" id="v-option"
                                                            value="Office" style="display: none"
                                                            {{ $deliveryAddress ? ($deliveryAddress->address_type == 'Office' ? 'checked' : '') : '' }}>
                                                    </label>
                                                    {{-- <div style="display: inline-block;">
                                                        <input type="radio" id="s-option" name="addressType" value="Office">
                                                        <label for="s-option" style="margin-left: 5px;">Office</label>
                                                        <div class="check" style="display: inline-block;">
                                                            <div class="inside"></div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>


                                        {{-- <input type="hidden" name="stripeCustomer_id" value="{{ $stripeCustomer->id }}"> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <div class="form-field">
                                                    <input type="text"
                                                        class="form-control @error('first_name') is-invalid @enderror"
                                                        name="first_name"
                                                        value="{{ old('first_name', $deliveryAddress->first_name ?? '') }}"
                                                        placeholder="First Name">
                                                    @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <div class="form-field">
                                                    <input type="text"
                                                        class="form-control @error('last_name') is-invalid @enderror"
                                                        name="last_name"
                                                        value="{{ old('last_name', $deliveryAddress->last_name ?? '') }}"
                                                        placeholder="Last Name">
                                                    @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Address 1</label>
                                                <div class="form-field">
                                                    <input type="text"
                                                        class="form-control @error('street1') is-invalid @enderror"
                                                        name="street1" value="{{ $deliveryAddress->address1 ?? '' }}"
                                                        placeholder="Address">
                                                    @error('street1')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="add-adress">
                                                <a href="javascript:void(0)">+ Add Apartment , Suite, etc.</a>
                                            </div> --}}
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Address 2</label>
                                                <div class="form-field">
                                                    <input type="text"
                                                        class="form-control @error('street2') is-invalid @enderror"
                                                        name="street2" value="{{ $deliveryAddress->address2 ?? '' }}"
                                                        placeholder="Address">
                                                    @error('street2')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">City</label>
                                                <div class="form-field">
                                                    <input type="text" class="form-control" placeholder="City">

                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">State</label>
                                                <div class="form-field">
                                                    <!-- <input type="text" class="form-control" placeholder="Select industry"> -->
                                                    {{-- <select name="cars" id="industury" class="form-control">
                                                        <option value="volvo">Volvo</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select> --}}

                                                    <div class="custm-dropdown">
                                                        <div class="dropdown">
                                                            <div class="dropdown-toggle " type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <div id="selectedState">
                                                                    {{ $state->name ?? 'select' }}

                                                                </div>
                                                                <span class="custm-drop-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="23" viewBox="0 0 24 23"
                                                                        fill="none">
                                                                        <path d="M19 9.00006L14 14.0001L9 9.00006"
                                                                            stroke="#151515" stroke-width="1.8"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <ul class="dropdown-menu outer-box state"
                                                                aria-labelledby="dropdownMenuButton1">
                                                                {{-- @foreach ($countries as $country)
                                                                    <li><a class="dropdown-item custom_dropdown_item"
                                                                            data-value="{{ $country->id }}"
                                                                            data-text="{{ $country->name }}"
                                                                            href="javascript:void(0)">{{ $country->name }}</a>
                                                                    </li>
                                                                @endforeach --}}

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="state" value="{{ $state->id ?? '' }}"
                                                        class="@error('state') is-invalid @enderror">
                                                    @error('state')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">City</label>
                                                <div class="form-field">
                                                    <!-- <input type="text" class="form-control" placeholder="Select industry"> -->
                                                    {{-- <select name="cars" id="industury" class="form-control">
                                                        <option value="volvo">Volvo</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                    </select> --}}

                                                    <div class="custm-dropdown">
                                                        <div class="dropdown">
                                                            <div class="dropdown-toggle " type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <div id="selectedCity">
                                                                    {{ $city->name ?? 'Select' }}

                                                                </div>
                                                                <span class="custm-drop-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="23" viewBox="0 0 24 23"
                                                                        fill="none">
                                                                        <path d="M19 9.00006L14 14.0001L9 9.00006"
                                                                            stroke="#151515" stroke-width="1.8"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <ul class="dropdown-menu outer-box city"
                                                                aria-labelledby="dropdownMenuButton1">
                                                                {{-- @foreach ($countries as $country)
                                                                    <li><a class="dropdown-item custom_dropdown_item"
                                                                            data-value="{{ $country->id }}"
                                                                            data-text="{{ $country->name }}"
                                                                            href="javascript:void(0)">{{ $country->name }}</a>
                                                                    </li>
                                                                @endforeach --}}

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="city" value="{{ $city->id ?? '' }}"
                                                        class="@error('city') is-invalid @enderror">
                                                    @error('city')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Pin code</label>
                                                <div class="form-field">
                                                    <input type="text" name="pin_code"
                                                        class="form-control @error('pin_code') is-invalid @enderror"
                                                        value="{{ DelveryAddress()->pin_code ?? '' }}"
                                                        placeholder="PIN code">
                                                    @error('pin_code')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn primary-btn full-btn">Submit</button>
                                        </div>
                                        {{-- <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Shipping method</label>
                                                <div class="form-field">
                                                    <input type="text" style="background-color: #F6F6F6; border: 0;"
                                                        class="form-control"
                                                        placeholder="Enter your shipping address to view available shipping methods.">

                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        <div class="order-summary cstm-card">
                            <h2>Shippings</h2>

                            <ul class="order-summary-list">
                                @if ($TotalShippings)
                                    @foreach ($TotalShippings as $shipping)
                                        <li>
                                            <div class="summary-list-box">
                                                <div class="summary-img-txt">
                                                    <div class="summary-img-box">
                                                        <img src="{{ $shipping ?? asset('assets/images/user.png') }}"
                                                            alt="Provider Image">
                                                        <div class="order-sum-number">
                                                            <input type="radio" name="shipmentRates[]"
                                                                value="{{ $shipping->value }}">
                                                        </div>
                                                    </div>
                                                    <div class="summary-txt-box">
                                                        <h3>{{ $shipping->name }}</h3>
                                                        <p>5</p>
                                                    </div>
                                                </div>
                                                <p>${{ $shipping->value }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                            <h2>Products</h2>
                            <ul class="order-summary-list">
                                @foreach ($allProductsOfCart as $products)
                                    <li>
                                        <div class="summary-list-box">
                                            <div class="summary-img-txt">
                                                <div class="summary-img-box">
                                                    <img src="{{ asset('storage/' . $products->product->productImage[0]->file_url) }}"
                                                        alt="">
                                                    {{-- <div class="order-sum-number">
                                                    <span>2</span>
                                                </div> --}}

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
                                        <p>$ {{ isset($products->product) ? number_format($carts[0]->amount, 2, '.', ',') : 'grand Total amount' }}
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
@include('layouts.include.footer')
@push('scripts')
    @includeFirst(['validation'])
    @includeFirst(['validation.dealer.js_checkout'])
    <script>
        jQuery(document).ready(function() {
            jQuery('.custom_dropdown_item').on('click', function() {
                var selectitem = jQuery(this).attr('data-iso_code')
                var selecttext = jQuery(this).attr('data-text')
                jQuery('#selectedItem').text(selecttext)
                jQuery(document).find('input[name="country"]').val(selectitem);

            })
        });

        jQuery(document).ready(function() {


            jQuery('.custom_dropdown_item').on('click', function() {
                var countryId = jQuery(this).attr('data-value')
                // var selecttext = jQuery(this).attr('data-text')

                // var countryId = selectitem
                let url = APP_URL + '/dealer/state/' + countryId;
                if (jQuery.isNumeric(countryId) && countryId > 0) {
                    const result = ajaxCall(url, 'get');
                    result.then(handleCountryData).catch(handleCountryError)
                }
            })
        })

        function handleCountryData(response) {
            let options = '<li> <a href="javascript:void(0)"> Select < /a></li>';
            jQuery('#state').html(options);
            jQuery('.state').empty();
            jQuery('#city').html('<option value="">Select City</option>');
            response.data.forEach(state => {
                // options += '<option value="' + state.id + '">' + state.name + '</option>';
                $('.state').append(`<li><a class="dropdown-item state_dropdown_item select_state"
                                                                            data-value="${state.id}"
                                                                            data-text="${state.name}"
                                                                            data-name="${state.name}"
                                                                            href="javascript:void(0)">${state.name}</a>
                                                                    </li>`)
            });
            jQuery('#state').html(options);
        }

        function handleCountryError(error) {
            console.log('error', error)
        }

        // jQuery(document).ready(function() {
        jQuery(document).on('click', '.select_state', function() {
            // alert('lund');
            var selectitem = jQuery(this).attr('data-name')
            var selecttext = jQuery(this).attr('data-text')
            jQuery('.city').empty();
            console.log('selecttext', selectitem, selecttext)
            jQuery('#selectedState').text(selecttext)
            jQuery(document).find('input[name="state"]').val(selectitem);
            jQuery('#state-error').text('');

        })
        // });

        // jQuery(document).ready(function() {
        jQuery(document).on('click', '.state_dropdown_item', function() {
            // alert('Please select');
            var stateId = jQuery(this).attr('data-value')
            var selecttext = jQuery(this).attr('data-text')
            let url = APP_URL + '/dealer/cities/' + stateId;
            if (jQuery.isNumeric(stateId) && stateId > 0) {
                const result = ajaxCall(url, 'get');
                result.then(handleCountryData).catch(handleCountryError)
            }


            function handleCountryData(response) {
                let options = '<li> <a href="javascript:void(0)"> Select < /a></li>';
                // jQuery('#state').html(options);
                jQuery('#city').html(options);
                response.data.forEach(city => {
                    // options += '<option value="' + state.id + '">' + state.name + '</option>';
                    $('.city').append(`<li><a class="dropdown-item city_dropdown_item select_city"
                                                                        data-value="${city.id}"
                                                                        data-text="${city.name}"
                                                                        data-name="${city.name}"
                                                                        href="javascript:void(0)">${city.name}</a>
                                                                </li>`)
                });
                jQuery('#city').html(options);
            }
        })

        jQuery(document).on('click', '.select_city', function() {
            // alert('lund');
            var selectitem = jQuery(this).attr('data-name')
            var selecttext = jQuery(this).attr('data-text')
            console.log('selecttext', selectitem, selecttext)
            jQuery('#selectedCity').text(selecttext)
            jQuery(document).find('input[name="city"]').val(selectitem);
            jQuery('#city-error').text('');


        })
        // })
        // })
    </script>

    {{-- purchase product --}}
    <script src="https://js.stripe.com/v3/"></script>
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


        const form = document.getElementById('product-card-details')
        const cardBtn = document.getElementById('payNow')
        const cardHolderName = document.getElementById('card-holder-name')

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
                form.submit();
            }
        })
    </script>
@endpush
