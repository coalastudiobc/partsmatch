@extends('layouts.admin')
@section('title', $category->id ? 'Update Category' : 'Add Category')
@section('heading', 'Category')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-12">
                        <div class="card">
                            <div class='ajax-response'></div>
                            <x-alert-component />
                            {{-- <div class="card-header">
                                <h4>{{ $category->id ? 'Update Category' : 'Add Category' }}</h4>
                            </div> --}}
                            <div class="card-body">
                                <form id="category" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{-- @dd($selective) --}}
                                            @if ($selective == null || !$selective->isEmpty())

                                                <div class="form-group">
                                                    <label for="">Parent Category</label>

                                                    {{-- <select name="main_category"
                                                        class="form-control @error('main_category') is-invalid @enderror">
                                                        <option value="">Select </option>
                                                        @foreach ($selective as $categories)
                                                            @if ($category->id == $categories->id)
                                                                @continue
                                                            @endif
                                                            <option class="parent-category" value="{{ $categories->id }}"
                                                                @if ($categories->id == $category->parent_id) selected @endif>
                                                                {{ $categories->name }}</option>
                                                        @endforeach
                                                    </select> --}}
                                                    <input type="hidden" name="main_category" value=""
                                                        id="">
                                                    <div class="custm-dropdown">
                                                        <div class="dropdown">
                                                            <div class="dropdown-toggle " type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <div id="selectedItem">
                                                                    {{ $category->id ? ($category->parent ? $category->parent->name : 'select') : 'select' }}
                                                                </div>
                                                                <span class="custm-drop-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="23" viewBox="0 0 24 23" fill="none">
                                                                        <path d="M19 9.00006L14 14.0001L9 9.00006"
                                                                            stroke="#151515" stroke-width="1.8"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                @foreach ($selective as $option)
                                                                    <li><a class="dropdown-item custom_dropdown_item @if ($option->id == $category->parent_id) active @endif"
                                                                            @if ($option->id == $category->parent_id) selected @endif
                                                                            data-value="{{ $option->id }}"
                                                                            data-text="{{ $option->name }}"
                                                                            href="javascript:void(0)">{{ $option->name }}</a>
                                                                    </li>
                                                                @endforeach

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @error('main_category')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            @endif

                                        </div>
                                        <div class="@if ($selective == null || !$selective->isEmpty()) col-md-6 @else col-md-12 @endif">
                                            <div class="form-group">
                                                <label for="">Name*</label>
                                                <div class="form-field">
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', $category->name ?? $category->name) }}">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="input-icon-custm tooltip-open">
                                                        <span>
                                                            <i class="fa-solid fa-question"></i>
                                                        </span>
                                                        <div class="tooltip">
                                                            <p>ghfvjvhm</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Icon</label>
                                                <div class="form-field">
                                                    <input type="text" name="icon"
                                                        class="form-control @error('icon') is-invalid @enderror"
                                                        value="{{ old('icon', $category->icon ?? $category->icon) }}">
                                                    <div class="input-icon-custm tooltip-open">
                                                        <span>
                                                            <i class="fa-solid fa-question"></i>
                                                        </span>
                                                        <div class="tooltip">
                                                            <p>ghfvjvhm</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <div class="form-field">
                                                    {{-- <select name="status"
                                                        class="form-control @error('status') is-invalid @enderror">
                                                        <option value="1"
                                                            @if ($category->status == '1') selected @endif>Active
                                                        </option>
                                                        <option
                                                            value="0"@if ($category->status == '0') selected @endif>
                                                            Inactive</option>
                                                    </select> --}}
                                                    <input type="hidden" name="status"
                                                        value="{{ (!isset($category->status) ? '1' : $category->status == '1') ? '1' : '0' }}"
                                                        id="">
                                                    <div class="custm-dropdown">
                                                        <div class="dropdown">
                                                            <div class="dropdown-toggle " type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <div id="selectedstatus">
                                                                    {{ $category->id ? ($category->status == '1' ? 'Active' : 'Inactive') : 'select' }}
                                                                </div>
                                                                <span class="custm-drop-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="23" viewBox="0 0 24 23" fill="none">
                                                                        <path d="M19 9.00006L14 14.0001L9 9.00006"
                                                                            stroke="#151515" stroke-width="1.8"
                                                                            stroke-linecap="round"
                                                                            stroke-linejoin="round" />
                                                                    </svg>
                                                                </span>
                                                            </div>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                                                                <li><a class="dropdown-item custom_dropdown_status"
                                                                        @if ($category->status == '1') selected @endif
                                                                        data-value="1" data-text="Active"
                                                                        href="javascript:void(0)">Active</a>
                                                                </li>
                                                                <li><a class="dropdown-item custom_dropdown_status"
                                                                        @if ($category->status == '0') selected @endif
                                                                        data-value="0" data-text="Inactive"
                                                                        href="javascript:void(0)">Inactive</a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                    @error('status')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </div>
                                            </div>
                                        </div>


                                        {{-- <div class="col-md-12">
                                            <a class="btn btn-danger mr-1"
                                                href="{{ route('admin.category.index') }}">Back</a>
                                            <button class="btn btn-primary mr-1" id="submit">Submit</button>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <a class="btn secondary-btn full-btn  mr-1"
                                                href="{{ url()->previous() }}">Back</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn primary-btn full-btn mr-1"
                                                id="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    @includeFirst(['validation.js_category'])
    <script>
        jQuery(document).ready(function() {
            //     $('#submit').on('click', function(e) {
            //         e.preventDefault();
            //         jQuery('#category').validate();
            //         if (jQuery('#category').valid()) {
            //             jQuery('#category').submit();
            //         }
            //     });
            jQuery('#submit').click(function(e) {
                e.preventDefault();
                if (jQuery('#category').valid()) {
                    var formData = new FormData($('form#category').get(0));
                    url =
                        "{{ $category->id ? route('admin.category.store', [jsencode_userdata($category->id)]) : route('admin.category.store') }}";
                    addUserAjaxCall(url, 'post', formData);
                }
            });

            // dropdown
            jQuery(document).ready(function() {
                jQuery('.custom_dropdown_item').on('click', function() {
                    var selectitem = jQuery(this).attr('data-value')
                    var selecttext = jQuery(this).attr('data-text')
                    jQuery('#selectedItem').text(selecttext)
                    jQuery(document).find('input[name="main_category"]').val(selectitem);
                })

                jQuery('.custom_dropdown_status').on('click', function() {
                    var selectitem = jQuery(this).attr('data-value')
                    var selecttext = jQuery(this).attr('data-text')
                    jQuery('#selectedstatus').text(selecttext)
                    jQuery(document).find('input[name="status"]').val(selectitem);

                });
            });
        });
    </script>
@endpush
