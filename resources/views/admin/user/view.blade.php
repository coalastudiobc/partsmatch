@extends('layouts.admin')

@section('title', 'Dealer Details')
@section('heading', 'Dealer')

@section('content')
    <div class="main-content">
        <div class="page-content-wrapper">
            <div class="dealer-profile-box">
                <div class="dealer-profile-content">
                    <div class="dealer-profile-form-box">
                        <div class="dealer-profile-detail-form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="dealer-profile-upload-box">
                                            <div class="upload-img">
                                                <div class="file-upload-box">
                                                    <label for="file-upload">
                                                        <div class="profile-without-img">
                                                            <img src="{{ !is_null($user->profile_picture_url) ? asset('storage/' . $user->profile_picture_url) : asset('assets/images/user.png') }}"
                                                                alt="">
                                                            {{-- <div class="upload-icon"> --}}
                                                            {{-- <i class="fa-sharp fa-solid fa-pen"></i> --}}
                                                            {{-- </div> --}}
                                                        </div>
                                                        {{-- <input type="file" id="file-upload"> --}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="row g-4">
                                    <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12">
                                        <div class="dealer-pro-personal-info">
                                            <ul>
                                                <li>
                                                    <h4>Name</h4>
                                                    <p>{{ $user->name ? $user->name : 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h4>Email</h4>
                                                    <p>{{ $user->email ? $user->email : 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h4>Phone Number</h4>
                                                    <p>{{ $user->phone_number ? $user->phone_number : 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h4>Industry</h4>
                                                    <p>{{ $user->industry_type ? $user->industry_type : 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h4>Address</h4>
                                                    <p>{{ $user->address ? $user->address : 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h4>Zipcode</h4>
                                                    <p>{{ optional($user->postalCode)->code ?? 'N/A' }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-12">
                                        <div class="dealer-pro-commission-info">
                                            <ul>
                                                <li>
                                                    <h4>Commission</h4>
                                                    <div class="d-flex gap-5 align-items-center">
                                                        <p class="commission-value">
                                                            @if (isset($user->ComissionDetails->commision_value))
                                                                {{ $user->ComissionDetails->commision_value }}{{ $user->ComissionDetails->commision_type == 'Percentage' ? '%' : '$' }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </p>
                                                        <a class="" >
                                                            @if (isset($user->ComissionDetails->commision_value))
                                                            <i class="fa-solid fa-pen-to-square commission-action" style="color: #63E6BE;" data-id="{{$user->id}}"></i>
                                                            @else
                                                            <i class="fa-solid fa-pen-to-square commission-action" style="color: #63E6BE;" data-id="{{$user->id}}"></i>
                                                            @endif
                                                        </a>
                                                    </div>
                                                </li>
                                                <div class="mb-3 commission-setting-div d-none" style="margin-top: 38px;">
                                                    <form id="commissionManageForm" action="#" >
                                                        @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Order Commission Type</label>
                                                                <input type="hidden" name="order_commission_type"  id="checktype" class="checktype"  value="{{ old('order_commission_type', get_admin_setting('order_commission_type') == 'Fixed' ? 'Fixed' : 'Percentage') }}">
                                                                <div class="custm-dropdown">
                                                                    <div class="dropdown checktype">
                                                                        <div class="dropdown-toggle form-control" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                            <div id="selectedcommission">
                                                                                Percentage
                                                                            </div>
                                                                            <span class="custm-drop-icon">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                                                                    <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                        
                                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                            <li><a class="dropdown-item custom_dropdown_commission" data-value="Percentage" data-text="Percentage" href="javascript:void(0)">Percentage</a>
                                                                            </li>
                                                                            <li><a class="dropdown-item custom_dropdown_commission" data-value="Fixed" data-text="Fixed" href="javascript:void(0)">Fixed</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                                                        
                                                            </div>
                                                        </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Order Commission<span class="required-field">*</span></label>
                                                                    <div class="symbol">%</div>
                                                                    <input type="number" id="checkcommission" name="order_commission" class="form-control  two-decimals" value="{{old('order_commission', get_admin_setting('order_commission'))}}">
                                                                    <div class="input-icon-custm tooltip-new">
                                                                        <span data-toggle="tooltip" data-placement="left" title="Set the individual commission for this dealer.">
                                                                            <i class="fa-solid fa-question"></i>
                                                                        </span>
                                                                        <!-- <div class="tooltip-text">
                                                                            <p>Name of package, describe the package and what it offers.</p>
                                                                        </div> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <button class="btn primary-btn float-end" id="submit" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                </form>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-xxl-4 col-xl-12 col-lg-12 col-md-12">
                                        <div class="dealer-last-five-product">
                                            <h3>Recent Products</h3>
                                            <div class="product-detail-table">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th>Part Number</th>
                                                            <th>Stocks</th>
                                                            <th>Price</th>
                                                            <th>Category</th>
                                                        </tr>
                                                        @foreach ($products as $product)
                                                        <tr>
                                                            <td>{{$product->part_number ?? ''}}</td>
                                                            <td>{{$product->stocks_avaliable ?? ''}}</td>
                                                            <td> @if($product && is_numeric($product->price))
                                                                ${!! number_format((float) $product->price, 2, '.', ',') !!}
                                                            @else
                                                                N/A
                                                            @endif</td>
                                                            <td>{{ $product && $product->category ? $product->category->name : '' }}</td>
                                                        </tr>  
                                                        @endforeach
                                                        {{-- <tr>
                                                            <td>vejbjk</td>
                                                            <td>2</td>
                                                            <td>500</td>
                                                            <td><a href="#" class="btn primary-btn small-btn"><i class="fa-solid fa-eye"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>vejbjk</td>
                                                            <td>2</td>
                                                            <td>500</td>
                                                            <td><a href="#" class="btn primary-btn small-btn"><i class="fa-solid fa-eye"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>vejbjk</td>
                                                            <td>2</td>
                                                            <td>500</td>
                                                            <td><a href="#" class="btn primary-btn small-btn"><i class="fa-solid fa-eye"></i></a></td>
                                                        </tr> --}}
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <div class="form-field">

                                                {{ $user->name ? $user->name : 'N/A' }}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <div class="form-field">
                                                {{ $user->email ? $user->email : 'N/A' }}


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <div class="form-field">
                                                {{ $user->phone_number ? $user->phone_number : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Industry</label>
                                            <div class="form-field">
                                                {{ $user->industry_type ? $user->industry_type : 'N/A' }}


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <div class="form-field">
                                                {{ $user->address ? $user->address : 'N/A' }}


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Zipcode</label>
                                            <div class="form-field">
                                                {{ $user->zipcode ? $user->zipcode : 'N/A' }}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Commission</label>
                                            <div class="form-field">
                                                @if (isset($user->ComissionDetails->commision_value))
                                                    {{ $user->ComissionDetails->commision_value }}{{ $user->ComissionDetails->commision_type == 'Percentage' ? '%' : '$' }}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Commission Action</label>
                                            <div class="form-field">
                                                <a class="btn primary-btn"
                                                    href="{{ route('admin.commission', ['dealer_id' => jsencode_userdata($user->id)]) }}">
                                                    @if (isset($user->ComissionDetails->commision_value))
                                                        edit
                                                    @else
                                                        add
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-md-12">
                                        <div class="dealer-profile-form-btn">
                                            <a class="btn primary-btn " href="{{ url()->previous() }}">Back</a>

                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
 jQuery(document).ready(function () {
    // Handle the commission action click
    jQuery('.commission-action').on('click', function () {
        jQuery('.commission-setting-div').toggleClass('d-none');
        // jQuery('.commission-setting-div').removeClass('d-none');
        window.user_id = jQuery(this).data('id'); // Store user_id globally
        console.log(window.user_id);
    });

    // Restrict the number of decimal places to 2
    $(".two-decimals").on("keypress", function (evt) {
        var txtBox = $(this);
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
            return false;
        } else {
            var len = txtBox.val().length;
            var index = txtBox.val().indexOf('.');
            if (index > 0 && charCode == 46) {
                return false;
            }
            if (index > 0) {
                var charAfterDot = (len + 1) - index;
                if (charAfterDot > 3) {
                    return false;
                }
            }
        }
        return true;
    });

    // change symbols
    var type = $('.checktype').val();
        if (type == 'Percentage') {
            $('.symbol').text('%');
        } else {
            $('.symbol').text('$');
        }
        $('.checktype').on('click', function() {
            var type = $('.checktype').val();
            if (type == 'Percentage') {
                $('.symbol').text('%');
            } else {
                $('.symbol').text('$');
            }
        });
console.log(type);
    // Handle custom dropdown selection
    jQuery('.custom_dropdown_commission').on('click', function () {
        var selectItem = jQuery(this).data('value');
        var selectText = jQuery(this).data('text');
        jQuery('#selectedcommission').text(selectText);
        jQuery('input[name="order_commission_type"]').val(selectItem);
    });

    // Validate the form
    $("#commissionManageForm").validate({
        rules: {
            order_commission_type: {
                required: true
            },
            order_commission: {
                required: true,
                number: true, // Use `number` instead of `decimal` for numeric validation
                min:1,
                max:99
            }
        },
        messages: {
            order_commission_type: {
                required: `{{ __('customvalidation.commission.ordercommission_type.required') }}`
            },
            order_commission: {
                required: `{{ __('customvalidation.commission.ordercommission.required') }}`,
                number: "Please enter a valid number.",
                number: "Please enter a valid number.",
                min:"The commission must be at least 1.",
                max:"The commission must not exceed 99.",
            }
        },
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            error.insertAfter(element);
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function (form) {
            var formData = $(form).serialize();
            console.log(window.user_id);
            var url = APP_URL + '/admin/commission/manage/' + window.user_id;
            console.log(url);
            const result = ajaxCall(url, 'post', formData, true);
            result.then(handlecommissionManageSuccess).catch(handlecommissionManageError)
        }
    });

    function handlecommissionManageSuccess(response) {
        console.log('handleShippingData', response);
        if(response.status){
            console.log(response.type);
            if(response.type == '%'){
            jQuery('.commission-value').text(response.data + response.type);
            }else{
            jQuery('.commission-value').text(response.type + response.data);
            }
            jQuery('.commission-setting-div').addClass('d-none');
            toastr.success(response.message);

        }
    }

    function handlecommissionManageError(error) {
        console.log('handleShippingError', error);
    }
});

    </script>
@endpush