@extends('layouts.admin')
@section('title', 'shipping')
@section('heading', 'shipping')

@section('content')
    <div class="main-content">
        <section class="section shipping-add-sec">
            <div class="section-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-12">
                        <div class="card">
                            <div class='ajax-response'></div>
                            <x-alert-component />
                            {{-- <div class="card-header">
                                <h4>Commision</h4>
                            </div> --}}
                            <div class="card-body shipper-page-main g-4">

                                <form id="manualShipping" action="{{ route('admin.shippment.manual.create',jsencode_userdata($result->order_id)) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkout-main-card cstm-card">
                                                <div class="shipment-address-box">
                                                    <div class="shipment-address-header">
                                                        <h3>Pick up Address</h3>
                                                    </div>
                                                    <p>{{$pickaddress ? ($pickaddress->first_name ?? 'N/A') . ' ' . ($pickaddress->last_name ?? 'N/A'): 'N/A' }}</p>
                                                    <h4>{{ $pickaddress ? ($pickaddress->address1 ?? 'N/A') . ' ' . ($pickaddress->city ?? 'N/A') . ', ' . ($pickaddress->state ?? 'N/A') . ', ' . ($pickaddress->pin_code ?? 'N/A') . ', ' . ($pickaddress->country ?? 'N/A') : 'N/A' }}
                                                    </h4>
                        
                                                    <div class="shipment-address-mail-phone">
                                                        <a href="#">{{ $pickaddress->address_from ? ($pickaddress->address_from->email  ?? 'N/A'):'N/A'}}</a>
                                                        <a href="#">{{ $pickaddress ? ($pickaddress->phone_number  ?? 'N/A'):'N/A'}}</a>
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
                                                    <p>{{$deliveryAddress ? ($deliveryAddress->name ?? 'N/A') . ' ' . ($deliveryAddress->last_name ?? 'N/A'): 'N/A' }}</p>
                                                    <h4>{{ $deliveryAddress ? ($deliveryAddress->address1 ?? 'N/A') . ' ' . ($deliveryAddress->city ?? 'N/A') . ', ' . ($deliveryAddress->state ?? 'N/A') . ', ' . ($deliveryAddress->post_code ?? 'N/A') . ', ' . ($deliveryAddress->country ?? 'N/A') : 'N/A' }}
                                                    </h4>
                                                    <div class="shipment-address-mail-phone">
                                                        <a href="#">{{ $deliveryAddress ? ($deliveryAddress->email  ?? 'N/A'):'N/A'}}</a>
                                                        <a href="#">{{ $deliveryAddress ? ($deliveryAddress->phone_number  ?? 'N/A'):'N/A'}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 g-4">
                                            <div class="form-group">
                                                <label for="shipment_title">Shipment Title</label>
                                                <div class="form-field">
                                                    <input type="text" id="shipment_title" name="shipment_title"
                                                        placeholder="e.g: Manage by platfrom"
                                                        value="@isset($data){{ $data->name }}@endisset"
                                                        class="form-control @error('shipment_title') is-invalid @enderror daf">
                                                    @error('shipment_title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="range_from">Pick Up Date<span
                                                        class="required-field">*</span></label>
                                                <div class="form-field">
                                                    <input type="text" disabled id="pick_date" name="pick_date"
                                                        placeholder="e.g: 08/10/2024"
                                                        class="form-control @error('range_from') is-invalid @enderror "
                                                        value="@isset($selectedPickAddressAndShipmentDetails){{ Carbon\Carbon::parse($selectedPickAddressAndShipmentDetails->shippment_date)->format('m/d/Y') ?? '' }}@endisset"
                                                        title="Pick up date for picking the part from seller">
                                                    @error('range_from')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="range_to">Delivery Date<span class="required-field">*</span></label>
                                                <div class="form-field">
                                                    <input type="text" name="delivery_date" id="delivery_date"
                                                        class="form-control @error('range_to') is-invalid @enderror sdfa"
                                                        value="@isset($data){{ $data->range_to ?? '' }}@endisset"
                                                        placeholder="e.g:  08/10/2024"
                                                        title="Delivery date for deliver the part to buyer">
                                                    @error('range_to')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn secondary-btn full-btn mr-1"
                                                href="{{ route('admin.shippment.listing') }}">Back
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn primary-btn full-btn mr-1" id="submit"
                                                type="submit">Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
@endsection
@push('scripts')
    <script>
        jQuery(document).ready(function (e) {
            jQuery(function() {
                var getPickDate=@json($selectedPickAddressAndShipmentDetails->shippment_date);
                var parts = getPickDate.split(' ')[0].split('-');
                var year = parseInt(parts[0], 10);
                var month = parseInt(parts[1], 10) - 1; // Months are 0-based
                var day = parseInt(parts[2], 10);
                var pickDate = new Date(year, month, day);
                jQuery("#delivery_date").datepicker({
                    dateFormat: "mm/dd/yy",
                    minDate: pickDate, // Prevent selection of previous dates
                });
                
                // var today = new Date();
                // var formattedDate = $.datepicker.formatDate('mm/dd/yy', today);
                // jQuery("#datepicker").datepicker("setDate", formattedDate);
                
                jQuery('#manualShipping').submit(function(event) {
                var datepickerValue = $('#delivery_date').val();

                if (!datepickerValue) {
                    event.preventDefault();
                    toastr.error('Please select Delivery date first.');
                }
                });
            });
        });
    </script>    
@endpush
