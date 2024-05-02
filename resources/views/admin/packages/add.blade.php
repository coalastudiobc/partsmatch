@extends('layouts.admin')
@section('title', $package->id ? 'Update Subscription Plan' : 'Add Subscription Plan')
@section('heading', 'Subscription Plans')

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
                                <h4>{{ $package->id ? 'Update Subscription Plan' : 'Add Subscription Plan' }}</h4>
                            </div> --}}
                            <div class="card-body">
                                <form id="package"
                                    action="{{ $package->id ? route('admin.packages.store', [jsencode_userdata($package->id)]) : route('admin.packages.store') }}";
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="form-row row ">
                                        <div class="form-group  col-md-6">
                                            <label>Name<span class="required-field">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $package->name ?? $package->name) }}">
                                            @error('name')
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
                                        <div class="form-group col-md-6">
                                            <label>Price<span class="required-field">*</span></label>
                                            <div class="doller-input-field @error('price') is-invalid @enderror">
                                                {{-- <div class="symbol">$</div> --}}
                                                <input type="text" name="price" class="form-control two-decimals"
                                                    value="{{ old('price', $package ?? $package) }}">
                                                <span class="doller-symbol-txt symbol">$</span>
                                            </div>
                                            @error('price')
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

                                        <div class="form-group col-md-6">
                                            <label>Type<span class="required-field">*</span></label>
                                            {{-- <select name="time_type"
                                                class="form-control @error('time_type') is-invalid @enderror">
                                                <option value="{{ jsencode_userdata('Yearly') }}">Yearly </option>
                                                <option value="{{ jsencode_userdata('Monthly') }}">Monthly</option>
                                                <option value="{{ jsencode_userdata('Quarterly') }}">Every 3 months
                                                </option>
                                                <option value="{{ jsencode_userdata('Halfly') }}">Every 6 months
                                                </option>
                                               
                                            </select> --}}


                                            <div class="custm-dropdown ">
                                                <div class="dropdown">
                                                    <div class="dropdown-toggle " type="button" id="dropdownMenuButton1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <div id="selectedItem">
                                                            {{-- {{ $package->billing_cycle ?? 'select' }} --}}
                                                            @switch($package->billing_cycle)
                                                                @case('Yearly')
                                                                    Yearly
                                                                @break

                                                                @case('Monthly')
                                                                    Monthly
                                                                @break

                                                                @case('Quarterly')
                                                                    Every 3 months
                                                                @break

                                                                @case('Halfly')
                                                                    Every 6 months
                                                                @break

                                                                @default
                                                                    select
                                                            @endswitch
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

                                                        <li><a class="dropdown-item custom_dropdown_item"
                                                                data-value="{{ jsencode_userdata('Yearly') }}"
                                                                data-text="Yearly" href="javascript:void(0)">Yearly</a>
                                                        </li>
                                                        <li><a class="dropdown-item custom_dropdown_item"
                                                                data-value="{{ jsencode_userdata('Monthly') }}"
                                                                data-text="Monthly" href="javascript:void(0)">Monthly</a>
                                                        </li>
                                                        <li><a class="dropdown-item custom_dropdown_item"
                                                                data-value="{{ jsencode_userdata('Quarterly') }}"
                                                                data-text="Every 3
                                                                months"
                                                                href="javascript:void(0)">Every 3
                                                                months</a>
                                                        </li>
                                                        <li><a class="dropdown-item custom_dropdown_item"
                                                                data-value="{{ jsencode_userdata('Halfly') }}"
                                                                data-text="Every 6
                                                                months"
                                                                href="javascript:void(0)">Every 6
                                                                months</a>
                                                        </li>


                                                    </ul>
                                                </div>
                                            </div>
                                            <div id="errorViewer">
                                                <input type="hidden" name="time_type"
                                                    value="{{ jsencode_userdata($package->billing_cycle) ?? '' }}"
                                                    id=""
                                                    class="image-input @error('time_type') is-invalid @enderror">
                                                @error('time_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Status</label>
                                            {{-- <select name="status"
                                                class="form-control @error('status') is-invalid @enderror">
                                                <option value="1">
                                                    Active</option>
                                                <option value="0">
                                                    Inactive</option>
                                            </select> --}}
                                            <input type="hidden" name="status"
                                                value="{{ (!isset($package->status) ? 1 : $package->status == 1) ? 1 : 0 }}"
                                                id="">
                                            <div class="custm-dropdown">
                                                <div class="dropdown">
                                                    <div class="dropdown-toggle " type="button" id="dropdownMenuButton1"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <div id="selectedstatus">
                                                            {{ $package->id ? ($package->status == 1 ? 'Active' : 'Inactive') : 'select' }}
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

                                                        <li><a class="dropdown-item custom_dropdown_status" data-value="1"
                                                                data-text="Active" href="javascript:void(0)">Active</a>
                                                        </li>
                                                        <li><a class="dropdown-item custom_dropdown_status" data-value="0"
                                                                data-text="Inactive"
                                                                href="javascript:void(0)">Inactive</a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Description</label>
                                            <textarea class="form-control summernote @error('description') is-invalid @enderror" name="description">{{ $package->description ? $package->description : '        ' }}</textarea>
                                            <div class="input-icon-custm tooltip-open">
                                                <span>
                                                    <i class="fa-solid fa-question"></i>
                                                </span>
                                                <div class="tooltip">
                                                    <p>ghfvjvhm</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class=" col-md-6">
                                            <a class="btn secondary-btn mr-1 full-btn"
                                                href="{{ route('admin.packages.all') }}">Back</a>
                                        </div>
                                        <div class=" col-md-6">
                                            <button class="btn primary-btn full-btn" id="submit">Submit</button>
                                        </div>
                                    </div>
                                    {{-- @dd($package) --}}

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
    @includeFirst(['validation.js_package'])
    <script>
        // jQuery(document).ready(function() {
        //     jQuery('#submit').click(function(e) {
        //         e.preventDefault();
        //         if (jQuery('#package').valid()) {
        //             var formData = new FormData($('form#package').get(0));
        //             
        //             var response = ajaxCall(url, 'post', formData);
        //             response.then(handlePackage).catch(handlePackageError)

        //             function handlePackage(response) {
        //                 if (response.success == true && response.url) {

        //                     window.location.replace(response.url);

        //                 } else if (response.success == false) {
        //                     if ('errortype' in response && response.errortype) {
        //                         var response_ajax = jQuery(document).find(".ajax-response-" + response
        //                             .errortype);
        //                     } else {
        //                         var response_ajax = jQuery(document).find(".ajax-response");
        //                         $("html, body").animate({
        //                             scrollTop: 0
        //                         }, "fast");
        //                     }
        //                     response_ajax.html(
        //                         '<div class="alert alert-danger alert-dismissible fade show k" role="alert">' +
        //                         response.msg +
        //                         '<button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
        //                     );
        //                 }
        //             }

        //             function handlePackageError(error) {
        //                 console.log('error', error)
        //             }
        //         }
        //     });
        // });



        // $(document).ready(function() {
        //     $('.summernote').summernote();
        // });

        // dropdown
        jQuery(document).ready(function() {
            jQuery('.custom_dropdown_item').on('click', function() {
                var selectitem = jQuery(this).attr('data-value')
                var selecttext = jQuery(this).attr('data-text')
                jQuery('#selectedItem').text(selecttext)
                jQuery(document).find('input[name="time_type"]').val(selectitem);
            })
            jQuery('.custom_dropdown_status').on('click', function() {
                var selectitem = jQuery(this).attr('data-value')
                var selecttext = jQuery(this).attr('data-text')
                jQuery('#selectedstatus').text(selecttext)
                jQuery(document).find('input[name="status"]').val(selectitem);

            });
        });
    </script>
@endpush
