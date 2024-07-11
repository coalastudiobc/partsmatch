@extends('layouts.dealer')
@section('title', 'Picking Address')
@section('heading', 'Pickup Address')
@section('content')
    <div class="dashboard-right-box parts-manager-table-box">
        <x-alert-component />
        <div class="delivery-form">
            <form id="From_address" action="{{ route('Dealer.address.from') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Country</label>
                            <div class="custm-dropdown">
                                <div class="dropdown">
                                    <div class=" form-control dropdown-toggle " type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <div id="selectedItem">
                                            {{-- {{ $country->name ?? 'Select' }} --}}
                                        </div>
                                        <span class="custm-drop-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23"
                                                viewBox="0 0 24 23" fill="none">
                                                <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515"
                                                    stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </span>
                                    </div>
                                    <ul class="dropdown-menu outer-box" id="country"
                                        aria-labelledby="dropdownMenuButton1">
                                        @foreach ($countries as $country)
                                            <li><a class="dropdown-item custom_dropdown_item"
                                                    data-iso_code="{{ $country->iso_code }}"
                                                    data-value="{{ $country->id }}" data-text="{{ $country->name }}"
                                                    href="javascript:void(0)">{{ $country->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <input type="hidden" name="country" id="country_code" value="{{ $country->id ?? '' }}"
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
                            <input type="number" name="phone_number" value=""
                                class="form-control @error('phone_number') is-invalid @enderror">
                            @error('phone_number')
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
                                    <input type="radio" name="addressType" id="s-option" style="display: none"
                                        value="Home" checked>
                                </label>
                                <label for="v-option">
                                    <p>Office</p>
                                    <input type="radio" name="addressType" id="v-option" value="Office"
                                        style="display: none">
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


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <div class="form-field">
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name" placeholder="First Name">
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
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" placeholder="Last Name">
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
                                <input type="text" class="form-control @error('street1') is-invalid @enderror"
                                    name="street1" placeholder="Address">
                                @error('street1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Address</label>
                            <div class="form-field">
                                <input type="text" class="form-control @error('street2') is-invalid @enderror"
                                    name="street2" placeholder="Address">
                                @error('street2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Description</label>
                            <div class="form-field">
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" placeholder="Address">
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">State</label>
                            <div class="form-field">
                                <div class="custm-dropdown">
                                    <div class="dropdown">
                                        <div class="form-control dropdown-toggle " type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div id="selectedState">
                                                {{-- {{ $state->name ?? 'select' }} --}}

                                            </div>
                                            <span class="custm-drop-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23"
                                                    viewBox="0 0 24 23" fill="none">
                                                    <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515"
                                                        stroke-width="1.8" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                        <ul class="dropdown-menu outer-box state" aria-labelledby="dropdownMenuButton1">
                                            {{-- @foreach ($states as $state)
                                                <li><a class="dropdown-item custom_dropdown_item"
                                                        data-value="{{ $state->id }}" data-text="{{ $state->name }}"
                                                        href="javascript:void(0)">{{ $state->name }}</a>
                                                </li>
                                            @endforeach --}}

                                        </ul>
                                        <input type="hidden" name="state" id="state_iso"
                                            value="{{ $state->id ?? '' }}" class="@error('state') is-invalid @enderror">
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">City</label>
                            <div class="form-field">
                                <div class="custm-dropdown">
                                    <div class="dropdown">
                                        <div class="form-control dropdown-toggle " type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div id="selectedCity">
                                                {{-- {{ $city->name ?? 'Select' }} --}}
                                            </div>
                                            <span class="custm-drop-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23"
                                                    viewBox="0 0 24 23" fill="none">
                                                    <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515"
                                                        stroke-width="1.8" stroke-linecap="round"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </span>
                                        </div>
                                        <ul class="dropdown-menu outer-box city" aria-labelledby="dropdownMenuButton1">
                                            {{-- @foreach ($countries as $country)
                                                <li><a class="dropdown-item custom_dropdown_item"
                                                        data-value="{{ $country->id }}"
                                                        data-text="{{ $country->name }}"
                                                        href="javascript:void(0)">{{ $country->name }}</a>
                                                </li>
                                            @endforeach --}}

                                        </ul>
                                        <input type="hidden" name="city" id="city_name"
                                            @isset($city)
                                       value="{{ $city->id ?? '' }}" @endisset
                                            class="@error('city') is-invalid @enderror">
                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <input type="hidden" name="city" value="{{ $city->id ?? '' }}"
                                    class="@error('city') is-invalid @enderror">
                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Pin code</label>
                            <div class="form-field">
                                <input type="text" name="pin_code"
                                    class="form-control @error('pin_code') is-invalid @enderror"
                                    value="{{ auth()->user()->shippingAddress->post_code ?? '' }}"
                                    placeholder="PIN code">
                                @error('pin_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-12">
                    <button type="submit" class="btn primary-btn full-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    @includeFirst(['validation.dealer.js_picking_address'])
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
                var country_code = jQuery(this).attr('data-iso_code')
                jQuery('#country_code').val(country_code);
                // var countryId = selectitem
                let url = APP_URL + '/dealer/state/' + countryId;
                if (jQuery.isNumeric(countryId) && countryId > 0) {
                    const result = ajaxCall(url, 'get');
                    result.then(handleCountryData).catch(handleCountryError)
                }
            })
        })

        function handleCountryData(response) {
            console.log(response);
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
            console.log('selecttext', selectitem, selecttext)
            jQuery('#selectedState').text(selecttext)
            jQuery(document).find('input[name="state"]').val(selectitem);
            jQuery('#state_iso-error').text('');


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
                console.log(response);

                let options = '<li> <a href="javascript:void(0)"> Select < /a></li>';
                // jQuery('#state').html(options);
                jQuery('#city').html(options);
                jQuery('.city').empty();

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
            jQuery('#city_name-error').text('');

        })
        // })
        // })
    </script>
@endpush
