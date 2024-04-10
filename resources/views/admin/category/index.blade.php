@extends('layouts.admin')

@section('title', 'Category')
@section('heading', 'Category')

@section('content')

    <div class="dashboard-right-box">
        <x-alert-component />

        <div class="card-header-form padding">
            <h2>Categories</h2>
            <a class="btn primary-btn btn-lg float-end" href="{{ route('admin.category.add') }}">Add
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
                            <p>Icon</p>
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
                    @forelse($categories as $key => $category)
                        <tr>
                            <td>
                                <p>{{ $category->name ? $category->name : '' }}</p>
                            </td>
                            <td style="max-height: 100px;max-width: 100px">
                                <p style="max-height: 100px;max-width: 100px">{!! $category->icon ?? $category->icon !!}</p>
                            </td>
                            <td>
                                <p>{{ $category->parent ? $category->parent->name : '' }}</p>
                            </td>
                            <td>
                                <p>

                                    {{-- <span class="custom-switch-indicator"></span> --}}
                                <div class="toggle-btn">
                                    <input type="checkbox" title="status" id="switch10{{ $key }}"
                                        class="custom-switch-input"
                                        @if ($category->status == '1') checked="checked" @endif
                                        onchange="toggleStatus(this, 'Category', '{{ $category->id }}');"
                                        url="{{ route('category.status') }}"><label
                                        for="switch10{{ $key }}">Toggle</label>
                                </div>

                                </p>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.category.edit', [jsencode_userdata($category->id)]) }}"
                                        title="edit"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                    <a href="{{ route('admin.category.delete', [jsencode_userdata($category->id)]) }}"
                                        class="delete" data-bs-toggle="tooltip" data-bs-placement="top" title="delete"><i
                                            class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="no-record-found">
                                <center>Did not found any category </center>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {{-- <div class="pagination-wrapper">
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
        </div> --}}
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
