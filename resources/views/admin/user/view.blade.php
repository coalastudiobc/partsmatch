@extends('layouts.admin')

@section('title', 'User')
@section('heading', 'Dealer')

@section('content')
    <div class="main-content">
        <section class="page-content-sec">
            <div class="container">
                <div class="page-content-wrapper">
                    <div class="dealer-profile-box">
                        <div class="dealer-profile-content">
                            <div class="dealer-profile-form-box">
                                <div class="dealer-profile-detail-form">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="dealer-profile-upload-box">
                                                    <div class="upload-img">
                                                        <div class="file-upload-box">
                                                            <label for="file-upload">
                                                                <div class="profile-without-img">
                                                                    <img src="{{ !is_null($user->profile_picture_url) ? asset('storage/' . $user->profile_picture_url) : asset('admin/assets/img/users/user-1.png') }}"
                                                                        alt="">
                                                                    {{-- <div class="upload-icon"> --}}
                                                                    {{-- <i class="fa-sharp fa-solid fa-pen"></i> --}}
                                                                    {{-- </div> --}}
                                                                </div>
                                                                {{-- <input type="file" id="file-upload"> --}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <div class="form-field">

                                                        {{ $user->name ? $user->name : 'N/A' }}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <div class="form-field">
                                                        {{ $user->email ? $user->email : 'N/A' }}


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Phone Number</label>
                                                    <div class="form-field">
                                                        {{ $user->phone_number ? $user->phone_number : 'N/A' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Industry</label>
                                                    <div class="form-field">
                                                        {{ $user->industry ? $user->industry : 'N/A' }}


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <div class="form-field">
                                                        {{ $user->address ? $user->address : 'N/A' }}


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Zipcode</label>
                                                    <div class="form-field">
                                                        {{ $user->zipcode ? $user->zipcode : 'N/A' }}

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                {{-- <div class="dealer-profile-form-btn">
                                                    <a href="#" class="btn primary-btn">Send Message</a>
                                                </div> --}}
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Start -->
                <!-- End -->
        </section>
    </div>
@endsection
