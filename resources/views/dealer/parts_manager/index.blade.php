@extends('layouts.dealer')
@section('title', 'partsmanager')
@section('heading', 'parts manager')
@section('content')
    <div class="dashboard-right-box parts-manager-table-box">
        <div class="serach-and-filter-box">
            <h3>All Managers</h3>
            <form action="">
                <div class="pro-search-box">
                    <input type="text" class="form-control" name="filter_by_name" placeholder="Search User By Name">
                    <button type="submit" class="btn primary-btn">Search</button>
                </div>
            </form>
            <a href="#" class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#add-manager-model">
                + Add New Manager
            </a>
        </div>
        <div class="product-detail-table product-list-table pro-manage-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Image</p>
                        </th>
                        <th>
                            <p>Name</p>
                        </th>
                        <th>
                            <p>Email</p>
                        </th>
                        <th>
                            <p>Status</p>
                        </th>
                        <th>
                            <p>Action</p>
                        </th>
                    </tr>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td>
                                <div class="parts-mang-img-box" data-bs-toggle="modal" data-bs-target="#pro-detail-model">
                                    <img src="{{ $user->profile_picture_url ? Storage::url($user->profile_picture_url) : asset('assets/images/user.png') }}"
                                        alt="">
                                </div>
                            </td>
                            <td>
                                <p>{{ $user->name }}</p>
                            </td>
                            <td>
                                <p>{{ $user->email }}</p>
                            </td>
                            <td>
                                <div class="toggle-btn">
                                    <input type="checkbox" id="switch101" class="custom-switch-input"
                                        @if ($user->status == 'ACTIVE') checked="checked" @endif
                                        onchange="toggleStatus(this, 'User', '{{ $user->id }}');"
                                        url="{{ route('dealer.status') }}"><label for="switch101">Toggle</label>
                                </div>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('dealer.partsmanager.edit', [$user->id]) }}"><i
                                            class="fa-solid fa-pen-to-square" style="color: #3EBE62;"
                                            title="edit"></i></a>
                                    <a href="{{ route('dealer.partsmanager.delete', [$user->id]) }}"><i
                                            class="fa-regular fa-trash-can" style="color: #E13F3F;" title="delete"></i></a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
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
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="add-manager-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <div class="modal-body">
                    <div class="add-pro-form">
                        <h2>Add New Manager</h2>
                        <form id="parts_manager" action="{{ route('dealer.partsmanager.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="upload-img">
                                        <div class="file-upload-box">
                                            <label for="file-upload">
                                                <div class="profile-without-img">
                                                    <img src="images/user.png" id="Userimage" alt="">
                                                </div>
                                                <input type="file" name="image" id="file-upload">
                                            @section('modals')
                                                <div class="modal fade" id="add-manager-model" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true"
                                                    data-bs-backdrop="static">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                               
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div> --}}
                <div class="modal-body">
                    <div class="add-pro-form">
                        <h2>Add New Manager</h2>
                        <form id="parts_manager" action="{{ route('dealer.partsmanager.store') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="upload-img">
                                        <div class="file-upload-box">
                                            <label for="file-upload">
                                                <div class="profile-without-img">
                                                    <img src="{{ asset('assets/images/user.png') }}" id="Userimage"
                                                        alt="">
                                                </div>
                                                <input type="file" name="image" id="file-upload"
                                                    class="@error('image') is-invalid @enderror">
                                                @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="upload-icon">
                                                    <img src="{{ asset('assets/images/upload.png') }}" alt="">
                                                    {{-- <img src="{{ asset('assets/images/upload.png') }}" alt=""> --}}
                                                </div>
                                            </label>
                                        </div>
                                        <h3>Upload profile picture*</h3>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Full Name*</label>
                                        <div class="form-field">
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="Full Name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email*</label>
                                        <div class="form-field">
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone
                                            Number*</label>
                                        <div class="form-field">
                                            <input type="text" name="phone_number"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                placeholder="Phone Number">
                                            @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Assign
                                            Role</label>
                                        <div class="form-field">
                                            <input type="text" class="form-control " placeholder="Assign Role">

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Password*</label>
                                        <div class="form-field">
                                            <input type="password" id="manager_confirm_password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Confirm
                                            Password</label>
                                        <div class="form-field">
                                            <input type="password" name="confirm_password"
                                                class="form-control @error('confirm_password') is-invalid @enderror"
                                                placeholder="Confirm Password">
                                            @error('confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn secondary-btn full-btn">Submit
                                        Details</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @includeFirst(['validation.dealer.js_parts_manager'])
    <script>
        $(document).ready(function() {
            $("#file-upload").change(function() {
                if (this.files && this.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#Userimage').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);
                }
            });
            @if (count($errors))
                {
                    $('#add-manager-model').modal('show');
                }
            @endif
        });
    </script>
@endpush
