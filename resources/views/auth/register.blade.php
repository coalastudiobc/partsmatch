@extends('layouts.front')
@section('title', 'register')

@section('content')
    @if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif
    <div class="signup-sec">
        <div class="container">
            <div class="signup-wrapper">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <div class="signup-img-txt">
                            <img src="{{ asset('assets/images/sign-up-img.png') }}" alt="">
                            <h2>Buy Or sell any spare part At best Price</h2>
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
                                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="upload-img">
                                        <div class="file-upload-box">
                                            <label for="file-upload">
                                                <div class="profile-without-img">
                                                    <img src="{{ asset('assets/images/user.png') }}" id="Userimage"
                                                        alt="">
                                                    <div class="upload-icon">
                                                        <img src="{{ asset('assets/images/upload.png') }}" alt="">
                                                    </div>
                                                </div>
                                                <input type="file" id="file-upload" value="" name="image">
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </label>
                                        </div>
                                        <h3>Upload profile picture</h3>
                                    </div>
                                    {{-- <div class="sign-up-form">
                                <form action=""> --}}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Name</label>
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
                                                <label for="">Email</label>
                                                <div class="form-field">
                                                    <input type="email" name="email" value="{{ old('email') }}"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="Email ID">

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
                                                <label for="">Phone</label>
                                                <div class="form-field">
                                                    <input type="text" name="phone_number"
                                                        value="{{ old('phone_number') }}"
                                                        class="form-control @error('phone_number') is-invalid @enderror"
                                                        placeholder="phone_number">

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
                                                <label for="">Complete Address</label>
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
                                                <label for="">Zip Code</label>
                                                <div class="form-field">
                                                    <input type="text" name="zipcode" value="{{ old('zipcode') }}"
                                                        class="form-control @error('zipcode') is-invalid @enderror"
                                                        placeholder="Zip code">

                                                    @error('zipcode')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Select industry</label>
                                                <div class="form-field">
                                                    <select name="industry_type" id="industury" class="form-control" >
                                                        <option value="volvo">Select industry</option>
                                                        <option value="saab">Volvo</option>
                                                        <option value="saab">Saab</option>
                                                        <option value="opel">Opel</option>
                                                        <option value="audi">Audi</option>
                                                      </select>
                                                    {{-- <input type="text" name="industry_type" value="{{ old('industry_type') }}"
                                                        class="form-control @error('industry_type') is-invalid @enderror"
                                                        placeholder="Select industry"> --}}

                                                    @error('industry_type')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Password</label>
                                                <div class="form-field">
                                                    <input type="password" name="password" value="{{ old('password') }}"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="**********">

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
                                                <label for="">Confirm Password</label>
                                                <div class="form-field">
                                                    <input type="password" name="password_confirmation"
                                                        value="{{ old('password_confirmation') }}"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        placeholder="**********">

                                                    @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn secondary-btn full-btn">Submit</button>
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
    <script>
        $("#file-upload").change(function() {
            console.log(this.files);
            if (this.files && this.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#Userimage').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endpush
