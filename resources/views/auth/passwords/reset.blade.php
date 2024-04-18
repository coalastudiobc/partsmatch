@extends('layouts.front')

@section('content')
    <div class="login-sec">
        <div class="container">
            <div class="login-wrapper">
                <div class="login-box">
                    <div class="logo-box">
                        <img src="{{ asset('assets/images/header-logo.png') }}" alt="">
                    </div>
                    <div class="login-txt">
                        <h2>Reset Password</h2>
                    </div>
                    <div class="login-form">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="reset_password" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <label for="email">{{ __('Email Address') }}</label>
                                <div class="form-field">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $email ?? old('email') }}" disabled autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <div class="form-field">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">{{ __('Confirm Password') }}</label>
                                <div class="form-field">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn secondary-btn full-btn">Send Password Reset Link</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <img class="login-bg-img" src="{{ asset('assets/images/login-img1.png') }}" alt="">
        <img class="login-bg-img right" src="{{ asset('assets/images/login-img2.png') }}" alt="">
    </div>
@endsection
@push('scripts')
    @includeFirst(['validation'])
    @includeFirst(['validation.js_reset'])
@endpush
