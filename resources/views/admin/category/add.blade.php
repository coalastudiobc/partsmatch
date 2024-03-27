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
                            <div class="card-header">
                                <h4>{{ $category->id ? 'Update Category' : 'Add Category' }}</h4>
                            </div>
                            <div class="card-body">
                                <form id="category" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{-- @dd($selective) --}}
                                            @if ($selective == null || !$selective->isEmpty())

                                                <div class="form-group">
                                                    <label for="">Parent Category</label>

                                                    <select name="main_category"
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
                                                    </select>
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
                                                <label for="">Name</label>
                                                <div class="form-field">
                                                    <input type="text" name="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        value="{{ old('name', $category->name ?? $category->name) }}">
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
                                                <label for="">Icon</label>
                                                <div class="form-field">
                                                    <input type="text" name="icon"
                                                        class="form-control @error('icon') is-invalid @enderror"
                                                        value="{{ old('icon', $category->icon ?? $category->icon) }}">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <div class="form-field">
                                                    <select name="status"
                                                        class="form-control @error('status') is-invalid @enderror">
                                                        <option value="1"
                                                            @if ($category->status == '1') selected @endif>Active
                                                        </option>
                                                        <option
                                                            value="0"@if ($category->status == '0') selected @endif>
                                                            Inactive</option>
                                                    </select>
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
                                                href="{{ route('admin.category.index') }}">Back</a>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn primary-btn full-btn mr-1" id="submit">Submit</button>
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
            jQuery('#submit').click(function(e) {
                e.preventDefault();
                if (jQuery('#category').valid()) {
                    var formData = new FormData($('form#category').get(0));
                    url =
                        "{{ $category->id ? route('admin.category.store', [jsencode_userdata($category->id)]) : route('admin.category.store') }}";
                    addUserAjaxCall(url, 'post', formData);
                }
            });
        });
    </script>
@endpush
