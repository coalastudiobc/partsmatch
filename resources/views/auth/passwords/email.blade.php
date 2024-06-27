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
                        <p>It is a long established fact that a reader will be distracted by</p>
                    </div>
                    <div class="login-form">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form id="send_email" method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email or Phone Number</label>
                                <div class="form-field">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" autofocus
                                        placeholder="Enter Email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="input-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="15"
                                            viewBox="0 0 21 15" fill="none">
                                            <path
                                                d="M17.9402 14.474H2.36945C1.74104 14.474 1.13836 14.2243 0.693997 13.78C0.249638 13.3356 0 12.7329 0 12.1045V2.36946C0 1.74104 0.249638 1.13836 0.693997 0.693997C1.13836 0.249638 1.74104 0 2.36945 0H17.9402C18.5686 0 19.1713 0.249638 19.6156 0.693997C20.06 1.13836 20.3096 1.74104 20.3096 2.36946V12.1045C20.3096 12.7329 20.06 13.3356 19.6156 13.78C19.1713 14.2243 18.5686 14.474 17.9402 14.474ZM2.36945 1.35397C2.10013 1.35397 1.84184 1.46096 1.6514 1.6514C1.46096 1.84184 1.35397 2.10013 1.35397 2.36946V12.1045C1.35397 12.3739 1.46096 12.6321 1.6514 12.8226C1.84184 13.013 2.10013 13.12 2.36945 13.12H17.9402C18.2095 13.12 18.4678 13.013 18.6582 12.8226C18.8486 12.6321 18.9556 12.3739 18.9556 12.1045V2.36946C18.9556 2.10013 18.8486 1.84184 18.6582 1.6514C18.4678 1.46096 18.2095 1.35397 17.9402 1.35397H2.36945Z"
                                                fill="#727272" />
                                            <path
                                                d="M10.1551 6.4087C9.62566 6.40931 9.10526 6.27162 8.6454 6.00928L1.0293 1.94736L1.66566 0.755859L9.30208 4.81778C9.55775 4.96383 9.8471 5.04064 10.1415 5.04064C10.436 5.04064 10.7253 4.96383 10.981 4.81778L18.631 0.755859L19.2673 1.94736L11.6309 6.00928C11.182 6.26826 10.6734 6.40592 10.1551 6.4087Z"
                                                fill="#727272" />
                                        </svg>
                                    </div>
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
    @includeFirst(['validation.js_email'])
@endpush
