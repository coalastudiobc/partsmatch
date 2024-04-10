@extends('layouts.admin')
@section('title', 'commision')
@section('heading', 'Commision')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-12">
                        <div class="card">
                            <div class='ajax-response'></div>
                            <x-alert-component />
                            {{-- <div class="card-header">
                                <h4>Commision</h4>
                            </div> --}}
                            <div class="card-body">

                                <form id="commission" action="{{ route('admin.commission', [$commission->id]) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group">
                                            <label>Order Commission Type</label>
                                            <select id="checktype" name="ordercommission_type"
                                                class="form-control @error('ordercommission_type') is-invalid @enderror">
                                                <option value="Percentage"
                                                    @if ($commission->type == 'Percentage') selected @endif>
                                                    Percentage
                                                </option>
                                                <option value="Fixed" @if ($commission->type == 'Fixed') selected @endif>
                                                    Fixed
                                                </option>
                                            </select>
                                            @error('ordercommission_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="input-icon-custm tooltip-open">
                                                <span>
                                                    <i class="fa-solid fa-question"></i>
                                                </span>
                                                <div class="tooltip">
                                                    <p>ghfvjvhm</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Order Commission<span class="required-field">*</span></label>
                                            <div class="symbol"></div>
                                            <input type="text" id="checkcommission" name="ordercommission"
                                                class="form-control @error('ordercommission') is-invalid @enderror"
                                                value="{{ old('name', $commission->value) }}">

                                            @error('ordercommission')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="input-icon-custm tooltip-open">
                                                <span>
                                                    <i class="fa-solid fa-question"></i>
                                                </span>
                                                <div class="tooltip">
                                                    <p>ghfvjvhm</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <a class="btn secondary-btn full-btn mr-1"
                                                href="{{ route('admin.commission') }}">Back</a>
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
    @includeFirst(['validation.js_commision'])
    <script>
        $(document).ready(function() {
            var type = $('#checktype').val();

            if (type == 'Percentage') {
                $('.symbol').text('%');

            } else {
                $('.symbol').text('$');
            }
            $('#checktype').on('click', function() {
                var type = $('#checktype').val();
                if (type == 'Percentage') {
                    $('.symbol').text('%');

                } else {
                    $('.symbol').text('$');
                }
            })

        });
    </script>
@endpush
