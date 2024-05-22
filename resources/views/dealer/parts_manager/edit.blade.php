@extends('layouts.dealer')
@section('title', 'edit')
@section('heading', 'edit')

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
                                <form id="parts_manager" action="{{ route('dealer.partsmanager.update', [$user->id]) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
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
                                        </div>

                                        <div class="col-md-6">
                                            <a href="{{ route('dealer.partsmanager.index') }}"
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
@endsection

@push('scripts')
    @includeFirst(['validation.dealer.js_parts_manager'])
@endpush
