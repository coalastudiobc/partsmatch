@extends('layouts.dealer')
@section('title', 'Order Management')
@section('heading', 'Order Management')
@section('content')
<div class="dashboard-right-box">
    <div class="custm-card">
        <div class="adress-info-main">
            <div class="adress-info-haeder">
                <a class="back-btn" href="{{ route('Dealer.order.orderlist') }}"><i class="fa-solid fa-angle-left back-btn"></i> Back to
                    orders
                </a>
                <div class="order-label-center">
                    <h3>Create New FulFillment</h3>
                    <p>Step 1 of 2</p>
                </div>
                        <form id="selectedAddressForm" action="{{ route('Dealer.order.product.parcels', $orderid->id) }}" method="post">
                          @csrf
                            <!-- <div class="date-formfield">
                                <label for="date">Shippment Date:</label>
                                <div class="formfield ">
                                    <input type="text" id="datepicker" placeholder="Select Date" name="date" value="{{ old('date', isset($getSelectedStuff->shippment_date) ? \Carbon\Carbon::parse($getSelectedStuff->shippment_date)->format('m/d/Y') : '') }}">
                                    <span class="form-icon">
                                        <i class="fa-solid fa-calendar-days"></i>
                                    </span>
                                </div>
                                @error('date')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->
                            <button type="submit" class="btn primary-btn nextbtn"><b style="gap:0px;">Next:</b>Order Details</button>
            </div>

                            <div class="shipment-date-box">
                                <div class="date-formfield">
                                    <label for="date">Shippment Date:</label>
                                    <div class="formfield ">
                                        <input type="text" id="datepicker"  class="form-control" placeholder="Select Date" name="date" value="{{ old('date', isset($getSelectedStuff->shippment_date) ? \Carbon\Carbon::parse($getSelectedStuff->shippment_date)->format('m/d/Y') : '') }}">
                                        <span class="form-icon">
                                            <i class="fa-solid fa-calendar-days"></i>
                                        </span>
                                    </div>
                                    @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="shipment-adress-details-box">
                                <div class="right-btn-box">
                                    <h3>Choose Pick Up Address</h3>
                                    <a href="#" class="btn primary-btn add-address-btn" data-bs-toggle="modal" data-bs-target="#pickadress-modal"><img src="{{ asset('assets/images/add-round-icon.svg') }}" alt=""> Add address</a>
                                </div>
                                @isset($previousAddresses)
                                    <div class="row g-3">
                                        @forelse ($previousAddresses as $key=> $address)
                                        <div class="col-md-12">
                                            <label class="adress-info-inner" for="adress{{$key}}">
                                                <div class="address-haeding-edit">
                                                    <h3>Address {{ $key + 1 }}</h3>

                                                </div>
                                                <div class="shipment-adress-filled-data">
                                                    <input type="radio" name="selectadress" id="adress{{$key}}" @isset($getSelectedStuff) @if ($getSelectedStuff->selected_shippo_address == $address->id ) checked @endif @endisset value="{{ $address->id }}">
                                                    <div class="adress-info-text">
                                                        <h2>{{ $address->first_name }} {{ $address->last_name }}</h2>
                                                        <p>{{ $address->address1 }}, {{ $address->city }}, {{ $address->state }},
                                                            {{ $address->pin_code }},
                                                            {{ $address->country }}
                                                        </p>
                                                        <p>{{ $address->phone_number }}</p>
                                                    </div>
                                                    <a href="{{ route(auth()->user()->getRoleNames()->first() . '.address.delete', ['address' => $address->id]) }}" class="delete"><i class="fa-regular fa-trash-can " style="color: #E13F3F;"></i></a>

                                                </div>
                                            </label>
                                        </div>
                                        @empty
                                        @endforelse
                                    </div>
                                @endisset
                            </div>
                     </form>
                                {{-- <div class="col-md-6">
                                            <div class="adress-info-inner add-addres-box">
                                                <div class="address-haeding-edit">
                                                    <h3>Adress 2</h3>
                                                    <a href="#">Edit</a>
                                                </div>
                                                <label for="adress1">
                                                    <input type="radio" name="order-adress" id="adress1">
                                                    <div class="adress-info-text">
                                                        <h2>Salinas Richardson Inc</h2>
                                                        <p>733 N Kedzie Ave, Chicago, IL 60612, United States</p>
                                                        <p>xigisywo@mailinator.com +1 (916) 889-7416</p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div> --}}
                                {{-- <div class="col-md-12">
                                        <div class="adress-info-inner add-address-box">
                                            <form id="From_address" class="addForm" action="{{ route('Dealer.address.picking') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <h3>Personal info</h3>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">First Name<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="First Name">
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
                                            <label for="">Last Name<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Last Name">
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Phone Number<span class="required-field">*</span></label>
                                            <input type="number" name="phone_number" value="" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone number">
                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <div class="formfield">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Address</h3>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Street No. & Name<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <input type="text" class="form-control @error('street1') is-invalid @enderror" name="street1" placeholder="Address">
                                                @error('street1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <input type="hidden" name="address_type" id="" value="Home">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <div class="form-field">
                                                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Address">
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Country<span class="required-field">*</span></label>
                                            <div class="custm-dropdown">
                                                <div class="dropdown">
                                                    <div class=" form-control dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <div id="selectedItem">
                                                        </div>
                                                        <span class="custm-drop-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                                                <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <ul class="dropdown-menu outer-box" id="country" aria-labelledby="dropdownMenuButton1">
                                                        @foreach ($countries as $country)
                                                        <li><a class="dropdown-item custom_dropdown_item" data-iso_code="{{ $country->iso_code }}" data-value="{{ $country->id }}" data-text="{{ $country->name }}" href="javascript:void(0)">{{ $country->name }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <input type="hidden" name="country" id="country_code" value="{{ $country->id ?? '' }}" class="form-control @error('country') is-invalid @enderror">
                                            @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">State<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <div class="custm-dropdown">
                                                    <div class="dropdown">
                                                        <div class="form-control dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <div id="selectedState">
                                                                {{-- {{ $state->name ?? 'select' }} --}}
                                                                {{-- </div>
                                <span class="custm-drop-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                        <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                            <ul class="dropdown-menu outer-box state" aria-labelledby="dropdownMenuButton1">
                            </ul>
                            <input type="hidden" name="state" id="state_iso" value="{{ $state->id ?? '' }}"
                                                                class="@error('state') is-invalid @enderror">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">City<span class="required-field">*</span></label>
                                                    <div class="form-field">
                                                        <div class="custm-dropdown">
                                                            <div class="dropdown">
                                                                <div class="form-control dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <div id="selectedCity">
                                                                    </div>
                                                                    <span class="custm-drop-icon">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                                                            <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                                        </svg>
                                                                    </span>
                                                                </div>
                                                                <ul class="dropdown-menu outer-box city" aria-labelledby="dropdownMenuButton1">
                                                                </ul>
                                                                <input type="hidden" name="city" id="city_name" value="" class="@error('city') is-invalid @enderror">
                                                                @error('city')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="pin_code">Pin code<span class="required-field">*</span></label>
                                                    <div class="form-field">
                                                        <input type="text" name="pin_code" class="form-control @error('pin_code') is-invalid @enderror" value="{{ old('pin_code', auth()->user()->shippingAddress->post_code ?? '') }}" placeholder="PIN code">
                                                        @error('pin_code')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-flex align-items-center gap-2 justify-content-end">
                                                    {{-- <a href="#" class="btn secondary-btn md-btn mr-1 cancel-address">Back</a> --}}
                                                    {{-- <button class="btn primary-btn md-btn mr-1" id="submit" type="submit">Submit</button>
                            </div>
                        </div>

                        </div>
                        </form>
                        <a href="#" class="cancel-address"><i class="fa-solid fa-xmark"></i></a>
                        </div>
                        </div>
                        </div> --}}
                                                    {{-- </div>
                            </div>
                        @endsection --}}

                                                    <!-- Button trigger modal -->
                                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pickadress-modal">
                        Launch static backdrop modal
                    </button> --}}

                                <!-- Modal -->
        <div class="modal fade" id="pickadress-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="pickup-adress-box">
                            <form id="From_address" class="addForm" action="{{ route('Dealer.address.picking') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <h3 class="pick-address-head">Add pick up address</h3>
                                <div class="row">
                                    <h3>Personal info</h3>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">First Name<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="First Name">
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
                                            <label for="">Last Name<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Last Name">
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Phone Number<span class="required-field">*</span></label>
                                            <input type="text" name="phone_number" value="" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone number">
                                            @error('phone_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <div class="formfield">
                                                <input type="text" class="form-control" name="email">
                                            </div>
                                        </div>
                                    </div>
                                    <h3>Address</h3>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Street No. & Name<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <input type="text" class="form-control @error('street1') is-invalid @enderror" name="street1" placeholder="e.g: 001 Bellevue Square, Space 201">
                                                @error('street1')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <input type="hidden" name="address_type" id="" value="Home">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Description</label>
                                            <div class="form-field">
                                                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Address">
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Country<span class="required-field">*</span></label>
                                            <div class="custm-dropdown">
                                                <div class="dropdown">
                                                    <div class=" form-control dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <div id="selectedItem">Select Country
                                                        </div>
                                                        <span class="custm-drop-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                                                <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <ul class="dropdown-menu outer-box" id="country" aria-labelledby="dropdownMenuButton1">
                                                        @foreach ($countries as $country)
                                                        <li><a class="dropdown-item custom_dropdown_item" data-iso_code="{{ $country->iso_code }}" data-value="{{ $country->id }}" data-text="{{ $country->name }}" href="javascript:void(0)">{{ ucfirst($country->name) }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            <input type="hidden" name="country" id="country_code" value=''  class="form-control @error('country') is-invalid @enderror">
                                            @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">State<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <div class="custm-dropdown">
                                                    <div class="dropdown">
                                                        <div class="form-control dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" >
                                                            <div id="selectedState" >Select State
                                                                {{-- {{ $state->name ?? 'select' }} --}}
                                                            </div>
                                                            <span class="custm-drop-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                                                    <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <ul class="dropdown-menu outer-box state" aria-labelledby="dropdownMenuButton1">
                                                        </ul>
                                                        <input type="hidden" name="state" id="state_iso" value="{{$state->id ?? ''}}" class="@error('state') is-invalid @enderror">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">City<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <div class="custm-dropdown">
                                                    <div class="dropdown">
                                                        <div class="form-control dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <div id="selectedCity">Select City
                                                            </div>
                                                            <span class="custm-drop-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                                                    <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                            <ul class="dropdown-menu outer-box city" aria-labelledby="dropdownMenuButton1">
                                                            </ul>
                                                            <input type="hidden" name="city" id="city_name" value="" class="@error('city') is-invalid @enderror">
                                                            @error('city')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="pin_code">Zip/ Postal Code<span class="required-field">*</span></label>
                                            <div class="form-field">
                                                <input type="text" name="pin_code" class="form-control @error('pin_code') is-invalid @enderror" value="{{ old('pin_code', auth()->user()->shippingAddress->post_code ?? '') }}" placeholder="Zip/ Postal Code">
                                                @error('pin_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex align-items-center gap-2 justify-content-end">
                                            {{-- <a href="#" class="btn secondary-btn md-btn mr-1 cancel-address">Back</a> --}}
                                            <button class="btn primary-btn md-btn mr-1" id="submit" type="submit">Submit</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            {{-- <a href="#" class="cancel-address"><i class="fa-solid fa-xmark"></i></a> --}}
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@includeFirst(['validation.dealer.js_picking_address'])
<script>
    jQuery(function() {
        jQuery("#datepicker").datepicker({
            dateFormat: "mm/dd/yy",
            minDate: new Date(), // Prevent selection of previous dates
        });

        // var today = new Date();
        // var formattedDate = $.datepicker.formatDate('mm/dd/yy', today);
        // jQuery("#datepicker").datepicker("setDate", formattedDate);

        jQuery('#selectedAddressForm').submit(function(event) {
            var datepickerValue = $('#datepicker').val();
            var selectedAddress = $('input[name="selectadress"]:checked').val();

            if (!datepickerValue) {
                event.preventDefault();
                toastr.error('Please select shippment date first.');
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var previousAddresses = @json($previousAddresses);
        if (previousAddresses.length > 0) {
            console.log('Previous addresses:', previousAddresses);
        } else {
            console.log('No previous addresses found.');
        }
    });

    jQuery(".add-address-box").addClass('open');

    jQuery('.nextbtn').on('click', function(e) {
        if (!jQuery('input[name="selectadress"]').is(':checked')) {
            e.preventDefault();
            toastr.error("Please select any one address Or Please add new one.");
        }

    })

    jQuery('.add-address-btn').on('click', function() {
        jQuery(".add-address-box").addClass('open');
        // jQuery('.addForm').attr('id', 'myFormId');

    });
    jQuery('.cancel-address').on('click', function() {
        jQuery(".add-address-box").removeClass('open');
    });
    jQuery('.back-btn').on('click', function() {
        jQuery("#fullPageLoader").removeClass('d-none');
    });
</script>
@endpush