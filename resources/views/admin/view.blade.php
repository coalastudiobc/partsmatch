@extends('layouts.admin')
@section('title', 'profile')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <x-alert-component />
                                <div class="invoice-title">
                                    <h2> {{ $user->name ? ucFirst($user->name) : '' }} </h2>
                                    <div class="invoice-number"><img
                                            src="{{ !is_null($user->profile_url) ? Storage::url($user->profile_url) : asset('assets/img/default.png') }}"
                                            width="50px" height="50px" style="object-fit: cover;border-radius: 50px;">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Email:</strong><br>
                                            {{ $user->email }}
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>Status:</strong><br>
                                            {{ $user->status ? 'Active' : 'Inactive' }}
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>Country:</strong><br>
                                            {{ $user->country ?? '' }}
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="text-md-right">
                        @if ($user->hasRole(['Administrator']))
                            <div class="float-lg-left mb-lg-0 mb-3">
                                <a href=" {{ $user->hasRole(['Administrator']) ? route('admin.edit') : route('admin.users.edit', [jsencode_userdata($user->id)]) }}"
                                    class="btn btn-primary">Edit</a>
                            </div>
                        @endif
                        <a class="btn btn-success" href="{{ url()->previous() }}"> Back</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
