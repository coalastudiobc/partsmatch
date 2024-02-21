@extends('layouts.admin')

@section('title', 'Subscription Plans')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <x-alert-component />
                        <div class="card">
                            <div class="card-header right-align-btn-sub">
                                <h4>Subscription Plans</h4>
                                {{-- <x-search-form :dateField="false" />  --}}
                                <a class="btn btn-primary header-cart-btm" href="{{ route('admin.packages.add') }}">Add Subscription Plan</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tr>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Price Id</th>
                                            <th>Subscription Plan Id</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>                                        
                                        @forelse($packages as $package)
                                        <tr>
                                            <td>{{ $package->name ? ucFirst($package->name) : "" }}</td>
                                            <td>{{ $package->price ? "$".$package->price : "" }}</td>
                                            <td>{{ $package->stripe_price ? $package->stripe_price : "" }}</td>
                                            <td>{{ $package->stripe_id ? $package->stripe_id : "" }}</td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" class="custom-switch-input" @if ($package->status == '1') checked="checked" @endif onchange="toggleStatus(this, 'Package', '{{ jsencode_userdata($package->id) }}');">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.packages.edit', [jsencode_userdata($package->id)]) }}" class="btn btn-primary">Edit</a>
                                                <a href="{{ route('admin.packages.delete', [jsencode_userdata($package->id)]) }}" class="btn btn-danger delete">Delete</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="no-record-found">
                                                <center>Did not found any product</center>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </table>
                                    <div class="card-footer text-right"> 
                                        <nav class="d-inline-block">           
                                            {!! $packages->links('admin.pagination') !!}
                                         </nav> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection