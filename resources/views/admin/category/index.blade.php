@extends('layouts.admin')

@section('title', 'Category')
{{-- 
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            <x-alert-component />
                            <div class="card-header">
                                <h4>Categories</h4>
                                <div class="card-header-form padding">
                                    <a class="btn btn-primary btn-lg float-end" href="{{ route('admin.category.add') }}">Add
                                        Category</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tr>
                                            <th>name</th>
                                            <th>icon</th>
                                            <th>Parent Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $category->name ? $category->name : '' }}</td>
                                                <td>{!! $category->icon ?? $category->icon !!}</td>
                                                <td>{{ $category->parent ? $category->parent->name : '' }}</td>
                                                <td>
                                                    <label>
                                                        <input type="checkbox" class="custom-switch-input"
                                                            @if ($category->status == '1') checked="checked" @endif
                                                            onchange="toggleStatus(this, 'Category', '{{ jsencode_userdata($category->id) }}');">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="{{ route('admin.category.edit', [jsencode_userdata($category->id)]) }}"
                                                            class="btn btn-primary">Edit</a>
                                                        <a href="{{ route('admin.category.delete', [jsencode_userdata($category->id)]) }}"
                                                            class="btn btn-danger delete">Delete</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="no-record-found">
                                                    <center>Did not found any Category</center>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </table>
                                    <div class="card-footer text-right">
                                        <nav class="d-inline-block">
                                            {!! $categories->links('admin.pagination') !!}
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
@endsection --}}

@section('content')

    <div class="dashboard-right-box">
        <h2>Categories</h2>
        <div class="card-header-form padding">
            <a class="btn btn-primary btn-lg float-end" href="{{ route('admin.category.add') }}">Add
                Category</a>
        </div>
        <div class="product-detail-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Name</p>
                        </th>
                        <th>
                            <p>icon</p>
                        </th>
                        <th>
                            <p>Parent Category</p>
                        </th>
                        <th>
                            <p>Status</p>
                        </th>
                        <th>
                            <p>Action</p>
                        </th>

                    </tr>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                <p>{{ $category->name ? $category->name : '' }}</p>
                            </td>
                            <td>
                                <p>{!! $category->icon ?? $category->icon !!}</p>
                            </td>
                            <td>
                                <p>{{ $category->parent ? $category->parent->name : '' }}</p>
                            </td>
                            <td>
                                <p>
                                    <input type="checkbox" class="custom-switch-input"
                                        @if ($category->status == '1') checked="checked" @endif
                                        onchange="toggleStatus(this, 'Category', '{{ jsencode_userdata($category->id) }}');">
                                    <span class="custom-switch-indicator"></span>
                                </p>
                            </td>
                            <td>
                                <p><a href="{{ route('admin.category.edit', [jsencode_userdata($category->id)]) }}"
                                        class="btn btn-primary">Edit</a>
                                    <a href="{{ route('admin.category.delete', [jsencode_userdata($category->id)]) }}"
                                        class="btn btn-danger delete">Delete</a>
                                </p>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="no-record-found">
                                <center>Did not found any Category </center>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
        <div class="pagination-wrapper">
            <div class="pagination-boxes">
                <div class="pagination-box">
                    <i class="fa-solid fa-angle-left"></i>
                </div>
                <div class="pagination-box active">
                    <p>1</p>
                </div>
                <div class="pagination-box">
                    <p>2</p>
                </div>
                <div class="pagination-box">
                    <p>3</p>
                </div>
                <div class="pagination-box">
                    <p>4</p>
                </div>
                <div class="pagination-box">
                    <p>5</p>
                </div>
                <div class="pagination-box">
                    <i class="fa-solid fa-angle-right"></i>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        jQuery(document).ready(function() {
            jQuery(".disablebtn").click(function(e) {
                e.preventDefault();
                jQuery('body').addClass('modal-open');
                let url = jQuery(this).attr('href');
                swal({
                    title: 'Unable to delete',
                    text: 'currently category is in use ',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                    buttons: "ok"
                })
            });
        });
    </script>
@endpush
