@extends('layouts.admin')
@section('title', 'Dealers')
@section('heading', 'Dealers')

@section('content')

    <div class="dashboard-right-box">
        <x-alert-component />
        {{-- <h2>Dealers</h2>
        < class=""> --}}
        <div class="serach-and-filter-box">
            <h3></h3>
            <form action="{{ route('admin.dealers.all') }}">
                <div class="pro-search-box">
                    <input type="text" name="filter_by_name" value="{{ old('filter_by_name', request()->filter_by_name) }}"
                        class="form-control" placeholder="Search Dealer By Name">
                    <button type="submit" class="btn primary-btn">Search</button>
                </div>
            </form>

        </div>


        <div class="product-detail-table user-list-table min-width-1200">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Name</p>
                        </th>
                        <th>
                            <p>Email</p>
                        </th>
                        <th>
                            <p>Industry</p>
                        </th>
                        <th>
                            <p>Address</p>
                        </th>
                        <th>
                            <p>Product</p>
                        </th>
                        <th>
                            <p>Status</p>
                        </th>
                        <th>
                            <p>Action</p>
                        </th>
                        {{-- <th>
                            <p>Commision</p>
                        </th> --}}
                    </tr>
                    @forelse ($users as $key => $user)
                        <tr>
                            <td>
                                <p>{{ $user->name ? Str::limit($user->name, 15, '...') : '' }}</p>
                            </td>
                            <td>
                                <p>{{ $user->email ? $user->email : 'N/A' }}</p>
                            </td>
                            <td>
                                <p>{{ $user->industry_type ? $user->industry_type : 'N/A' }}</p>
                            </td>
                            <td>
                                <p>{{ $user->address ? $user->address : 'N/A' }}</p>
                            </td>
                            <td>
                                <a
                                    @if (isset($user->product)) href="{{ route('admin.dealers.product.list', [$user->id]) }}" @endif><u>
                                        {{ $user->product ? count($user->product) : 'N/A' }}</u></a>
                            </td>

                            <td>
                                <div class="toggle-btn">
                                    <input type="checkbox" id="switch{{ $key }}" class=""
                                        @if ($user->status == 'ACTIVE') checked="checked" @endif
                                        onchange="toggleStatus(this, 'User', '{{ $user->id }}');"
                                        url="{{ route('admin.dealers.status') }}"><label
                                        for="switch{{ $key }}">Toggle</label>
                                </div>

                            </td>
                            <td>
                                <p><a href="{{ route('admin.dealers.show', [$user->id]) }}"
                                        class="btn action-view-btn">View
                                        details</a>
                                </p>
                            </td>
                            {{-- <span class="custom-switch-indicator"></span> --}}
                            {{-- <div >
                                <input type="checkbox" id="switch1"><label for="switch1">Toggle</label>
                            </div> --}}
                            {{-- <td>
                            <p class="test"> @isset($user->ComissionDetails->commision_value)
                                    <span>
                                        {{ $user->ComissionDetails->commision_value }}{{ $user->ComissionDetails->commision_type == 'Percentage' ? '%' : '$' }}</span>
                                    <a class="btn primary-btn "
                                        href="{{ route('admin.commission', ['dealer_id' => jsencode_userdata($user->id)]) }}">edit</a>
                                @else
                                    <span> N/A </span>
                                    <a class="btn primary-btn"
                                        href="{{ route('admin.commission', ['dealer_id' => jsencode_userdata($user->id)]) }}">add</a>
                                @endisset
                            </p>
                        </td>
                         <td>
                                <div class="table-pro-quantity">
                                    1
                                </div>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td class="no-record-found">
                                <center>Did not found any dealer </center>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {{-- <div class="pagination-wrapper">
            <div class="pagination-boxes">
                <div class="pagination-box">
                    <i class="fa-solid fa-angle-left"></i>
                </div>
                <div class="pagination-box active">
                    <p>1</p>
                </div>
                <div class="pagination-box">
                    <p>2</p>
                </div>
                <div class="pagination-box">
                    <p>3</p>
                </div>
                <div class="pagination-box">
                    <p>4</p>
                </div>
                <div class="pagination-box">
                    <p>5</p>
                </div>
                <div class="pagination-box">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </div> --}}
        {!! $users->appends('filter_by_name', request()->filter_by_name)->links('admin.pagination') !!}
    </div>

@endsection

{{-- @section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <x-alert-component />
                            <div class="card-header">
                                <h4> {{ 'Users' }}</h4>
                                <x-search-form :dateField="false" />
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Industry</th>
                                            <th>Address</th>
                                            <th>Product</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($users as $user)
                                            <tr>
                                                <td>{{ $user->name ? Str::limit($user->name, 15, '...') : '' }}</td>
                                                <td>{{ $user->email ? $user->email : 'N/A' }}</td>
                                                <td>{{ $user->industry_type ? $user->industry_type : 'N/A' }}</td>
                                                <td>{{ $user->address ? $user->address : 'N/A' }}</td>
                                                <td>{{ $user->product ? $user->product : 'N/A' }}</td>

                                                <td>
                                                    <label>
                                                        <input type="checkbox" class="custom-switch-input"
                                                            @if ($user->status == 'ACTIVE') checked="checked" @endif
                                                            onchange="toggleStatus(this, 'User', '{{ $user->id }}');"
                                                            url="{{ route('admin.dealers.status') }}">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <a
                                                        href="{{ route('admin.dealers.show', [$user->id]) }}"class="btn btn-primary">View</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="no-record-found">
                                                    <center>Did not found any User </center>
                                                </td>
                                            </tr>
                                        @endforelse

                                    </table>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <nav class="d-inline-block">
                                                {!! $users->links('admin.pagination') !!}
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection --}}
@push('scripts')
@endpush
