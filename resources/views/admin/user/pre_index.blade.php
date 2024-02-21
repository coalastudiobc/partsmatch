@extends('layouts.admin')
@section('title','Users')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <x-alert-component />
                            <div class="card-header right-align-btn-sub">
                                <h4>Users</h4>
                                <a class="btn btn-primary header-cart-btm" href="{{ route('admin.users.pre.export') }}">Export csv</a>
                                {{-- <x-search-form :dateField="false"/> --}}
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                        </tr>
                                        @forelse ($users as $user)
                                        {{-- @dd($user->filesArchived()->count()) --}}
                                            <tr>
                                                <td>{{ $user->name ? Str::limit($user->name ,15,'...') : '' }}</td>
                                                <td>{{ $user->email ? $user->email : 'N/A' }}</td>
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
@endsection
@push('scripts')

@endpush
