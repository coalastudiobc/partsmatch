@extends('layouts.admin')
@section('title', 'Update ' . $page->name)

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-6 col-md-6 col-lg-12">
                        <div class="card">
                            <div class='ajax-response'></div>
                            <x-alert-component />
                            <div class="card-header">
                                <h4>{{ 'Update ' . $page->name }}</h4>
                            </div>
                            <div class="card-body">
                                {{-- <form id="cms" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Name<span class="required-field">*</span></label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', $page->name ? $page->name : '') }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Slug<span class="required-field">*</span></label>
                                            <input type="text" name="slug"
                                                class="form-control @error('slug') is-invalid @enderror"
                                                value="{{ old('slug', $page->slug ?? $page->slug) }}" disabled>
                                        </div>
                                    </div>
                                
                                    <div class="row">

                                        <div class="form-group form-group col-md-12">
                                            <label>Content<span class="required-field">*</span></label>
                                            <textarea name="content" class="form-control summernote @error('content') is-invalid @enderror">{{ $page->page_content ?? $page->page_content }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group form-group col-md-12">
                                            <label>Page Title</label>
                                            <input type="text" name="page_title"
                                                class="form-control @error('page_title') is-invalid @enderror"
                                                value="{{ old('page_title', $page->page_title ?? $page->page_title) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="row">

                                        <div class="form-group form-group col-md-6">
                                            <label>Status<span class="required-field">*</span></label>
                                            <select name="status"
                                                class="form-control @error('status') is-invalid @enderror">
                                                <option value="0"@if ($page->status == 0) selected @endif>
                                                    Inactive</option>
                                                <option value="1" @if ($page->status == 1) selected @endif>
                                                    Active</option>
                                            </select>
                                        </div>
                                        <div class="form-group form-group col-md-6">
                                            <label>Image</label>
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <a class="btn btn-primary mr-1" href="{{ route('admin.cms.index') }}">Back</a>
                                        <button class="btn btn-primary mr-1" id="submit" type="submit">Submit</button>
                                    </div>
                                </form> --}}
                                <form id="cms" enctype="multipart/form-data" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Name</label>
                                                <div class="form-field">
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', $page->name ? $page->name : '') }}">

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

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Image</label>
                                                <div class="form-field">
                                                    <input type="file" name="image"
                                                        class="form-control @error('image') is-invalid @enderror">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <a class="btn btn-primary mr-1" href="{{ route('admin.cms.index') }}">Back</a>
                                            <button class="btn btn-primary mr-1" id="submit"
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
        jQuery(document).ready(function() {
            jQuery('#submit').click(function(e) {
                e.preventDefault();
                if (jQuery('#cms').valid()) {
                    var formData = new FormData($('form#cms').get(0));
                    url = "{{ route('admin.cms.update', [$page->id]) }}";
                    var response = ajaxCall(url, 'post', formData);
                    response.then(editCmsPage).catch(editCmsPageError)

                    function editCmsPage(response) {
                        if (response.success == true) {
                            if (response.url) {
                                window.location.replace(response.url);
                            }
                        } else if (response.success == false) {
                            return iziToast.error({
                                message: response.msg,
                                position: 'topRight'
                            });
                        }
                    }

                    function editCmsPageError(error) {
                        console.log('error', error)
                    }
                }
            });
        });
    </script>
@endpush
