@extends('layouts.admin')
@section('title', $package->id ? 'Update Subscription Plan' : 'Add Subscription Plan')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-12">
                        <div class="card">
                            <div class='ajax-response'></div>
                            <x-alert-component />
                            <div class="card-header">
                                <h4>{{ $package->id ? 'Update Subscription Plan' : 'Add Subscription Plan' }}</h4>
                            </div>
                            <div class="card-body">
                                <form id="package" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Name<span class="required-field">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $package->name ?? $package->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Price<span class="required-field">*</span></label>
                                            <div class="doller-input-field">
                                            <input type="text" name="price"
                                                class="form-control two-decimals @error('price') is-invalid @enderror"
                                                value="{{ old('price', $package->price ?? $package->price) }}">
                                                <span class="doller-symbol-txt">$</span>
                                            </div>
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    {{-- @dd($package) --}}
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Type<span class="required-field">*</span></label>
                                            <select name="time_type"
                                                class="form-control @error('time_type') is-invalid @enderror" >
                                                <option value="{{ jsencode_userdata('year') }}" @if ($package->billing_cycle == 'ANNUALLY	')selected @endif>Yearly </option>
                                                <option value="{{ jsencode_userdata('month') }}" @if ($package->billing_cycle == 'MONTHLY')selected @endif>Monthly</option> 
                                                {{-- <option value="QUATERLY"@if ($package->time_type == '2')selected @endif>Days</option> --}}
                                            </select>
                                            @error('time_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Status</label>
                                            <select name="status"
                                                class="form-control @error('status') is-invalid @enderror">
                                                <option value="1">Select </option>
                                                <option value="1" @if ($package->status == '1') selected @endif>
                                                    Active</option>
                                                <option value="0"@if ($package->status == '0') selected @endif>
                                                    Inactive</option>
                                            </select>
                                            @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Description</label>
                                            <textarea class="form-control summernote @error('description') is-invalid @enderror" name="description">{{ $package->description ?? $package->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <a class="btn btn-primary mr-1"
                                        href="{{ route('admin.packages.all') }}">Back</a>
                                        <button class="btn btn-primary " id="submit">Submit</button>
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
        jQuery(document).ready(function() {
            jQuery('#submit').click(function(e) {
                e.preventDefault();
                if (jQuery('#package').valid()) {
                    var formData = new FormData($('form#package').get(0));
                    url =
                        "{{ $package->id ? route('admin.packages.store', [jsencode_userdata($package->id)]) : route('admin.packages.store') }}";
                    var response = ajaxCall(url, 'post', formData);
                    response.then(handlePackage).catch(handlePackageError)

                    function handlePackage(response) {
                        if (response.success == true && response.url) {

                            window.location.replace(response.url);

                        } else if (response.success == false) {
                            if ('errortype' in response && response.errortype) {
                                var response_ajax = jQuery(document).find(".ajax-response-" + response
                                    .errortype);
                            } else {
                                var response_ajax = jQuery(document).find(".ajax-response");
                                $("html, body").animate({
                                    scrollTop: 0
                                }, "fast");
                            }
                            response_ajax.html(
                                '<div class="alert alert-danger alert-dismissible fade show k" role="alert">' +
                                response.msg +
                                '<button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                                );
                        }
                    }

                    function handlePackageError(error) {
                        console.log('error', error)
                    }
                }
            });
        });
        // $(document).ready(function() {
        //     $('.summernote').summernote();
        // });
    </script>
@endpush
