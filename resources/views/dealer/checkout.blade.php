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
                                                <label for="">Street No. & Name</label>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Country</label>
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





                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">State</label>
                                                <div class="form-field">
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
                                        {{-- <div class="col-md-12">
                                            <button type="submit" class="btn primary-btn full-btn">Submit</button>
                                        </div> --}}
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

                            </div>

                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        <div class="order-summary cstm-card">
                            <h2>Order Summary</h2>
                            <div class="shipping-list">
                                <input type="hidden" id="selected_shipping" name="shipping_Method" value="">
                                <h3>Shipping</h3>
                                <ul class="shipping_carts">
                                    <p>Please select country first. It vary country to country</p>
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
                                                    <!-- <p>{{ $products->product->category->name ?? 'Product Category Name' }} -->
                                                    </p>
                                                </div>
                                            </div>

                                            <p>${{ isset($products->product) ? number_format($products->product->price * $products->quantity, 2, '.', ',') : '' }}
                                            </p>
                                        </div>
                                    </li>
                                @endforeach


                            </ul>
                            <ul class="order-total-list">
                                <li>
                                    <div class="summary-list-box">
                                        <div class="summary-img-txt">
                                            <div class="summary-txt-box">
                                                <h3>Total</h3>
                                            </div>
                                        </div>
                                        <p class="total_charge">
                                            ${{ isset($products->product) ? number_format($carts[0]->amount, 2, '.', ',') : 'Total amount' }}
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="summary-list-box">
                                        <div class="summary-img-txt">
                                            <div class="summary-txt-box">
                                                <h3>Shipping Charge</h3>
                                            </div>
                                        </div>
                                        <p class="shipping_charge_price">$</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="summary-list-box">
                                        <div class="summary-img-txt">
                                            <div class="summary-txt-box">
                                                <h3>Grand Total</h3>
                                            </div>
                                        </div>
                                        <p class="grandTotal"
                                            data-amount="{{ isset($products->product) ? number_format($carts[0]->amount, 2, '.', ',') : 'grand Total amount' }}">
                                            $
                                            {{ isset($products->product) ? number_format($carts[0]->amount, 2, '.', ',') : 'grand Total amount' }}
                                        </p>
                                        <input type="hidden" id="grandTotal" name="grandTotal" value="">
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn primary-btn full-btn">Place Order</button>
                        </div>
                        </form>

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

                let url = APP_URL + '/dealer/shipping/methods/' + selectitem;
                const result = ajaxCall(url, 'get');
                result.then(handleShippingData).catch(handleShippingError)
            })
        });

        function handleShippingData(response) {
            jQuery('.shipping_carts').empty();

            jQuery.each(response.data, function(index, item) {
                jQuery('.shipping_carts').append(`
            <li>
                <input
                    type="radio"
                    id="ship_method${index}"
                    name="shippingMethod"
                    data-id="${item.id}"
                    value="${item.value}"
                    ${index === 0 ? 'checked' : ''}>
                <label for="ship_method${index}">
                    <div class="shipping-details">
                        <h3>${item.name}</h3>
                    </div>
                    <p>$${item.value}</p>
                </label>
            </li>`);
            });
            // Call this function to set the initial grand total
            updateGrandTotal();
        }

        function handleShippingError(error) {
            console.error('Shipping data error:', error);
        }

        function updateGrandTotal() {
            var baseAmount = parseFloat($('.grandTotal').data('amount').replace(/,/g, ''));
            var selected_shipment = $('input[name=shippingMethod]').data('id');
            var shippingCost = parseFloat($('input[name="shippingMethod"]:checked').val()) || 0;
            var grandTotal = baseAmount + shippingCost;
            jQuery('.shipping_charge_price').text('$' + shippingCost);
            jQuery('.grandTotal').text(formatCurrency(grandTotal));
            jQuery('#selected_shipping').val(selected_shipment);
            jQuery('#grandTotal').val(grandTotal);
        }

        function formatCurrency(amount) {
            return `$${amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`;
        }

        jQuery(document).ready(function() {
            jQuery(document).on('change', 'input[name="shippingMethod"]', function() {
                var currentSelectedShip = jQuery(this).data('id');
                updateGrandTotal();
                jQuery('#ship_method').val(currentSelectedShip);
            });
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
            var selectitem = jQuery(this).attr('data-name')
            var selecttext = jQuery(this).attr('data-text')
            jQuery('.city').empty();
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
            jQuery('#selectedCity').text(selecttext)
            jQuery(document).find('input[name="city"]').val(selectitem);
            jQuery('#city-error').text('');


        })
        // })
        // })
    </script>
@endpush
