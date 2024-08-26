@extends('layouts.front')
@section('title', 'Account Settings')
@section('heading', 'Account Settings')

@section('content')
<section class="banner-content-sec">
    <div class="container">
        <div class="banner-content-wrapper">
            <div class="banner-content-heading flex-heading">
                <div class="back-page-btn">
                    {{-- <div class="back-round-icon">
                            <i class="fa-solid fa-angle-left"></i>
                        </div> --}}
                    <p></p>
                </div>
                <h2>Account Setting</h2>
            </div>
        </div>
    </div>
</section>
<section class="page-content-sec section-padding">
    <div class="container">
        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <x-alert-component />
                    <div class="cstm-card account-detail-card">
                        <div class="accounts-form">
                            <form id="account_setting" action="{{ route('Dealer.profile.post.update') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <div class="row">
                                    <div class="dealer-profile-upload-box">
                                        <div class="upload-img dealer-profile-img">
                                            <div class="file-upload-box">
                                                <label for="file-upload">
                                                    <div class="profile-without-img">
                                                        <img src="{{ $user->profile_picture_url ? Storage::url($user->profile_picture_url) : asset('assets/images/user.png') }}" alt="" id="Userimage">
                                                    </div>
                                                    <div class="upload-icon d-none editable" style="cursor: pointer;">
                                                        <i class="fa-sharp fa-solid fa-pen"></i>
                                                    </div>
                                                    <input type="file" name="image" disabled accept=".jpg,.png,.jpeg" class="disabled-inputs @error('image') is-invalid @enderror" id="file-upload">
                                                    @error('image')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Full name*</label>
                                            <div class="form-field">
                                                <input type="text" class="form-control @error('name') is-invalid @enderror disabled-inputs" disabled name="name" value="{{ old('name', $user->name ?? $user->name) }}" placeholder="Full name">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 16" fill="none">
                                                        <path d="M6.90909 7.72636C6.1239 7.72646 5.35632 7.49998 4.70341 7.07555C4.0505 6.65112 3.54159 6.04781 3.24103 5.34192C2.94048 4.63602 2.86179 3.85925 3.0149 3.10983C3.16802 2.36042 3.54607 1.67201 4.10124 1.13169C4.65642 0.591359 5.36378 0.223374 6.13387 0.0742701C6.90396 -0.0748341 7.70219 0.00163911 8.42762 0.294018C9.15305 0.586398 9.77309 1.08155 10.2093 1.71686C10.6456 2.35217 10.8784 3.09909 10.8784 3.86318C10.8774 4.88737 10.4589 5.86933 9.71475 6.59359C8.97059 7.31785 7.96156 7.72524 6.90909 7.72636ZM6.90909 1.11408C6.3502 1.11397 5.80383 1.27516 5.33909 1.57725C4.87435 1.87935 4.5121 2.30877 4.29818 2.81122C4.08425 3.31367 4.02825 3.86658 4.13726 4.4C4.24626 4.93343 4.51538 5.42341 4.91058 5.80799C5.30577 6.19256 5.80929 6.45445 6.35744 6.56053C6.9056 6.66661 7.47377 6.61211 7.9901 6.40393C8.50642 6.19575 8.94771 5.84324 9.25814 5.39099C9.56858 4.93873 9.73422 4.40705 9.73411 3.86318C9.73325 3.13433 9.43534 2.43557 8.90573 1.92019C8.37612 1.40482 7.65807 1.11491 6.90909 1.11408ZM13.246 16H0.572149L0 15.4432C-1.352e-08 14.5603 0.178709 13.686 0.525923 12.8703C0.873138 12.0546 1.38206 11.3134 2.02363 10.689C2.66519 10.0647 3.42685 9.56948 4.2651 9.23159C5.10335 8.89371 6.00178 8.7198 6.90909 8.7198C7.81641 8.7198 8.71484 8.89371 9.55308 9.23159C10.3913 9.56948 11.153 10.0647 11.7946 10.689C12.4361 11.3134 12.945 12.0546 13.2923 12.8703C13.6395 13.686 13.8182 14.5603 13.8182 15.4432L13.246 16ZM1.17136 14.8865H12.6468C12.5069 13.5001 11.842 12.214 10.7814 11.2783C9.7209 10.3427 8.34059 9.82443 6.90909 9.82443C5.47759 9.82443 4.09728 10.3427 3.03674 11.2783C1.9762 12.214 1.31128 13.5001 1.17136 14.8865Z" fill="#727272" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email*</label>
                                            <div class="form-field">
                                                <input type="email" name="email" value="{{ old('email', $user->email ?? $user->email) }}" value="{{ old('email', $user->email ?? $user->email) }}" class="form-control @error('email') is-invalid @enderror disabled-inputs" disabled placeholder="Email">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
                                                        <path d="M15.6265 13.5406H2.06388C1.5165 13.5406 0.991548 13.3232 0.604496 12.9361C0.217444 12.5491 0 12.0241 0 11.4768V2.99717C0 2.44979 0.217444 1.92484 0.604496 1.53778C0.991548 1.15073 1.5165 0.933289 2.06388 0.933289H15.6265C16.1739 0.933289 16.6988 1.15073 17.0859 1.53778C17.4729 1.92484 17.6904 2.44979 17.6904 2.99717V11.4768C17.6904 12.0241 17.4729 12.5491 17.0859 12.9361C16.6988 13.3232 16.1739 13.5406 15.6265 13.5406ZM2.06388 2.11265C1.82929 2.11265 1.60431 2.20584 1.43843 2.37172C1.27255 2.5376 1.17936 2.76258 1.17936 2.99717V11.4768C1.17936 11.7113 1.27255 11.9363 1.43843 12.1022C1.60431 12.2681 1.82929 12.3613 2.06388 12.3613H15.6265C15.8611 12.3613 16.0861 12.2681 16.252 12.1022C16.4178 11.9363 16.511 11.7113 16.511 11.4768V2.99717C16.511 2.76258 16.4178 2.5376 16.252 2.37172C16.0861 2.20584 15.8611 2.11265 15.6265 2.11265H2.06388Z" fill="#727272" />
                                                        <path d="M8.84732 6.5155C8.38617 6.51602 7.93288 6.3961 7.53233 6.16759L0.898438 2.62951L1.45274 1.59167L8.10432 5.12975C8.32702 5.25696 8.57905 5.32387 8.83552 5.32387C9.09199 5.32387 9.34403 5.25696 9.56673 5.12975L16.2301 1.59167L16.7844 2.62951L10.1328 6.16759C9.74178 6.39317 9.29875 6.51307 8.84732 6.5155Z" fill="#727272" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Phone number*</label>
                                            <div class="form-field">
                                                <input type="text" name="phone_number" disabled class="form-control @error('phone_number') is-invalid @enderror disabled-inputs" value="{{ old('phone_number', $user->phone_number ?? $user->phone_number) }}" placeholder="Phone number">
                                                @error('phone_number')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                {{-- <div class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                            height="15" viewBox="0 0 12 15" fill="none">
                                                            <path
                                                                d="M5.89286 15C6.01369 14.9993 6.13075 14.9578 6.225 14.8821C6.42857 14.7 11.7857 10.3821 11.7857 5.89286C11.7857 4.32997 11.1649 2.8311 10.0597 1.72598C8.95461 0.620853 7.45574 0 5.89286 0C4.32997 0 2.8311 0.620853 1.72598 1.72598C0.620853 2.8311 0 4.32997 0 5.89286C0 10.3821 5.35714 14.7 5.56071 14.8821C5.65497 14.9578 5.77202 14.9993 5.89286 15ZM1.07143 5.89286C1.07143 4.61413 1.5794 3.38779 2.48359 2.48359C3.38779 1.5794 4.61413 1.07143 5.89286 1.07143C7.17158 1.07143 8.39793 1.5794 9.30212 2.48359C10.2063 3.38779 10.7143 4.61413 10.7143 5.89286C10.7143 9.26786 7.03393 12.7554 5.89286 13.7625C4.75179 12.7554 1.07143 9.26786 1.07143 5.89286Z"
                                                                fill="#727272" />
                                                            <path
                                                                d="M8.57199 5.89305C8.57199 5.36328 8.41489 4.8454 8.12057 4.40492C7.82624 3.96443 7.40791 3.62111 6.91846 3.41837C6.42902 3.21564 5.89045 3.16259 5.37085 3.26595C4.85126 3.3693 4.37399 3.62441 3.99938 3.99901C3.62478 4.37362 3.36967 4.8509 3.26631 5.37049C3.16296 5.89008 3.216 6.42865 3.41874 6.9181C3.62147 7.40754 3.96479 7.82588 4.40528 8.1202C4.84577 8.41453 5.36365 8.57162 5.89342 8.57162C6.60382 8.57162 7.28512 8.28942 7.78745 7.78709C8.28978 7.28476 8.57199 6.60345 8.57199 5.89305ZM4.28627 5.89305C4.28627 5.57519 4.38053 5.26446 4.55713 5.00017C4.73372 4.73588 4.98472 4.52988 5.27839 4.40824C5.57206 4.2866 5.8952 4.25478 6.20696 4.31679C6.51871 4.3788 6.80508 4.53187 7.02984 4.75663C7.2546 4.98139 7.40767 5.26776 7.46968 5.57951C7.53169 5.89127 7.49986 6.21441 7.37822 6.50808C7.25658 6.80174 7.05059 7.05275 6.7863 7.22934C6.522 7.40594 6.21128 7.50019 5.89342 7.50019C5.46718 7.50019 5.05839 7.33087 4.75699 7.02947C4.4556 6.72807 4.28627 6.31929 4.28627 5.89305Z"
                                                                fill="#727272" />
                                                        </svg>
                                                    </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Industry*</label>
                                            <div class="form-field custm-invalid-field">
                                                <!-- <input type="text" class="form-control" placeholder="Select industry"> -->
                                                {{-- <select name="industry_type" id="industury"
                                                        value="{{ old('industury', $user->industry_type ?? $user->industry_type) }}"
                                                disabled
                                                class="form-control @error('industry_type') is-invalid @enderror disabled-inputs">
                                                <option value="volvo">{{ $user->industry_type }}</option>
                                                <option value="saab">Volvo</option>
                                                <option value="saab">Saab</option>
                                                <option value="opel">Opel</option>
                                                <option value="audi">Audi</option> --}}
                                                <input type="hidden" id="industry" name="industry_type" value="{{ old('industry_type', $user->industry_type ?? '') }}">
                                                <div class=" custm-dropdown dropmenu disabled_select ">
                                                    <div class="dropdown">
                                                        <div class=" form-control  dropdown-toggle " type="button" readonly id="dropdownMenuButton1" aria-expanded="false"  disabled>
                                                            <div id="selectedItem">
                                                                {{ $user->industry_type }}

                                                            </div>
                                                            {{-- <span class="custm-drop-icon">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                                                    <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                                                </svg>
                                                            </span> --}}
                                                        </div>
                                                        <ul class="dropdown-menu dropdownlist" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item custom_dropdown_item" data-value="Volvo" href="javascript:void(0)">Volvo</a>
                                                            </li>
                                                            <li><a class="dropdown-item custom_dropdown_item" data-value="Saab" href="javascript:void(0)">Saab
                                                                </a></li>
                                                            <li><a class="dropdown-item custom_dropdown_item" data-value="Opel" href="javascript:void(0)">Opel</a></li>
                                                            <li><a class="dropdown-item custom_dropdown_item" data-value="Audi" href="javascript:void(0)">Audi</a></li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                </select>
                                                @error('industry_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Complete address*</label>
                                            <div class="form-field">
                                                <input type="text" name="address" disabled class="form-control @error('address') is-invalid @enderror disabled-inputs" value="{{ old('address', $user->address ?? $user->address) }}" placeholder="Complete address">
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <div class="input-icon">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="15" viewBox="0 0 12 15" fill="none">
                                                        <path d="M5.89286 15C6.01369 14.9993 6.13075 14.9578 6.225 14.8821C6.42857 14.7 11.7857 10.3821 11.7857 5.89286C11.7857 4.32997 11.1649 2.8311 10.0597 1.72598C8.95461 0.620853 7.45574 0 5.89286 0C4.32997 0 2.8311 0.620853 1.72598 1.72598C0.620853 2.8311 0 4.32997 0 5.89286C0 10.3821 5.35714 14.7 5.56071 14.8821C5.65497 14.9578 5.77202 14.9993 5.89286 15ZM1.07143 5.89286C1.07143 4.61413 1.5794 3.38779 2.48359 2.48359C3.38779 1.5794 4.61413 1.07143 5.89286 1.07143C7.17158 1.07143 8.39793 1.5794 9.30212 2.48359C10.2063 3.38779 10.7143 4.61413 10.7143 5.89286C10.7143 9.26786 7.03393 12.7554 5.89286 13.7625C4.75179 12.7554 1.07143 9.26786 1.07143 5.89286Z" fill="#727272" />
                                                        <path d="M8.57199 5.89305C8.57199 5.36328 8.41489 4.8454 8.12057 4.40492C7.82624 3.96443 7.40791 3.62111 6.91846 3.41837C6.42902 3.21564 5.89045 3.16259 5.37085 3.26595C4.85126 3.3693 4.37399 3.62441 3.99938 3.99901C3.62478 4.37362 3.36967 4.8509 3.26631 5.37049C3.16296 5.89008 3.216 6.42865 3.41874 6.9181C3.62147 7.40754 3.96479 7.82588 4.40528 8.1202C4.84577 8.41453 5.36365 8.57162 5.89342 8.57162C6.60382 8.57162 7.28512 8.28942 7.78745 7.78709C8.28978 7.28476 8.57199 6.60345 8.57199 5.89305ZM4.28627 5.89305C4.28627 5.57519 4.38053 5.26446 4.55713 5.00017C4.73372 4.73588 4.98472 4.52988 5.27839 4.40824C5.57206 4.2866 5.8952 4.25478 6.20696 4.31679C6.51871 4.3788 6.80508 4.53187 7.02984 4.75663C7.2546 4.98139 7.40767 5.26776 7.46968 5.57951C7.53169 5.89127 7.49986 6.21441 7.37822 6.50808C7.25658 6.80174 7.05059 7.05275 6.7863 7.22934C6.522 7.40594 6.21128 7.50019 5.89342 7.50019C5.46718 7.50019 5.05839 7.33087 4.75699 7.02947C4.4556 6.72807 4.28627 6.31929 4.28627 5.89305Z" fill="#727272" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Dealership name</label>
                                            <div class="form-field">
                                                <input type="text" name="dealershipName" disabled class="form-control @error('dealershipName') is-invalid @enderror disabled-inputs" value="{{ old('dealershipName', $user->dealership_name ?? $user->name) }}" placeholder="Dealership name">
                                                @error('dealershipName')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                {{-- <div class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                            height="15" viewBox="0 0 12 15" fill="none">
                                                            <path
                                                                d="M5.89286 15C6.01369 14.9993 6.13075 14.9578 6.225 14.8821C6.42857 14.7 11.7857 10.3821 11.7857 5.89286C11.7857 4.32997 11.1649 2.8311 10.0597 1.72598C8.95461 0.620853 7.45574 0 5.89286 0C4.32997 0 2.8311 0.620853 1.72598 1.72598C0.620853 2.8311 0 4.32997 0 5.89286C0 10.3821 5.35714 14.7 5.56071 14.8821C5.65497 14.9578 5.77202 14.9993 5.89286 15ZM1.07143 5.89286C1.07143 4.61413 1.5794 3.38779 2.48359 2.48359C3.38779 1.5794 4.61413 1.07143 5.89286 1.07143C7.17158 1.07143 8.39793 1.5794 9.30212 2.48359C10.2063 3.38779 10.7143 4.61413 10.7143 5.89286C10.7143 9.26786 7.03393 12.7554 5.89286 13.7625C4.75179 12.7554 1.07143 9.26786 1.07143 5.89286Z"
                                                                fill="#727272" />
                                                            <path
                                                                d="M8.57199 5.89305C8.57199 5.36328 8.41489 4.8454 8.12057 4.40492C7.82624 3.96443 7.40791 3.62111 6.91846 3.41837C6.42902 3.21564 5.89045 3.16259 5.37085 3.26595C4.85126 3.3693 4.37399 3.62441 3.99938 3.99901C3.62478 4.37362 3.36967 4.8509 3.26631 5.37049C3.16296 5.89008 3.216 6.42865 3.41874 6.9181C3.62147 7.40754 3.96479 7.82588 4.40528 8.1202C4.84577 8.41453 5.36365 8.57162 5.89342 8.57162C6.60382 8.57162 7.28512 8.28942 7.78745 7.78709C8.28978 7.28476 8.57199 6.60345 8.57199 5.89305ZM4.28627 5.89305C4.28627 5.57519 4.38053 5.26446 4.55713 5.00017C4.73372 4.73588 4.98472 4.52988 5.27839 4.40824C5.57206 4.2866 5.8952 4.25478 6.20696 4.31679C6.51871 4.3788 6.80508 4.53187 7.02984 4.75663C7.2546 4.98139 7.40767 5.26776 7.46968 5.57951C7.53169 5.89127 7.49986 6.21441 7.37822 6.50808C7.25658 6.80174 7.05059 7.05275 6.7863 7.22934C6.522 7.40594 6.21128 7.50019 5.89342 7.50019C5.46718 7.50019 5.05839 7.33087 4.75699 7.02947C4.4556 6.72807 4.28627 6.31929 4.28627 5.89305Z"
                                                                fill="#727272" />
                                                        </svg>
                                                    </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Zip code</label>
                                            <div class="form-field">
                                                <input type="text" name="zipcode"  class="form-control @error('zipcode') is-invalid @enderror " value="{{ old('zipcode', $user->postalCode?->code ?? $user->zipcode ) }}" placeholder="Zip code" disabled>
                                                @error('zipcode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                {{-- <div class="input-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                            height="15" viewBox="0 0 12 15" fill="none">
                                                            <path
                                                                d="M5.89286 15C6.01369 14.9993 6.13075 14.9578 6.225 14.8821C6.42857 14.7 11.7857 10.3821 11.7857 5.89286C11.7857 4.32997 11.1649 2.8311 10.0597 1.72598C8.95461 0.620853 7.45574 0 5.89286 0C4.32997 0 2.8311 0.620853 1.72598 1.72598C0.620853 2.8311 0 4.32997 0 5.89286C0 10.3821 5.35714 14.7 5.56071 14.8821C5.65497 14.9578 5.77202 14.9993 5.89286 15ZM1.07143 5.89286C1.07143 4.61413 1.5794 3.38779 2.48359 2.48359C3.38779 1.5794 4.61413 1.07143 5.89286 1.07143C7.17158 1.07143 8.39793 1.5794 9.30212 2.48359C10.2063 3.38779 10.7143 4.61413 10.7143 5.89286C10.7143 9.26786 7.03393 12.7554 5.89286 13.7625C4.75179 12.7554 1.07143 9.26786 1.07143 5.89286Z"
                                                                fill="#727272" />
                                                            <path
                                                                d="M8.57199 5.89305C8.57199 5.36328 8.41489 4.8454 8.12057 4.40492C7.82624 3.96443 7.40791 3.62111 6.91846 3.41837C6.42902 3.21564 5.89045 3.16259 5.37085 3.26595C4.85126 3.3693 4.37399 3.62441 3.99938 3.99901C3.62478 4.37362 3.36967 4.8509 3.26631 5.37049C3.16296 5.89008 3.216 6.42865 3.41874 6.9181C3.62147 7.40754 3.96479 7.82588 4.40528 8.1202C4.84577 8.41453 5.36365 8.57162 5.89342 8.57162C6.60382 8.57162 7.28512 8.28942 7.78745 7.78709C8.28978 7.28476 8.57199 6.60345 8.57199 5.89305ZM4.28627 5.89305C4.28627 5.57519 4.38053 5.26446 4.55713 5.00017C4.73372 4.73588 4.98472 4.52988 5.27839 4.40824C5.57206 4.2866 5.8952 4.25478 6.20696 4.31679C6.51871 4.3788 6.80508 4.53187 7.02984 4.75663C7.2546 4.98139 7.40767 5.26776 7.46968 5.57951C7.53169 5.89127 7.49986 6.21441 7.37822 6.50808C7.25658 6.80174 7.05059 7.05275 6.7863 7.22934C6.522 7.40594 6.21128 7.50019 5.89342 7.50019C5.46718 7.50019 5.05839 7.33087 4.75699 7.02947C4.4556 6.72807 4.28627 6.31929 4.28627 5.89305Z"
                                                                fill="#727272" />
                                                        </svg>
                                                    </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="accounts-btns">
                                            <button type="submit" disabled class="btn secondary-btn disabled-inputs">Save changes</button>
                                            <a href="#"  class="btn primary-btn disabled-inputs closeEditProfilebtn d-none">Cancel</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="change-pass-box">
                                            <a href="#" class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#change-pass-model">Change
                                                password</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="edit-icon">
                            <a href="#"><i id="editProfile" class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                            <span id="closeEditProfile" class='d-none closeEditProfilebtn'><i class="fa-sharp fa-solid fa-close"></i></span>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-5">
                        <div class="cstm-card banking-detail-card">
                            <div class="bank-img-txt">
                                <img src="images/banking-img.png" alt="">
                                <h3>Add bank/stripe account to receive payments</h3>
                                <p>All transactions are secure and encrypted.</p>
                            </div>
                            <div class="banking-form">
                                <form action="">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <div class="form-field">
                                                    <input type="text" class="form-control" placeholder="Name">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Bank Name</label>
                                                <div class="form-field">
                                                    <input type="text" class="form-control" placeholder="Bank Name">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Account Holder Name</label>
                                                <div class="form-field">
                                                    <input type="text" class="form-control"
                                                        placeholder="Account Holder Name">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Account Number</label>
                                                <div class="form-field">
                                                    <input type="text" class="form-control"
                                                        placeholder="Account Number">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Confirm Account Number</label>
                                                <div class="form-field">
                                                    <input type="text" class="form-control"
                                                        placeholder="Confirm Account Number">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="type-of-accounts">
                                                <label for="">Type of account</label>
                                                <div class="type-accounts-box">
                                                    <div class="type-accounts-radio">
                                                        <label class="radio-button-container">Checking
                                                            <input type="radio" name="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="type-accounts-radio">
                                                        <label class="radio-button-container">Savings
                                                            <input type="radio" name="radio">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-checkbox">
                                                <input type="checkbox" class="custm-check" id="form-check">
                                                <label for="form-check">Use shipping address as billing address</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="btn secondary-btn full-btn">Save Changes</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="#" class="btn primary-btn full-btn">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="edit-icon">
                                <a href="#"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                            </div>
                        </div>
                    </div> --}}
            </div>

        </div>
    </div>
</section>
@endsection

<div class="modal fade" id="change-pass-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        </div> -->
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="add-pro-form">
                    <h2>Change Password</h2>
                    <form id="changePassword" action="{{ route('Dealer.changepassword') }}" method='post'>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Old Password</label>
                                    <div class="form-field">
                                        <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="">
                                        @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="input-icon toggle-password">


                                            <svg class="eye-cross-icon" width="17" height="13" viewBox="0 0 28 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <mask id="mask0_17_18" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="0" width="25" height="19">
                                                    <path d="M26 0H1V19H26V0Z" fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_17_18)">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.03888 9.49718C2.03888 9.49718 6.20556 1.05273 13.4972 1.05273C20.7889 1.05273 24.9556 9.49718 24.9556 9.49718C24.9556 9.49718 20.7889 17.9416 13.4972 17.9416C6.20556 17.9416 2.03888 9.49718 2.03888 9.49718Z" stroke="#727272" stroke-width="1.80952" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.4981 12.6654C15.224 12.6654 16.6231 11.2476 16.6231 9.4987C16.6231 7.7498 15.224 6.33203 13.4981 6.33203C11.7722 6.33203 10.3731 7.7498 10.3731 9.4987C10.3731 11.2476 11.7722 12.6654 13.4981 12.6654Z" stroke="#727272" stroke-width="1.80952" stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                                <rect y="1.63831" width="2" height="31.5487" rx="1" transform="rotate(-55 0 1.63831)" fill="#727272" />
                                            </svg>

                                            <svg class="eye-icon d-none" xmlns="http://www.w3.org/2000/svg" width="17" height="13" viewBox="0 0 17 13" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 6.44444C1 6.44444 3.72222 1 8.48611 1C13.25 1 15.9722 6.44444 15.9722 6.44444C15.9722 6.44444 13.25 11.8889 8.48611 11.8889C3.72222 11.8889 1 6.44444 1 6.44444Z" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8.48698 8.48714C9.61456 8.48714 10.5286 7.57306 10.5286 6.44548C10.5286 5.31789 9.61456 4.40381 8.48698 4.40381C7.3594 4.40381 6.44531 5.31789 6.44531 6.44548C6.44531 7.57306 7.3594 8.48714 8.48698 8.48714Z" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <div class="form-field">
                                        <input type="password" id="cpassword" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="input-icon toggle-password">


                                            <svg class="eye-cross-icon " width="17" height="13" viewBox="0 0 28 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <mask id="mask0_17_18" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="0" width="25" height="19">
                                                    <path d="M26 0H1V19H26V0Z" fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_17_18)">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.03888 9.49718C2.03888 9.49718 6.20556 1.05273 13.4972 1.05273C20.7889 1.05273 24.9556 9.49718 24.9556 9.49718C24.9556 9.49718 20.7889 17.9416 13.4972 17.9416C6.20556 17.9416 2.03888 9.49718 2.03888 9.49718Z" stroke="#727272" stroke-width="1.80952" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.4981 12.6654C15.224 12.6654 16.6231 11.2476 16.6231 9.4987C16.6231 7.7498 15.224 6.33203 13.4981 6.33203C11.7722 6.33203 10.3731 7.7498 10.3731 9.4987C10.3731 11.2476 11.7722 12.6654 13.4981 12.6654Z" stroke="#727272" stroke-width="1.80952" stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                                <rect y="1.63831" width="2" height="31.5487" rx="1" transform="rotate(-55 0 1.63831)" fill="#727272" />
                                            </svg>

                                            <svg class="eye-icon d-none" xmlns="http://www.w3.org/2000/svg" width="17" height="13" viewBox="0 0 17 13" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 6.44444C1 6.44444 3.72222 1 8.48611 1C13.25 1 15.9722 6.44444 15.9722 6.44444C15.9722 6.44444 13.25 11.8889 8.48611 11.8889C3.72222 11.8889 1 6.44444 1 6.44444Z" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8.48698 8.48714C9.61456 8.48714 10.5286 7.57306 10.5286 6.44548C10.5286 5.31789 9.61456 4.40381 8.48698 4.40381C7.3594 4.40381 6.44531 5.31789 6.44531 6.44548C6.44531 7.57306 7.3594 8.48714 8.48698 8.48714Z" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Confirm New Password</label>
                                    <div class="form-field">
                                        <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="">
                                        @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="input-icon toggle-password">


                                            <svg class="eye-cross-icon" width="17" height="13" viewBox="0 0 28 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <mask id="mask0_17_18" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="1" y="0" width="25" height="19">
                                                    <path d="M26 0H1V19H26V0Z" fill="white" />
                                                </mask>
                                                <g mask="url(#mask0_17_18)">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.03888 9.49718C2.03888 9.49718 6.20556 1.05273 13.4972 1.05273C20.7889 1.05273 24.9556 9.49718 24.9556 9.49718C24.9556 9.49718 20.7889 17.9416 13.4972 17.9416C6.20556 17.9416 2.03888 9.49718 2.03888 9.49718Z" stroke="#727272" stroke-width="1.80952" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M13.4981 12.6654C15.224 12.6654 16.6231 11.2476 16.6231 9.4987C16.6231 7.7498 15.224 6.33203 13.4981 6.33203C11.7722 6.33203 10.3731 7.7498 10.3731 9.4987C10.3731 11.2476 11.7722 12.6654 13.4981 12.6654Z" stroke="#727272" stroke-width="1.80952" stroke-linecap="round" stroke-linejoin="round" />
                                                </g>
                                                <rect y="1.63831" width="2" height="31.5487" rx="1" transform="rotate(-55 0 1.63831)" fill="#727272" />
                                            </svg>
                                            <svg class="eye-icon d-none" xmlns="http://www.w3.org/2000/svg" width="17" height="13" viewBox="0 0 17 13" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 6.44444C1 6.44444 3.72222 1 8.48611 1C13.25 1 15.9722 6.44444 15.9722 6.44444C15.9722 6.44444 13.25 11.8889 8.48611 11.8889C3.72222 11.8889 1 6.44444 1 6.44444Z" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M8.48698 8.48714C9.61456 8.48714 10.5286 7.57306 10.5286 6.44548C10.5286 5.31789 9.61456 4.40381 8.48698 4.40381C7.3594 4.40381 6.44531 5.31789 6.44531 6.44548C6.44531 7.57306 7.3594 8.48714 8.48698 8.48714Z" stroke="#727272" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn secondary-btn full-btn">Confirm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
        </div>
    </div>
</div>
@include('layouts.include.footer')

@push('scripts')
{{-- <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/slick.js"></script>
    <script src="js/slick.min.js"></script> --}}

<script>
    $('.slick-carousel').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,

        dots: false,
        prevArrow: $('.prev-btn'),
        nextArrow: $('.next-btn'),
    });
</script>
<script>
    $(document).ready(function() {

        $('#editProfile').click(function(e) {
            e.preventDefault();
            $(this).addClass('d-none')
            $('.closeEditProfilebtn').removeClass('d-none')
            $('.disabled-inputs').removeAttr('disabled');
            $('.editable').removeClass('d-none');
            $('.dropmenu').removeClass('disabled_select');
            $('#dropdownMenuButton1').prop('disabled', false);
        });

    });
    $(document).ready(function() {
        $('.closeEditProfilebtn').click(function(e) {
            e.preventDefault();
            $('.dropmenu').addClass('disabled_select');
            $('.closeEditProfilebtn').addClass('d-none')
            $('#editProfile').removeClass('d-none')
            $('.disabled-inputs').attr('disabled', 'disabled');
            $('#dropdownMenuButton1').prop('disabled', true);
            $('.editable').addClass('d-none');

        });
    });
</script>
<script>
    $("#file-upload").change(function() {
        if (this.files && this.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $('#Userimage').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
<script>
    jQuery(document).ready(function() {
        jQuery('.custom_dropdown_item').attr('readonly',true);
        jQuery('.custom_dropdown_item').attr('disabled',true);
        // jQuery('.custom_dropdown_item').on('click', function() {
        //     var selectitem = jQuery(this).attr('data-value')
        //     jQuery('#selectedItem').text(selectitem)
        //     jQuery(document).find('input[name="industry_type"]').val(selectitem);

        // })
    });
</script>
@includeFirst(['validation'])
@includeFirst(['validation.dealer.js_profile'])
@includeFirst(['validation.js_change_password'])
@includeFirst(['validation.dealer.js_show_password'])
@endpush