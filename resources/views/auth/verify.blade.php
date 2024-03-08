@extends('layouts.front')
@section('title', 'login')
@section('content')
    <div class="login-sec">
        <div class="container">
            <div class="login-wrapper">
                <div class="login-box">
                    <div class="logo-box">
                        <img src="{{ asset('assets/images/header-logo.png') }}" alt="">
                    </div>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <div class="login-txt">
                        <h2>verification</h2>
                        <p>please verify your email</p>
                    </div>
                    <div class="login-form">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn secondary-btn full-btn">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <img class="login-bg-img" src="{{ asset('assets/images/login-img1.png') }}" alt="">
        <img class="login-bg-img right" src="{{ asset('assets/images/login-img2.png') }}" alt="">
    </div>
@endsection

