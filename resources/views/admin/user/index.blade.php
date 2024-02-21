@extends('layouts.admin')
@section('title', $deleted ?  'Deleted Users' : 'Users')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <x-alert-component />
                            <div class="card-header">
                                <h4> {{$deleted ?  'Deleted Users' : 'Users'}}</h4>
                                <x-search-form :dateField="false"/>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            @if(!$deleted)
                                                <th>Status</th>
                                            @endif
                                            <th>Purchased Plan</th>
                                            <th>Files Archived</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($users as $user)
                                        {{-- @dd($user->filesArchived()->count()) --}}
                                            <tr>
                                                <td>{{ $user->name ? Str::limit($user->name ,15,'...') : '' }}</td>
                                                <td>{{ $user->email ? $user->email : 'N/A' }}</td>
                                                @if(!$deleted)
                                                    <td>
                                                        <label>
                                                            <input type="checkbox" class="custom-switch-input"
                                                                @if ($user->status == '1') checked="checked" @endif
                                                                onchange="toggleStatus(this, 'User', '{{ jsencode_userdata($user->id) }}');">
                                                            <span class="custom-switch-indicator"></span>
                                                        </label>
                                                    </td>
                                                @endif
                                                <td>
                                                    @forelse($user->subscriptions as $subscription)
                                                    <a href="#" >{{$subscription->name}}</a>
                                                    {{!$loop->first && !$loop->last? "," : ""}}
                                                    @empty
                                                    Ø
                                                    @endforelse
                                                </td>
                                                <td>{{ $user ? $user->filesArchived()->count() : 'N/A' }}</td>
                                                <td>
                                                    @if($deleted)
                                                        <a href="{{ route('admin.users.restore', [jsencode_userdata($user->id)]) }}" class="btn btn-primary restore">Restore</a>
                                                    @else
                                                        <a href="{{ route('admin.users.show', [jsencode_userdata($user->id)]) }}"class="btn btn-secondary">View</a>
                                                        <a href="{{ route('admin.users.edit', [jsencode_userdata($user->id)]) }}"class="btn btn-primary">Edit</a>
                                                        <a href="{{ route('admin.users.delete', [jsencode_userdata($user->id)]) }}"class="btn btn-danger delete">Delete</a>
                                                    @endif                                                        
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
@endsection
@push('scripts')

@endpush
