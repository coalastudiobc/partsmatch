@extends('layouts.admin')
@section('title', 'Update ' . $page->name)
@section('heading', 'Cms')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-12">
                        <div class="card">
                            <div class='ajax-response'></div>
                            <x-alert-component />

                            <div class="card-body">
                                <form id="cms" action="{{ route('admin.cms.update', [$page->id]) }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <div class="form-field">
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', $page->name ? $page->name : '') }}">
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
                                                <label for="">Slug</label>
                                                <div class="form-field">
                                                    <input type="text" name="slug"
                                                        class="form-control @error('slug') is-invalid @enderror"
                                                        value="{{ old('slug', $page->slug ?? $page->slug) }}" disabled>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Content</label>
                                                <div class="form-field">
                                                    <textarea name="content" class="form-control summernote @error('content') is-invalid @enderror">{{ $page->page_content ?? $page->page_content }}</textarea>
                                                    @error('content')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
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
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <div class="form-field">
                                                    <select name="status"
                                                        class="form-control @error('status') is-invalid @enderror">
                                                        <option
                                                            value="0"@if ($page->status == 0) selected @endif>
                                                            Inactive</option>
                                                        <option value="1"
                                                            @if ($page->status == 1) selected @endif>
                                                            Active</option>
                                                    </select>
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
    </script>
@endpush
