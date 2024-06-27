@extends('layouts.admin')

@section('title', 'Blog Management')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <x-alert-component />
                            <div class="card-header">
                                <div class="card-header right-align-btn-sub">
                                    <h4>Blogs</h4>
                                    <a class="btn btn-primary header-cart-btm" href="{{ route('admin.blog.add') }}">Add Blog</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tr>
                                            <th>Title</th>
                                            <th>Short Content</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Banner Image</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse($blogs as $blog)
                                            <tr>
                                                <td>{{ $blog->title ?? '' }}</td>
                                                <td>{{ $blog->short_content ? Str::limit($blog->short_content, 50, '....') : '' }}</td>
                                                <td>{{ $blog->description ? Str::limit($blog->description, 50, '....') : '' }}</td>
                                                <td>@if($blog->media_url)<img alt="image" src="{{Storage::url($blog->media_url)}}"  width="100" height="100">@endif</td>
                                                <td>@if($blog->banner_url)<img alt="image" src="{{Storage::url( $blog->banner_url)}}"  width="100" height="100">@endif</td>
                                                <td>
                                                    <a href="{{ route('admin.blog.add', [jsencode_userdata($blog->id)]) }}"
                                                        class="btn btn-primary edit">Edit</a>
                                                    <a href="{{ route('admin.blog.delete', [jsencode_userdata($blog->id)]) }}"
                                                        class="btn btn-danger delete">Delete</a>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="empty_records" colspan="5">
                                                        No blogs  yet!
                                                </td>
                                            </tr>
                                        @endforelse
                                    </table>
                                    <div class="card-footer text-right">
                                        <nav class="d-inline-block">
                                            {!! $blogs->links('admin.pagination') !!}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection