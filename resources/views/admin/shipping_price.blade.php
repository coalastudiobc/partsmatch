@extends('layouts.admin')
@section('title', 'shipping')
@section('heading', 'shipping')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-12">
                        <div class="card">
                            <div class='ajax-response'></div>
                            <x-alert-component />
                            {{-- <div class="card-header">
                                <h4>Commision</h4>
                            </div> --}}
                            <div class="card-body">

                                <form id="shipping" action="{{ route('admin.shipping') }}" enctype="multipart/form-data"
                                    method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group">
                                            <label>Shipping Charge Type</label>
                                            {{-- <select id="checktype" name="shipping_charge_type"
                                                class="form-control @error('shipping_charge_type') is-invalid @enderror">
                                                <option value="Percentage"
                                                    @if (get_admin_setting('shipping_charge_type') == 'Percentage') selected @endif>
                                                    Percentage
                                                </option>
                                                <option value="Fixed" @if (get_admin_setting('shipping_charge_type') == 'Fixed') selected @endif>
                                                    Fixed
                                                </option>
                                            </select> --}}
                                            <input type="hidden" name="shipping_charge_type"
                                                value="{{ old('shipping_charge_type', get_admin_setting('shipping_charge_type') == 'Fixed' ? 'Fixed' : 'Percentage') }}"
                                                id=""
                                                class="@error('shipping_charge_type') is-invalid @enderror checktype">
                                            <div class="custm-dropdown">
                                                <div class="dropdown checktype">
                                                    <div class="dropdown-toggle " type="button" id="dropdownMenuButton1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <div id="selectedcommission">
                                                            {{ old('shipping_charge_type', get_admin_setting('shipping_charge_type') == 'Fixed' ? 'Fixed' : 'Percentage') }}


                                                        </div>
                                                        <span class="custm-drop-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="23" viewBox="0 0 24 23" fill="none">
                                                                <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515"
                                                                    stroke-width="1.8" stroke-linecap="round"
                                                                    stroke-linejoin="round" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                        <li><a class="dropdown-item custom_dropdown_commission"
                                                                @if (get_admin_setting('shipping_charge_type') == 'Percentage') selected @endif
                                                                data-value="Percentage" data-text="Percentage"
                                                                href="javascript:void(0)">Percentage</a>
                                                        </li>
                                                        <li><a class="dropdown-item custom_dropdown_commission"
                                                                @if (get_admin_setting('shipping_charge_type') == 'Fixed') selected @endif
                                                                data-value="Fixed" data-text="Fixed"
                                                                href="javascript:void(0)">Fixed</a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            @error('shipping_charge_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            {{-- <div class="input-icon-custm tooltip-open">
                                                <span>
                                                    <i class="fa-solid fa-question"></i>
                                                </span>
                                                <div class="tooltip">
                                                    <p>ghfvjvhm</p>
                                                </div>
                                            </div> --}}
                                        </div>
                                        <div class="form-group">
                                            <label>Shipping Charge<span class="required-field">*</span></label>
                                            <div class="symbol"></div>
                                            <input type="number" id="checkcommission" name="shipping_charge"
                                                class="form-control @error('shipping_charge') is-invalid @enderror two-decimals"
                                                value="{{ old('shipping_charge', get_admin_setting('shipping_charge')) }}">

                                            @error('shipping_charge')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="input-icon-custm tooltip-open">
                                                <span>
                                                    <i class="fa-solid fa-question"></i>
                                                </span>
                                                <div class="tooltip">
                                                    <p>ghfvjvhm</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <a class="btn secondary-btn full-btn mr-1"
                                                href="{{ route('admin.shipping') }}">Back</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn primary-btn full-btn mr-1" id="submit"
                                                type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    @includeFirst(['validation.js_shipping'])
    <script>
        $(".two-decimals").on("keypress", function(evt) {
            var txtBox = $(this);
            var charCode = (evt.which) ? evt.which : evt.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
                return false;
            else {
                var len = txtBox.val().length;
                var index = txtBox.val().indexOf('.');
                if (index > 0 && charCode == 46) {
                    return false;
                }
                if (index > 0) {
                    var charAfterdot = (len + 1) - index;
                    if (charAfterdot > 3) {
                        return false;
                    }
                }
            }
            return txtBox;
        });
    </script>
    <script>
        $(document).ready(function() {
            // change symbols
            var type = $('.checktype').val();

            if (type == 'Percentage') {

                // $('#checkcommission').attr('min', '1');
                // $('#checkcommission').attr('max', '99');
                $('.symbol').text('%');
            } else {
                // $('#checkcommission').removeAttr('min', '1');
                // $('#checkcommission').removeAttr('max', '99');
                $('.symbol').text('$');
            }
            $('.checktype').on('click', function() {
                var type = $('.checktype').val();

                if (type == 'Percentage') {
                    // $('#checkcommission').attr('min', '1');
                    // $('#checkcommission').attr('max', '99');
                    $('.symbol').text('%');

                } else {
                    // $('#checkcommission').removeAttr('min', '1');
                    // $('#checkcommission').removeAttr('max', '99');
                    $('.symbol').text('$');
                }
            });

            // change value

            jQuery('.custom_dropdown_commission').on('click', function() {
                var selectitem = jQuery(this).attr('data-value')
                var selecttext = jQuery(this).attr('data-text')
                console.log(selectitem, selecttext)
                jQuery('#selectedcommission').text(selecttext)
                jQuery(document).find('input[name="shipping_charge_type"]').val(selectitem);

            });

        });
    </script>
@endpush
