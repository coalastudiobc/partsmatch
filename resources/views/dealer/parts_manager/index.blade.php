@extends('layouts.dealer')
@section('title', 'Parts Manager')
@section('heading', 'parts manager')
@section('content')
<div class="dashboard-right-box parts-manager-table-box">
    <x-alert-component />
    <div class="bredcrum-plus-filter">
        <div class="cstm-bredcrum">
            <a href="#" class="bredcrum-list">Home</a>
            <a href="#" class="bredcrum-list">Parts match</a>
            <a href="#" class="bredcrum-list active">Listing</a>
        </div>
        <div class="serach-and-filter-box">

            <form action="">
                <div class="pro-search-box">
                    <input type="text" class="form-control" name="filter_by_name" placeholder="Search User By Name">
                    <button type="submit" class="btn primary-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <a href="#" class="btn secondary-btn filter-open-btn">Filter</a>
                </div>
            </form>
            {{-- @can('role-view', $user) --}}
            @if ($role == 'Advance')
            {{-- <a href="#" class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#add-manager-model">
                        + Add New Manager
                    </a> --}}
            <div class="serach-and-filter-box">
                <a href="javascript:void(0)" class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#add-manager-model">
                    <img src="{{ asset('assets/images/add-round-icon.svg') }}" alt=""> Add
                </a>
            </div>
            @endif
            {{-- @endcan --}}

        </div>
    </div>

    <div class="product-detail-table product-list-table pro-manage-table">
        <div class="table-responsive">
            <table class="table ">
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
                @forelse ($users as $key => $user)
                <tr>
                    <td>
                        <div class="parts-mang-img-box" data-bs-toggle="modal" data-bs-target="#pro-detail-model">
                            <img class="profile_pics" src="{{ $user->profile_picture_url ? Storage::url($user->profile_picture_url) : asset('assets/images/user.png') }}" alt="part manager profile pic" title="profile pic" data-bs-toggle="modal" data-bs-target="#view-manager-model" data={{ $user->id }}>
                        </div>
                    </td>
                    <td>
                        <p id="user_name">{{ $user->name }}</p>
                    </td>
                    <td>
                        <p>{{ $user->email }}</p>
                    </td>
                    <td>
                        <div class="toggle-btn">
                            <input type="checkbox" id="switch{{ $key }}" class="custom-switch-input" @if ($user->status == 'ACTIVE') checked="checked" @endif
                            onchange="toggleStatus(this, 'User', '{{ $user->id }}');"
                            url="{{ route('Dealer.status') }}"><label for="switch{{ $key }}">Toggle</label>
                        </div>
                    </td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('Dealer.partsmanager.edit', [$user->id]) }}"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;" title="edit"></i></a>
                            <a class="delete" href="{{ route('Dealer.partsmanager.delete', ['user' => $user->id]) }}"><i class="fa-regular fa-trash-can " style="color: #E13F3F;" title="delete"></i></a>
                        </div>
                    </td>

                </tr>
                @empty
                <div class="empty-data">
                    <img src="{{ asset('assets/images/no-product.svg') }}  " alt="" width="300">
                    <p class="text-center mt-1">Did not found any order</p>
                </div>
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
    {!! $users->links('admin.pagination') !!}
</div>
@endsection
@section('modals')
<div class="modal fade" id="add-manager-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                                            @if ($role == 'Advance')
                                            <div class="modal-body">
                                                <div class="add-pro-form">
                                                    <h2 id="modal_title">Add New Manager</h2>
                                                    <form id="parts_manager" action="{{ route('Dealer.partsmanager.store') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="upload-img">
                                                                    <div class="file-upload-box ">
                                                                        <label for="file-upload">
                                                                            <div class="profile-main-img">
                                                                                <div class="profile-without-img">
                                                                                    <img src="{{ asset('assets/images/user.png') }}" id="Userimage" alt="">
                                                                                </div>
                                                                                <div class="upload-icon">
                                                                                    <img src="{{ asset('assets/images/upload.png') }}" alt="">
                                                                                    {{-- <img src="{{ asset('assets/images/upload.png') }}" alt=""> --}}
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                        <input type="file" name="image" id="file-upload" class="@error('image') is-invalid @enderror">
                                                                        @error('image')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                    <h3>Upload profile picture*</h3>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Full Name*</label>
                                                                    <div class="form-field">
                                                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name">
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
                                                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
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
                                                                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone Number">
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
                                                                    <label for="">Role</label>
                                                                    <input type="hidden" name="permission_type" value="Basic" id="" class="role_dropdown @error('order_commission_type') is-invalid @enderror">
                                                                    <div class="custm-dropdown">
                                                                        <div class="dropdown">
                                                                            <div class="dropdown-toggle " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <div id="selectedcommission">
                                                                                    Basic
                                                                                </div>
                                                                                <span class="custm-drop-icon">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                                                                        <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                                                    </svg>
                                                                                </span>
                                                                            </div>
                                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                                                <li><a class="dropdown-item custom_dropdown_commission" data-value="Basic" data-text="Basic" href="javascript:void(0)">Basic</a>
                                                                                </li>
                                                                                <li><a class="dropdown-item custom_dropdown_commission" data-value="Advanced" data-text="Advanced" href="javascript:void(0)">Advanced</a>
                                                                                </li>

                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Password*</label>
                                                                    <div class="form-field">
                                                                        <input type="password" id="manager_confirm_password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
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
                                                                        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Confirm Password">
                                                                        @error('confirm_password')
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <button type="submit" id="submit" class="btn secondary-btn full-btn">Submit
                                                                    Details</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endsection
                                @section('view_manager_modals')
                                <div class="modal fade" id="view-manager-model" tabindex="-1" aria-labelledby="viewexampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="add-pro-form">
                                                    <h2 id="viewmodal_title">Parts Manager Details</h2>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="upload-img">
                                                                <div class="file-upload-box">
                                                                    <label for="file-uploads">
                                                                        <div class="profile-without-img">
                                                                            <img src="" id="Userimageview" alt="">
                                                                        </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Full Name*</label>
                                                                <div class="form-field">
                                                                    <input type="text" name="viewname" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" readonly disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Email*</label>
                                                                <div class="form-field">
                                                                    <input type="email" name="viewemail" class="form-control @error('email') is-invalid @enderror" placeholder="Email" readonly disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Phone
                                                                    Number*</label>
                                                                <div class="form-field">
                                                                    <input type="text" name="viewphone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Phone Number" readonly disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Role</label>
                                                                <div class="form-field">
                                                                    <input type="text" name="viewpermission_type" class="form-control @error('viewpermission_type') is-invalid @enderror" readonly disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endsection
                                @push('scripts')
                                @includeFirst(['validation.dealer.js_parts_manager'])
                                <script>
                                    jQuery(document).ready(function() {
                                        jQuery('.custom_dropdown_commission').on('click', function() {
                                            var selectitem = jQuery(this).attr('data-value')
                                            var selecttext = jQuery(this).attr('data-text')
                                            jQuery('#selectedcommission').text(selecttext)
                                            jQuery('.role_dropdown').val(selectitem);
                                            jQuery(document).find('input[name="order_commission_type"]').val(selectitem);

                                        });
                                    });
                                </script>
                                <script>
                                    $(document).ready(function() {
                                        jQuery('.filter-open-btn').on('click', function(e) {
                                            console.log('heo');
                                            jQuery('.dashboard-left-box').addClass('open');
                                        });
                                        jQuery('.cross-filter').on('click', function(e) {
                                            console.log('heo');
                                            jQuery('.dashboard-left-box').removeClass('open');
                                        });


                                        $("#file-upload").change(function() {
                                            if (this.files && this.files[0]) {
                                                var reader = new FileReader();
                                                reader.onload = function(e) {
                                                    $('#Userimage').attr('src', e.target.result);
                                                }
                                                jQuery('#file-upload-error').hide();
                                                reader.readAsDataURL(this.files[0]);
                                            }
                                        });
                                        @if(count($errors)) {
                                            $('#add-manager-model').modal('show');
                                        }
                                        @endif
                                        jQuery('.profile_pics').on('click', function() {
                                            var user_id = jQuery(this).attr('data');
                                            console.log(user_id);
                                            url = APP_URL + '/dealer/partsmanager/userDetails/' + user_id
                                            var response = new Promise((resolve, reject) => {
                                                jQuery.ajax({
                                                    url: url,
                                                    method: 'GET',
                                                    dataType: 'json',
                                                    success: function(response) {
                                                        resolve(response)
                                                    },
                                                    error: function(error) {
                                                        reject(error)
                                                    }
                                                })
                                            });
                                            response.then(function(data) {
                                                // If the promise resolves successfully, handle the response data
                                                jQuery('input[name="viewname"]').val(data.data.name);
                                                jQuery('input[name="viewemail"]').val(data.data.email);
                                                jQuery('input[name="viewphone_number"]').val(data.data.phone);
                                                jQuery('input[name="viewpermission_type"]').val(data.data.role);
                                                var image = `{{ Storage::url('` + data.data.profile_pic_url + `') }}`;
                                                jQuery('#Userimageview').attr('src', image);
                                            }).catch(function(error) {
                                                // If the promise rejects (i.e., error occurs), handle the error
                                                jQuery('#viewmodal_title').html(error.statusText);
                                                console.error('Error:', error);
                                            });
                                        });
                                    });
                                </script>
                                @endpush