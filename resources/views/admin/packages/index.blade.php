@extends('layouts.admin')

@section('title', 'Subscription Plans')
@section('heading', 'Subscription Plans')

@section('content')
    <div class="dashboard-right-box">
        <x-alert-component />

        <div class="card-header-form padding">
            {{-- <h2>Subscription Plans</h2> --}}
            {{-- <x-search-form :dateField="false" /> --}}
            <a class="btn   primary-btn" href="{{ route('admin.packages.add') }}">Add
                Subscription Plan</a>
        </div>
        <div class="product-detail-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Name</p>
                        </th>
                        <th>
                            <p>Price</p>
                        </th>
                        <th>
                            <p>Price Id</p>
                        </th>
                        <th>
                            <p>Subscription Plan Id</p>
                        </th>
                        <th>
                            <p>Status</p>
                        </th>
                        <th>
                            <p>Action</p>
                        </th>

                    </tr>
                    @forelse($packages as $key=> $package)
                        <tr>
                            <td>{{ $package->name ? ucFirst($package->name) : '' }}</td>
                            <td>{{ $package->price ? "$" . $package->price : '' }}</td>
                            <td>{{ $package->stripe_price ? $package->stripe_price : '' }}</td>
                            <td>{{ $package->stripe_id ? $package->stripe_id : '' }}</td>
                            <td>
                                {{-- <label>
                                    <input type="checkbox" class="custom-switch-input"
                                        @if ($package->status == '1') checked="checked" @endif
                                        onchange="toggleStatus(this, 'Package', '{{ jsencode_userdata($package->id) }}');">
                                    <span class="custom-switch-indicator"></span>
                                </label> --}}

                                <div class="toggle-btn">
                                    <input type="checkbox" id="switch11{{ $key }}" class="custom-switch-input"
                                        @if ($package->status == '1') checked="checked" @endif
                                        onchange="toggleStatus(this, 'Package', '{{ $package->id }}');"
                                        url="{{ route('package.status') }}"><label
                                        for="switch11{{ $key }}">Toggle</label>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.packages.edit', [jsencode_userdata($package->id)]) }}"><i
                                            class="fa-solid fa-pen-to-square" style="color: #3EBE62;"
                                            title="edit"></i></a>
                                    <a href="{{ route('admin.packages.delete', [jsencode_userdata($package->id)]) }}"><i
                                            class="fa-regular fa-trash-can" style="color: #E13F3F;" title="delete"></i></a>
                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="no-record-found">
                                <center>Did not found any subscription plan</center>
                            </td>
                        </tr>
                    @endforelse
                </table>
                {{-- <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        {!! $packages->links('admin.pagination') !!}
                    </nav>
                </div> --}}
            </div>
        </div>
    </div>


@endsection
