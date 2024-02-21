@extends('layouts.admin')
@section('title', $blog->id ? 'Edit Blog' : 'Add Blog')

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
                                <h4>{{ $blog->id ? 'Edit Blog' : 'Add Blog' }}</h4>
                            </div>
                            <div class="card-body">
                                <form id="blog" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group form-group col-md-6">

                                            <label>Title<span class="required-field">*</span></label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title', $blog->title ? $blog->title : '') }}">
                                        </div>
                                        <div class="form-group form-group col-md-6">

                                            <label>Short Content<span class="required-field">*</span></label>
                                            <input type="text" name="short_content"
                                                class="form-control @error('short_content') is-invalid @enderror"
                                                value="{{ old('short_content', $blog->short_content ? $blog->short_content : '') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group form-group col-md-12">
                                            <label>Deccription<span class="required-field">*</span></label>
                                            <textarea name="description" class="form-control summernote @error('description') is-invalid @enderror">{{ $blog->description ?? $blog->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group form-group col-md-6">
                                            <label>Image</label>
                                            <input type="file" name="media_url"
                                                class="form-control @error('media_url') is-invalid @enderror">
                                        </div>
                                        <div class="form-group form-group col-md-6">
                                            <label>Banner Image</label>
                                            <input type="file" name="banner_url"
                                                class="form-control @error('banner_url') is-invalid @enderror">
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <a class="btn btn-primary mr-1" href="{{ route('admin.blog.all') }}">Back</a>
                                        <button class="btn btn-primary mr-1" id="submit"
                                            type="submit">{{ $blog->id ? 'Update' : 'Add' }}</button>
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
    @includeFirst(['validation.js_blogs'])
    <script>
        jQuery(document).ready(function() {
            jQuery('#submit').click(function(e) {
                e.preventDefault();
                if (jQuery('#blog').valid()) {
                    var formData = new FormData($('form#blog').get(0));
                    url =
                        "{{ $blog->id ? route('admin.blog.store', [jsencode_userdata($blog->id)]) : route('admin.blog.store') }}";
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
