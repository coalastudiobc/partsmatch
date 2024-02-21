@extends('layouts.front')

@section('title', 'Login')

@section('content')
@if (Session::has('message'))
    <h5 class=" {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</h5>
@endif
<h4>{{ __('Login') }}</h4>
<form class="login-form" action="{{ route('login') }}" method="POST">
    @csrf
    <div class="input-box">
        <div class="form-group">
            <label>{{ __('Email') }}</label>
            <div class="formfield">
                <input type="email" id="email" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ old('email') }}">
                <span class="form-icon ">
                    <i class="fa-solid fa-envelope"></i>
                </span>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('Password') }}</label>
            <div class="formfield">
                <input  id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                <span class="form-icon">
                    <i class="fa-solid fa-lock"></i>
                </span>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <button type="submit" class="button primary-btn full-btn">{{ __('Login') }}</button>
</form>

   
@endsection
