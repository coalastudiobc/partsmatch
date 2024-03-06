@extends('layouts.admin')
@section('title', 'Users')

@section('content')
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
                                                    {{-- <a
                                                        href="{{ route('admin.users.edit', [jsencode_userdata($user->id)]) }}"class="btn btn-primary">Edit</a>
                                                    <a
                                                        href="{{ route('admin.users.delete', [jsencode_userdata($user->id)]) }}"class="btn btn-danger delete">Delete</a> --}}
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
                                                {{-- {!! $users->links('admin.pagination') !!} --}}
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
@endsection
@push('scripts')
@endpush
