@extends('layouts.front')
@section('content')
    <section class="page-content-sec">
        <div class="container">
            <div class="page-content-wrapper">
                <div class="row g-3">
                    <div class="col-xl-7 col-lg-12 col-md-12">
                        <div class="checkout-main-card cstm-card">
                            <h2>Delivery Address</h2>
                            <div class="delivery-form">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-12">
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

                                                <input type="hidden" name="country" value="" id="">
                                                <div class="custm-dropdown">
                                                    <div class="dropdown">
                                                        <div class="dropdown-toggle " type="button"
                                                            id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <div id="selectedItem">
                                                                Select

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
                                                                        data-text="{{ $country->name }}"
                                                                        href="javascript:void(0)">{{ $country->name }}</a>
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">First Name</label>
                                                <div class="form-field">
                                                    <input type="text" class="form-control" name="first_name"
                                                        value="{{ old('first_name') }}" placeholder="First Name">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Last Name</label>
                                                <div class="form-field">
                                                    <input type="text" class="form-control" name="last_name"
                                                        value="{{ old('last_name') }}" placeholder="Last Name">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Address 1</label>
                                                <div class="form-field">
                                                    <input type="text" class="form-control" name="shiping_address"
                                                        placeholder="Address">

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
                                                    <input type="text" class="form-control" name="shiping_address"
                                                        placeholder="Address">

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

                                                    <input type="hidden" name="state" value="">
                                                    <div class="custm-dropdown">
                                                        <div class="dropdown">
                                                            <div class="dropdown-toggle " type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <div id="selectedState">
                                                                    Select

                                                                </div>
                                                                <span class="custm-drop-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="23" viewBox="0 0 24 23" fill="none">
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

                                                    <input type="hidden" name="city" value="">
                                                    <div class="custm-dropdown">
                                                        <div class="dropdown">
                                                            <div class="dropdown-toggle " type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <div id="selectedCity">
                                                                    Select

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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">PIN code</label>
                                                <div class="form-field">
                                                    <input type="text" name="pin_code" class="form-control"
                                                        placeholder="PIN code">

                                                </div>
                                            </div>
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
                            <div class="payment-page">
                                <h3>Payment</h3>
                                <p>All transactions are secure and encrypted.</p>
                                <form action="">
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
                                                    <div class="form-field">
                                                        <input type="text" class="form-control"
                                                            placeholder="Card-number">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Expiration date</label>
                                                    <div class="form-field">
                                                        <input type="text" class="form-control" placeholder="MM / YY">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Security Code</label>
                                                    <div class="form-field">
                                                        <input type="password" class="form-control" placeholder="****">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Name On Card</label>
                                                    <div class="form-field">
                                                        <input type="text" class="form-control"
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
                                    <a href="#" class="btn secondary-btn full-btn">Pay Now</a>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-12 col-md-12">
                        <div class="order-summary cstm-card">
                            <h2>order summary</h2>
                            <ul class="order-summary-list">
                                <li>
                                    <div class="summary-list-box">
                                        <div class="summary-img-txt">
                                            <div class="summary-img-box">
                                                <img src="images/part-img.png" alt="">
                                                <div class="order-sum-number">
                                                    <span>2</span>
                                                </div>
                                            </div>
                                            <div class="summary-txt-box">
                                                <h3>Car Engine 700219 Whitewall</h3>
                                                <p>(Automobile)</p>
                                            </div>
                                        </div>
                                        <p>$700</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="summary-list-box">
                                        <div class="summary-img-txt">
                                            <div class="summary-img-box">
                                                <img src="images/collect1.png" alt="">
                                                <div class="order-sum-number">
                                                    <span>1</span>
                                                </div>
                                            </div>
                                            <div class="summary-txt-box">
                                                <h3>Car Engine 700219 Whitewall</h3>
                                                <p>(Automobile)</p>
                                            </div>
                                        </div>
                                        <p>$700</p>
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
    <script>
        jQuery(document).ready(function() {
            jQuery('.custom_dropdown_item').on('click', function() {
                var selectitem = jQuery(this).attr('data-value')
                var selecttext = jQuery(this).attr('data-text')
                jQuery('#selectedItem').text(selecttext)
                jQuery(document).find('input[name="country"]').val(selectitem);

            })
        });

        jQuery(document).ready(function() {

            jQuery('.custom_dropdown_item').on('click', function() {
                console.log('hererer');
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
            jQuery('#city').html('<option value="">Select City</option>');
            response.data.forEach(state => {
                // options += '<option value="' + state.id + '">' + state.name + '</option>';
                $('.state').append(`<li><a class="dropdown-item state_dropdown_item select_state"
                                                                            data-value="${state.id}"
                                                                            data-text="${state.name}"
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
            var selectitem = jQuery(this).attr('data-value')
            var selecttext = jQuery(this).attr('data-text')
            console.log('selecttext', selectitem, selecttext)
            jQuery('#selectedState').text(selecttext)
            jQuery(document).find('input[name="state"]').val(selectitem);

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
                                                                        href="javascript:void(0)">${city.name}</a>
                                                                </li>`)
                });
                jQuery('#city').html(options);
            }
        })

        jQuery(document).on('click', '.select_city', function() {
            // alert('lund');
            var selectitem = jQuery(this).attr('data-value')
            var selecttext = jQuery(this).attr('data-text')
            console.log('selecttext', selectitem, selecttext)
            jQuery('#selectedCity').text(selecttext)
            jQuery(document).find('input[name="city"]').val(selectitem);

        })
        // })
        // })
    </script>
@endpush
