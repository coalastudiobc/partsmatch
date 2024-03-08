@extends('layouts.front')
@section('title', 'welcome')
@section('content')
<section class="banner-content-sec">
    <div class="container">
        <div class="banner-content-wrapper">
            <div class="banner-content-heading">
                <h2>Profile</h2>
            </div>
        </div>
    </div>
</section>
<section class="page-content-sec">
    <div class="container">
        <div class="page-content-wrapper">
            <div class="dealer-profile-box">
                <div class="dealer-profile-content">
                    <div class="dealer-profile-form-box">
                        <div class="dealer-profile-detail-form">
                            <span id="editProfile"><i class="fa-sharp fa-solid fa-edit"></i></span>
                            <span id="closeEditProfile" class='d-none'><i class="fa-sharp fa-solid fa-close"></i></span>
                            <form action="{{ route('profile.update') }}" enctype="multipart/form-data" method="POST">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="dealer-profile-upload-box">
                                            <div class="upload-img">
                                                <div class="file-upload-box">
                                                    <label for="file-upload">
                                                        <div class="profile-without-img">
                                                            <img src="{{ $authUser->profile_picture_url ? (Storage::url('$authUser->profile_picture_url')) : asset('assets/images/user.png') }}" alt="">
                                                            <div class="upload-icon d-none editable" >
                                                                <i class="fa-sharp fa-solid fa-pen"></i>
                                                            </div>
                                                        </div>
                                                        <input type="file" disabled class="d-none" id="file-upload">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Name</label>
                                            <div class="form-field">
                                                <input type="text" class="form-control disabled-inputs" placeholder="John Doe" disabled  value="{{old('name',$authUser->name)}}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <div class="form-field">
                                                <input type="email" class="form-control disabled-inputs" placeholder="johndoe@gmail.com" disabled value="{{old('name',$authUser->email)}}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Phone Number</label>
                                            <div class="form-field">
                                                <input type="tel" class="form-control disabled-inputs" placeholder="8569874513" disabled value="{{old('name',$authUser->phonr_number)}}">

                                            </div>
                                        </div>
                                    </div>
                                    {{-- @dd($authUser->roles) --}}
                                    @if($authUser->hasRole('Dealer') )
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Industry</label>
                                            <div class="form-field">
                                                <input type="text" class="form-control disabled-inputs" placeholder="Automobile" disabled value="{{old('name',$authUser->industry)}}">

                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-md-12">
                                        <div class="dealer-profile-form-btn">
                                            <button  class="btn primary-btn d-none editable">Submit</button>
                                        </div>
                                    </div>
                                </div>
                               
                            </form>
                        </div>
                    </div>
                    <div class="dealer-product-bxx">
                        <div class="dealer-product-header">
                            <h3>Product</h3>
                            <a href="#" class="btn secondary-btn view-btn">
                                View all Products                                       
                            </a>
                        </div>
                        <div class="dealer-product-category">
                            <div class="dealer-category-box">
                                    <div class="collection-box cstm-card">
                                        <div class="collection-img">
                                            <img src="images/collect1.png" alt="">
                                        </div>
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <h4>$180.00</h4>
                                    </div>
                                    <div class="collection-box cstm-card">
                                        <div class="collection-img">
                                            <img src="images/collect1.png" alt="">
                                        </div>
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <h4>$180.00</h4>
                                    </div>
                                    <div class="collection-box cstm-card">
                                        <div class="collection-img">
                                            <img src="images/collect1.png" alt="">
                                        </div>
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <h4>$180.00</h4>
                                    </div>
                                    <div class="collection-box cstm-card">
                                        <div class="collection-img">
                                            <img src="images/collect1.png" alt="">
                                        </div>
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <h4>$180.00</h4>
                                    </div>
                                    <div class="collection-box cstm-card">
                                        <div class="collection-img">
                                            <img src="images/collect1.png" alt="">
                                        </div>
                                        <p>R1 Concepts® – eLINE Series Plain Brake Rotors</p>
                                        <h4>$180.00</h4>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Start -->
    <!-- End -->
</section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#editProfile').click(function(e) {
                e.preventDefault();
                $(this).addClass('d-none')
                $('#closeEditProfile').removeClass('d-none')
                $('.disabled-inputs').removeAttr('disabled');
                $('.editable').removeClass('d-none');
            });
            $('#closeEditProfile').click(function(e) {
                e.preventDefault();
                $(this).addClass('d-none')
                $('#editProfile').removeClass('d-none')
                $('.disabled-inputs').attr('disabled','disabled');
                $('.editable').addClass('d-none');
            });
        });
    </script>
@endpush
@include('layouts.include.footer')

