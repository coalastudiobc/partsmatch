@extends('layouts.admin')
@section('title', 'Settings')
@section('heading', 'Stripe Settings')

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
                                <h4>Stripe setting</h4>
                            </div>
                            <div class="card-body">
                                <form id="settings" action="{{ route('admin.settings.update') }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-row">
                                            <div class="form-group col-12">
                                                <label>Stripe id<span class="required-field">*</span></label>
                                                <input type="text" name="stripe_key"
                                                    class="form-control @error('stripe_key') is-invalid @enderror"
                                                    value="{{ old('stripe_key', get_admin_setting('stripe_key')) }}">
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
                                                    value="{{ old('secret_key', get_admin_setting('secret_key')) }}">
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
                                        <div class="text-right">
                                            <button class="btn btn-primary mr-1" id="submit">Submit</button>
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
    @includeFirst(['validation.js_settings'])
@endpush
