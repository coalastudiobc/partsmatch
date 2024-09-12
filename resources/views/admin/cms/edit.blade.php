@extends('layouts.admin')
@section('title', 'Update ' . $page->name)
@section('heading', 'CMS')

@section('content')
    <div class="main-content">
        <section class="section edit-cms">
            <div class="section-body">
            <div class="card">
                            <div class='ajax-response'></div>
                            <x-alert-component />

                            <div class="card-body">
                                <div class="dealer-profile-form-box">
                                    <div class="dealer-profile-detail-form">
                                    <form id="cms" action="{{ route('admin.cms.update', [$page->id]) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Name*</label>
                                                <div class="form-field">
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', $page->name ? $page->name : '') }}">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="input-icon-custm">
                                                        <span data-toggle="tooltip" data-placement="left" title="" data-bs-original-title="ghfvjvhm">
                                                            <i class="fa-solid fa-question"></i>
                                                        </span>
                                                        {{-- <div class="tooltip-text">
                                                            <p></p>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Page Title</label>
                                                <div class="form-field">
                                                    <input type="text" name="page_title"
                                                        class="form-control @error('page_title') is-invalid @enderror"
                                                        value="{{ old('page_title', $page->page_title ?? $page->page_title) }}">
                                                    @error('page_title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="input-icon-custm">
                                                        <span data-toggle="tooltip" data-placement="left" title="" data-bs-original-title="ghfvjvhm">
                                                            <i class="fa-solid fa-question"></i>
                                                        </span>
                                                        {{-- <div class="tooltip-text">
                                                            <p></p>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Slug</label>
                                                <div class="form-field">
                                                    <input type="text" name="slug"
                                                        class="form-control @error('slug') is-invalid @enderror"
                                                        value="{{ old('slug', $page->slug ?? $page->slug) }}" disabled>

                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Content*</label>
                                                <div class="form-field">
                                                    <textarea name="content" class="form-control summernote @error('content') is-invalid @enderror" cols=""
                                                        rows="6">{{ $page->page_content ?? $page->page_content }}</textarea>
                                                    @error('content')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="input-icon-custm">
                                                        <span data-toggle="tooltip" data-placement="left" title="" data-bs-original-title="ghfvjvhm">
                                                            <i class="fa-solid fa-question"></i>
                                                        </span>
                                                        {{-- <div class="tooltip-text">
                                                            <p>ghfvjvhm</p>
                                                        </div> --}}
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
                                                        <option
                                                            value="0"@if ($page->status == 0) selected @endif>
                                                            Inactive</option>
                                                        <option value="1"
                                                            @if ($page->status == 1) selected @endif>
                                                            Active</option>
                                                    </select> --}}
                                                    <input type="hidden" name="status"
                                                        value="{{ $page->status == '1' ? '1' : '0' }}" id="">
                                                    <div class="custm-dropdown">
                                                        <div class="dropdown">
                                                            <div class="dropdown-toggle " type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <div id="selectedstatus">
                                                                    {{ $page->status == '1' ? 'Active' : 'Inactive' }}

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
                                                                        @if ($page->status == '1') selected @endif
                                                                        data-value="1" data-text="Active"
                                                                        href="javascript:void(0)">Active</a>
                                                                </li>
                                                                <li><a class="dropdown-item custom_dropdown_status"
                                                                        @if ($page->status == '0') selected @endif
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
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Image</label>
                                                <div class="form-field">
                                                    <input type="file" name="image"
                                                        class="form-control @error('image') is-invalid @enderror">
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <div class="input-icon-custm ">
                                                        <span data-toggle="tooltip" data-placement="left" title="" data-bs-original-title="ghfvjvhm">
                                                            <i class="fa-solid fa-question"></i>
                                                        </span>
                                                        {{-- <div class="tooltip-text">
                                                            <p>ghfvjvhm</p>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <a class="btn secondary-btn full-btn mr-1"
                                                href="{{ route('admin.cms.index') }}">Back</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn primary-btn full-btn mr-1" id="submit"
                                                type="submit">Submit</button>
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
    @includeFirst(['validation.js_cms'])
    <script>
        // jQuery(document).ready(function() {
        //     jQuery('#submit').click(function(e) {
        //         e.preventDefault();
        //         if (jQuery('#cms').valid()) {
        //             var formData = new FormData($('form#cms').get(0));
        //             url = "{{ route('admin.cms.update', [$page->id]) }}";
        //             var response = ajaxCall(url, 'post', formData);
        //             response.then(editCmsPage).catch(editCmsPageError)

        //             function editCmsPage(response) {
        //                 if (response.success == true) {
        //                     if (response.url) {
        //                         window.location.replace(response.url);
        //                     }
        //                 } else if (response.success == false) {
        //                     return iziToast.error({
        //                         message: response.msg,
        //                         position: 'topRight'
        //                     });
        //                 }
        //             }

        //             function editCmsPageError(error) {
        //                 console.log('error', error)
        //             }
        //         }
        //     });
        // });
        // dropdown
        jQuery(document).ready(function() {


            jQuery('.custom_dropdown_status').on('click', function() {
                var selectitem = jQuery(this).attr('data-value')
                var selecttext = jQuery(this).attr('data-text')
                jQuery('#selectedstatus').text(selecttext)
                jQuery(document).find('input[name="status"]').val(selectitem);

            });
        });
    </script>
@endpush
