@extends('layouts.admin')

@section('title', 'User')
@section('heading', 'Dealer')

@section('content')
    <div class="main-content">
        <div class="page-content-wrapper">
            <div class="dealer-profile-box">
                <div class="dealer-profile-content">
                    <div class="dealer-profile-form-box">
                        <div class="dealer-profile-detail-form">
                            <form action="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="dealer-profile-upload-box">
                                            <div class="upload-img">
                                                <div class="file-upload-box">
                                                    <label for="file-upload">
                                                        <div class="profile-without-img">
                                                            <img src="{{ !is_null($user->profile_picture_url) ? asset('storage/' . $user->profile_picture_url) : asset('admin/assets/img/users/user-1.png') }}"
                                                                alt="">
                                                            {{-- <div class="upload-icon"> --}}
                                                            {{-- <i class="fa-sharp fa-solid fa-pen"></i> --}}
                                                            {{-- </div> --}}
                                                        </div>
                                                        {{-- <input type="file" id="file-upload"> --}}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="dealer-pro-personal-info">
                                            <ul>
                                                <li>
                                                    <h4>Name</h4>
                                                    <p>{{ $user->name ? $user->name : 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h4>Email</h4>
                                                    <p>{{ $user->email ? $user->email : 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h4>Phone Number</h4>
                                                    <p>{{ $user->phone_number ? $user->phone_number : 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h4>Industry</h4>
                                                    <p>{{ $user->industry_type ? $user->industry_type : 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h4>Address</h4>
                                                    <p>{{ $user->address ? $user->address : 'N/A' }}</p>
                                                </li>
                                                <li>
                                                    <h4>Zipcode</h4>
                                                    <p>{{ $user->zipcode ? $user->zipcode : 'N/A' }}</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <div class="dealer-pro-commission-info">
                                            <ul>
                                                <li>
                                                    <h4>Commission</h4>
                                                    <p>
                                                        @if (isset($user->ComissionDetails->commision_value))
                                                            {{ $user->ComissionDetails->commision_value }}{{ $user->ComissionDetails->commision_type == 'Percentage' ? '%' : '$' }}
                                                        @else
                                                            N/A
                                                        @endif
                                                    </p>
                                                </li>
                                                <li>
                                                    <h4>Commission Action</h4>
                                                    <div class="d-flex gap-3 align-items-center">
                                                        {{-- <p>50% </p> --}}
                                                        <a class="btn primary-btn" href="{{ route('admin.commission', ['dealer_id' => jsencode_userdata($user->id)]) }}">
                                                            @if (isset($user->ComissionDetails->commision_value))
                                                                edit
                                                            @else
                                                                add
                                                            @endif
                                                        </a>
                                                    </div>
                                                </li>
                                                <!-- <li>
                                                    <h4>Commission Action</h4>
                                                    <p>
                                                        <a class="btn primary-btn" href="{{ route('admin.commission', ['dealer_id' => jsencode_userdata($user->id)]) }}">
                                                            @if (isset($user->ComissionDetails->commision_value))
                                                                edit
                                                            @else
                                                                add
                                                            @endif
                                                        </a>
                                                    </p>
                                                </li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="dealer-last-five-product">
                                            <h3>Recent Products</h3>
                                            <div class="product-detail-table">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Stocks</th>
                                                            <th>Price</th>
                                                            <th>action</th>
                                                        </tr>
                                                        <tr>
                                                            <td>vejbjk</td>
                                                            <td>2</td>
                                                            <td>500</td>
                                                            <td><a href="#" class="btn primary-btn small-btn"><i class="fa-solid fa-eye"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>vejbjk</td>
                                                            <td>2</td>
                                                            <td>500</td>
                                                            <td><a href="#" class="btn primary-btn small-btn"><i class="fa-solid fa-eye"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>vejbjk</td>
                                                            <td>2</td>
                                                            <td>500</td>
                                                            <td><a href="#" class="btn primary-btn small-btn"><i class="fa-solid fa-eye"></i></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>vejbjk</td>
                                                            <td>2</td>
                                                            <td>500</td>
                                                            <td><a href="#" class="btn primary-btn small-btn"><i class="fa-solid fa-eye"></i></a></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <div class="form-field">

                                                {{ $user->name ? $user->name : 'N/A' }}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <div class="form-field">
                                                {{ $user->email ? $user->email : 'N/A' }}


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <div class="form-field">
                                                {{ $user->phone_number ? $user->phone_number : 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Industry</label>
                                            <div class="form-field">
                                                {{ $user->industry_type ? $user->industry_type : 'N/A' }}


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <div class="form-field">
                                                {{ $user->address ? $user->address : 'N/A' }}


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Zipcode</label>
                                            <div class="form-field">
                                                {{ $user->zipcode ? $user->zipcode : 'N/A' }}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Commission</label>
                                            <div class="form-field">
                                                @if (isset($user->ComissionDetails->commision_value))
                                                    {{ $user->ComissionDetails->commision_value }}{{ $user->ComissionDetails->commision_type == 'Percentage' ? '%' : '$' }}
                                                @else
                                                    N/A
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Commission Action</label>
                                            <div class="form-field">
                                                <a class="btn primary-btn"
                                                    href="{{ route('admin.commission', ['dealer_id' => jsencode_userdata($user->id)]) }}">
                                                    @if (isset($user->ComissionDetails->commision_value))
                                                        edit
                                                    @else
                                                        add
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-md-12">
                                        <div class="dealer-profile-form-btn">
                                            <a class="btn primary-btn " href="{{ url()->previous() }}">Back</a>

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
