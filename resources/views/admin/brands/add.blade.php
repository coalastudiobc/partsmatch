@extends('layouts.admin')
@section('title', 'shipping')
@section('heading', 'shipping')

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
                                <form id="shipping"
                                    action="{{ route('admin.brands.store', ['id' => json_encode($makes->id)]) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="range_to">Brand</label>
                                                <div class="form-field">
                                                    <input disabled class="form-control" id="makeId" name="makeId"
                                                        placeholder="year" value="{{ $makes->makes }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="range_to">icon</label>
                                                <div class="form-field">
                                                    <input class="form-control" name="makeicon" placeholder="range_to"
                                                        type="file">
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <a class="btn secondary-btn full-btn mr-1"
                                                href="{{ route('admin.brands.listing') }}">Back</a>
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