@extends('layouts.admin')
@section('title', 'profile settings')
@section('heading', 'profile settings')
@section('content')
    <div class="page-content-wrapper">
        <div class="dealer-profile-box">
            <div class="dealer-profile-content">
                <div class="dealer-profile-form-box">
                    <div class="dealer-profile-detail-form">
                        <span id="editProfile"><i class="fa-sharp fa-solid fa-edit"></i></span>
                        <span id="closeEditProfile" class='d-none'><i class="fa-sharp fa-solid fa-close"></i></span>
                        <form id="adminprofile" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="dealer-profile-upload-box">
                                        <div class="upload-img">
                                            <div class="file-upload-box">
                                                <label for="file-upload">
                                                    <div class="profile-without-img">
                                                        <img src="{{ $authUser->profile_picture_url ? Storage::url($authUser->profile_picture_url) : asset('assets/images/user.png') }}"
                                                            alt="" id="Userimage">
                                                    </div>
                                                    <div class="upload-icon d-none editable">
                                                        <i class="fa-sharp fa-solid fa-pen"></i>
                                                    </div>
                                                    <input type="file" disabled class="d-none disabled-inputs"
                                                        name="image" id="file-upload">
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Name*</label>
                                        <div class="form-field">
                                            <input type="text" name="name"
                                                class="form-control disabled-inputs @error('name') is-invalid @enderror"
                                                placeholder="Enter name" disabled
                                                value="{{ old('name', $authUser->name) }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Email*</label>
                                        <div class="form-field">
                                            <input type="email" name="email"
                                                class="form-control disabled-inputs @error('email') is-invalid @enderror"
                                                placeholder="Enter email" disabled
                                                value="{{ old('email', $authUser->email) }}">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Phone Number</label>
                                        <div class="form-field">
                                            <input type="tel" name="phone_number"
                                                class="form-control disabled-inputs @error('phone_number') is-invalid @enderror"
                                                placeholder="Enter phone number" name="phone_number" disabled
                                                value="{{ old('phone_number', $authUser->phone_number) }}">
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
                                        <label for="">Password</label>
                                        <div class="form-field">
                                            <input type="password" name="password" id="conPassword"
                                                class="form-control disabled-inputs @error('password') is-invalid @enderror"
                                                placeholder="*********" disabled value="{{ old('password') }}">
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
                                        <label for="">Confirm password</label>
                                        <div class="form-field">
                                            <input type="password" name="confirm_password"
                                                class="form-control disabled-inputs @error('confirm_password') is-invalid @enderror"
                                                placeholder="*********" disabled value="{{ old('confirm_password') }}">
                                            @error('confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="dealer-profile-form-btn">
                                        <button class="btn primary-btn d-none editable">Submit</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @includeFirst(['validation.js_admin_profile'])
    <script>
        $(document).ready(function() {
            $('#editProfile').click(function(e) {
                e.preventDefault();
                $(this).addClass('d-none')
                $('#closeEditProfile').removeClass('d-none')
                $('.disabled-inputs').removeAttr('disabled');
                $('.editable').removeClass('d-none');
            });
            $('#closeEditProfile').click(function(e) {
                e.preventDefault();
                $(this).addClass('d-none')
                $('#editProfile').removeClass('d-none')
                $('.disabled-inputs').attr('disabled', 'disabled');
                $('.editable').addClass('d-none');
            });
        });
    </script>
    <script>
        $("#file-upload").change(function() {
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
{{-- @include('layouts.include.footer') --}}
