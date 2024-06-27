@extends('layouts.admin')
@section('title', $heading ? 'Users'.$heading : "Users")

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <x-alert />
                            <div class="card-header">
                                <h4>{{$heading ? ucfirst($heading) ." of ".ucfirst($username)  : ""}}</h4>
                                <x-search-form :dateField="false"/>    
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tr>
                                            <th>S.no</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse ($data as $single_data)
                                        {{-- @dd($single_data) --}}
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{ $heading == "devotees" ? ucfirst($single_data->user->name) : ucfirst($single_data->name) }}</td>
                                                <td>{{ $heading == "devotees" ? $single_data->user->email : $single_data->email }}</td>
                                                <td>{{ $heading == "devotees" ? ucfirst($single_data->user->username) : ucfirst($single_data->username) }}</td>
                                                @if($heading == 'devotees')
                                                <td>{{ $single_data ?   $single_data->created_at : "" }}</td>
                                                @else
                                                <td>{{ $single_data->pivot ?  ($single_data->pivot->created_at ?? $single_data->pivot->created_at ) : "" }}</td>
                                                @endif
                                                <td>
                                                    <a href="{{ route('admin.creator.list' == Request::route()->getName() ? 'admin.show.creator' : 'admin.show.user', [jsencode_userdata( $heading == "devotees" ? $single_data->user->id : $single_data->id)]) }}"
                                                        class="btn btn-secondary">View Profile</a>
                                                    <a href="{{route('admin.creator.list' == Request::route()->getName() ? 'admin.edit.creator' : 'admin.edit.user', [jsencode_userdata($heading == "devotees" ? $single_data->user->id : $single_data->id)]) }}"
                                                        class="btn btn-primary">Edit</a>
                                                </td>
                                            </tr>
                                         @empty
                                            <tr>
                                                <td class="no-record-found">
                                                    <center>Did not found any {{$heading ? $heading : ""}}</center>
                                                </td>
                                            </tr>
                                        @endforelse

                                    </table>
                                    <div class="card-footer"> 
                                        <div class="text-right">
                                            <nav class="d-inline-block">           
                                                {!! $data->links('admin.pagination') !!}
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
