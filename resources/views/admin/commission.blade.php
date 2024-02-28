@extends('layouts.admin')
@section('title', 'commision')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-12">
                        <div class="card">
                            <div class='ajax-response'></div>
                            <x-alert-component />
                            <div class="card-header">
                                <h4>Commision</h4>
                            </div>
                            <div class="card-body">
                                <form id="commission" action="{{ route('admin.commission', [$commission->id]) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Order Commission Type</label>
                                        <select id="checktype" name="ordercommission_type"
                                            class="form-control @error('ordercommission_type') is-invalid @enderror">
                                            <option value="Percentage" @if ($commission->type == 'Percentage') selected @endif>
                                                Percentage
                                            </option>
                                            <option value="Fixed" @if ($commission->type == 'Fixed') selected @endif>Fixed
                                            </option>
                                        </select>
                                        @error('ordercommission_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Order Commission<span class="required-field">*</span></label>
                                        <input type="text" id="checkcommission" name="ordercommission"
                                            class="form-control @error('ordercommission') is-invalid @enderror"
                                            value="{{ old('name', $commission->value) }}">

                                        @error('ordercommission')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="card-footer text-right">
                                        <a class="btn btn-danger mr-1" href="{{ route('admin.commission') }}">Back</a>
                                        <button class="btn btn-primary mr-1" id="submit">Submit</button>
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
    @includeFirst(['validation.js_commision'])
@endpush
