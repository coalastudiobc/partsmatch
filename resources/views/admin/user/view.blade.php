@extends('layouts.admin')

@section('title', 'User')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-9 col-sm-9 col-lg-9">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">

                                <img alt="image"
                                    src="{{ !is_null($user->profile_picture_url) ? asset('storage/' . $user->profile_picture_url) : asset('admin/assets/img/users/user-1.png') }}"
                                    class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Name</div>
                                        <div class="profile-widget-item-value">{{ $user->name }}</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Email</div>
                                        <div class="profile-widget-item-value">{{ $user->email }}</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Number</div>
                                        <div class="profile-widget-item-value">
                                            {{ $user->phone_number }}
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Address</div>
                                        <div class="profile-widget-item-value">{{ $user->address }}</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Zipcode</div>
                                        <div class="profile-widget-item-value">{{ $user->zipcode }}</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label"></div>
                                        <div class="profile-widget-item-value">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer_row">
                                <div class="card-footer text-left">
                                    <a class="btn btn-danger mr-1" href="{{ url()->previous() }}">Back</a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
