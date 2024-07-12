@extends('layouts.dealer')
@section('title', 'edit')
@section('heading', 'Edit Parts Manager')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class='ajax-response'></div>
                            <x-alert-component />
                            
                            <div class="card-body">
                                <form id="parts_manager" action="{{ route(auth()->check() ? auth()->user()->getRoleNames()->first() . '.partsmanager.update':'Dealer.partsmanager.update, [$user->id]) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="upload-img">
                                            <div class="file-upload-box">
                                                <label for="file-upload">
                                                    <div class="profile-main-img">
                                                        <div class="profile-without-img">
                                                        <img src="{{ $user->profile_picture_url ? Storage::url($user->profile_picture_url) : asset('assets/images/user.png') }}" id="Userimage" alt="">
                                                        </div>

                                                        <div class="upload-icon">
                                                            <img src="{{ asset('assets/images/upload.png') }}"
                                                                alt="">

                                                        </div>
                                                    </div>
                                                </label>
                                                <input type="file" name="image" id="file-upload"
                                                    class="@error('image') is-invalid @enderror">
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                            <h3>Upload profile picture*</h3>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Name*</label>
                                                <div class="form-field">
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', $user->name) }}">
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
                                                <label for="">email*</label>
                                                <div class="form-field">
                                                    <input type="text" name="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email', $user->email) }}">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">phone</label>
                                                <div class="form-field">
                                                    <textarea name="content" class="form-control summernote @error('content') is-invalid @enderror"></textarea>
                                                    @error('content')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">phone*</label>
                                                <div class="form-field">
                                                    <input type="text" name="phone_number"
                                                        class="form-control @error('phone_number') is-invalid @enderror"
                                                        value="{{ old('phone_number', $user->phone_number) }}">
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
                                                <label for="">role</label>
                                                <div class="form-field">
                                                    <input type="text" name="role"
                                                        class="form-control @error('role') is-invalid @enderror"
                                                        value="{{ old('page_title') }}">
                                                    @error('role')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">role</label>
                                                <div class="form-field">
                                                    <input type="text" name="role"
                                                        class="form-control @error('role') is-invalid @enderror"
                                                        value="{{ old('page_title') }}">
                                                    @error('role')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Image</label>
                                                <div class="form-field">
                                                    <input type="file" name="editimage"
                                                        class="form-control @error('image') is-invalid @enderror">
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Password">Password</label>
                                                <div class="form-field">
                                                    <input type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror">
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
                                                    <input type="password" name="confirm_password"
                                                        class="form-control @error('confirm_password') is-invalid @enderror">
                                                    @error('confirm_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route(auth()->user()->getRoleNames()->first() . '.partsmanager.index') }}"
                                                class="btn secondary-btn full-btn mr-1">Back</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn primary-btn full-btn mr-1" id="submit"
                                                type="submit">Submit</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var fileUpload = document.getElementById('file-upload');
            var userImage = document.getElementById('Userimage');
            // var fileUploadError = document.getElementById('file-upload-error');

            fileUpload.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        userImage.setAttribute('src', e.target.result);
                    };
                    // fileUploadError.style.display = 'none';
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endsection
