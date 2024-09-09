@extends('layouts.front')
@section('content')
    {{-- @if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif --}}
    <div class="signup-sec">
        <div class="container">
            <div class="signup-wrapper">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="signup-img-txt">
                            <img src="{{ asset('assets/images/sign-up-img.png') }}" alt="">
                            <h2>The Right Part for the Right Price Every Time</h2>
                            <p>It is a long established fact that a reader will be distracted by the readable content of a
                                page when looking at its layout.</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="sign-up-card">
                            <div class="sign-up-process">
                                <div class="sign-up-process-box active">
                                    <p>1</p>
                                </div>
                                <div class="sign-up-process-box">
                                    <p>2</p>
                                </div>
                            </div>
                            <div class="sign-up-txt">
                                <h2>Sign Up</h2>
                                <p>It is a long established fact that a reader will be distracted by</p>
                            </div>
                            <div class="sign-up-form">
                                <form id="register" method="POST" action="{{ route('register') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="upload-box">
                                        <div class="upload-img @error('image') is-invalid @enderror">
                                            <div class="file-upload-box">
                                                <label for="file-upload">
                                                    <div class="profile-without-img">
                                                        <img src="{{ asset('assets/images/user.png') }}" id="Userimage"
                                                            alt="">

                                                    </div>
                                                    <input type="file" id="file-upload" value=""
                                                        class="custom_input_image" name="image">

                                                    <div class="upload-icon">
                                                        <img src="{{ asset('assets/images/upload.png') }}" alt="">
                                                    </div>

                                                </label>
                                            </div>
                                            <h3>Upload profile picture*</h3>
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="errorViewer">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Name*</label>
                                                <div class="form-field">
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        placeholder="Name">

                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email*</label>
                                                <div class="form-field">
                                                    <input type="email" name="email" value="{{ old('email') }}"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="Email">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Business name*</label>
                                                <div class="form-field">
                                                    <input type="text" name="dealershipName"
                                                        value="{{ old('dealership_name') }}"
                                                        class="form-control @error('dealershipName') is-invalid @enderror"
                                                        placeholder="Business name">

                                                    @error('dealershipName')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Phone*</label>
                                                <div class="form-field">
                                                    <input type="text" name="phone_number"
                                                        value="{{ old('phone_number') }}"
                                                        class="form-control @error('phone_number') is-invalid @enderror"
                                                        placeholder="Phone number">

                                                    @error('phone_number')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Complete address*</label>
                                                <div class="form-field">
                                                    <input type="text" name="address" value="{{ old('address') }}"
                                                        class="form-control @error('address') is-invalid @enderror"
                                                        placeholder="Address">

                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=""> Zip/ Postal Code*</label>
                                                <div class="form-field custm-error-field">
                                                    <select name="zipcode" id="zipcode" class="form-control @error('zipcode') is-invalid @enderror">
                                                    </select>
                                                    @error('zipcode')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
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
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Industry*</label>
                                                <div class="form-field">
                                                    <input type="hidden" id="industry" name="industry_type"
                                                        class="custom_input @error('industry_type') is-invalid @enderror"
                                                        value="">
                                                    @error('industry_type')
                                                        <span id="Viewererror" class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="custm-dropdown">
                                                        <div class="dropdown">
                                                            <div class="dropdown-toggle" type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <div id="selectedItem">
                                                                    Industry
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
                                                            <ul class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item custom_dropdown_item"
                                                                        data-value="Franchise Dealership"
                                                                        href="javascript:void(0)">Franchise Dealership</a>
                                                                </li>
                                                                <li><a class="dropdown-item custom_dropdown_item"
                                                                        data-value="Collision Center" href="javascript:void(0)">Collision Center
                                                                    </a>
                                                                </li>
                                                                <li><a class="dropdown-item custom_dropdown_item"
                                                                        data-value="Body Shop"
                                                                        href="javascript:void(0)">Body Shop
                                                                    </a>
                                                                    </li>
                                                                <li><a class="dropdown-item custom_dropdown_item"
                                                                        data-value="Repair Shop"
                                                                        href="javascript:void(0)">Repair Shop
                                                                    </a>
                                                                </li>
                                                                <li><a class="dropdown-item custom_dropdown_item"
                                                                        data-value="Surplus Buyer"
                                                                        href="javascript:void(0)">Surplus Buyer
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    {{-- <input type="text" name="industry_type" value="{{ old('industry_type') }}"
                                                        class="form-control @error('industry_type') is-invalid @enderror"
                                                        placeholder="Select industry"> --}}
                                                </div>
                                                <div class="errorViewers"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Password*</label>
                                                <div class="form-field">
                                                    <input id="password" type="password" name="password"
                                                        value="{{ old('password') }}"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="Password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Confirm password*</label>
                                                <div class="form-field">
                                                    <input type="password" name="password_confirmation"
                                                        value="{{ old('password_confirmation') }}"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        placeholder="Password confirmation">

                                                    @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn secondary-btn full-btn">Submit</button>
                                    <div class="sign-up-link-box">
                                        <p>Already have an account?</p>
                                        <a href="{{ route('login') }}">Log In</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @includeFirst(['validation'])
    @includeFirst(['validation.js_register'])
    <script>
      jQuery(document).ready(function(){
        $("#file-upload").change(function() {
            if (this.files && this.files[0]) {

                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#Userimage').attr('src', e.target.result);
                }
                    reader.readAsDataURL(this.files[0]);
            }
            jQuery('.errorViewer').text('');
        });
      });
       
        // $('form#register').on('submit', function(e) {
        //     e.preventDefault();
        //     jQuery('form#register').validate();
        //     if (jQuery('form#register').valid()) {
        //         $(this).unbind('submit').submit();
        //     }
        // });
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery('#zipcode').select2({
                ajax: {
                    url: "{{ route('postal.search') }}", 
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term, // Search query
                            page: params.page || 1 // Pagination (if applicable)
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        console.log(data.results);
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination.more
                            }
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
                placeholder: 'Search for zip/postal',
                tags: false
            });

        
            jQuery('.custom_dropdown_item').on('click', function() {
                var selectitem = jQuery(this).attr('data-value')
                jQuery('#selectedItem').text(selectitem)
                jQuery(document).find('input[name="industry_type"]').val(selectitem);
                jQuery(document).find('input[name="industry_type"]').removeClass('is-invalid');
                jQuery('.errorViewers').text('');
            })
        });
    </script>
@endpush
