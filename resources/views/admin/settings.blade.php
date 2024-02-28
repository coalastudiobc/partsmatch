@extends('layouts.admin')
@section('title', 'Settings')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-6">
                        <div class="card ">
                            <div class='ajax-response'></div>
                            <x-alert-component />
                            <div class="card-header">
                                <h4>Stripe setting</h4>
                            </div>
                            <div class="card-body ">
                                <form id="settings" action="{{ route('admin.settings.update') }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <fieldset>
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label>Stripe id<span class="required-field">*</span></label>
                                                <input type="text" name="stripe_key"
                                                    class="form-control @error('stripe_key') is-invalid @enderror"
                                                    value="{{ old('stripe_key', get_admin_setting('stripe_key', 1)) }}">
                                                @error('stripe_key')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row ">
                                            <div class="form-group col-12 ">
                                                <label>Secret key <span class="required-field">*</span></label>
                                                <input type="text" name="secret_key"
                                                    class="form-control @error('secret_key') is-invalid @enderror"
                                                    value="{{ old('secret_key', get_admin_setting('secret_key', 1)) }}">
                                                @error('secret_key')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-row ">
                                            <div class="form-group col-12 ">
                                                <label>Webhook secret <span class="required-field">*</span></label>
                                                <input type="text" name="webhook_secret"
                                                    class="form-control @error('webhook_secret') is-invalid @enderror"
                                                    value="{{ old('webhook_secret', get_admin_setting('webhook_secret')) }}">
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" id="submit">Submit</button>
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
    @includeFirst(['validation.js_settings'])
    {{-- <script>
        $(document).ready(function() {
            jQuery('#submit').click(function(e) {
                jQuery(this).attr('disabled', true)
                e.preventDefault();
                if (jQuery('#settings').valid()) {
                    var formData = new FormData($('form#settings').get(0));
                    // var url = "";
                    // // var response = ajaxCall(url, 'post', formData);
                    // response.then(handleSettings).catch(handleSettingsError)

                    // function handleSettings(response) {
                    //     if (response.success == true && response.url) {

                    //         window.location.replace(response.url);

                    //     } else if (response.success == false) {

                    //         // jQuery(document).find('input[name="secret_key"]').parent().append(response
                    //         //     .message);
                    //         if ('errortype' in response && response.errortype) {
                    //             console.log(response.errortype);
                    //             var response_ajax = jQuery(document).find(".ajax-response-" + response
                    //                 .errortype);
                    //         } else {
                    //             var response_ajax = jQuery(document).find(".ajax-response");
                    //             $("html, body").animate({
                    //                 scrollTop: 0
                    //             }, "fast");
                    //         }
                    //         response_ajax.html(
                    //             '<div class="alert alert-danger alert-dismissible fade show k" role="alert">' +
                    //             response.msg +
                    //             '<button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    //         );
                    //     }
                    // }

                    // function handleSettingsError(error) {
                    //     console.log('error', error)
                    // }
                }


            });
        });
    </script> --}}
@endpush
