@extends('layouts.admin')

@section('title', 'Cms Management')
@section('heading', 'Cms')

@section('content')

    <div class="dashboard-right-box">
        <h2>CMS</h2>

        {{-- <x-alert-component /> --}}
        <div class="product-detail-table cms-list-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Name</p>
                        </th>
                        <th>
                            <p>Title</p>
                        </th>
                        <th>
                            <p>Content</p>
                        </th>
                        <th>
                            <p>Image</p>
                        </th>
                        <th>
                            <p>Status</p>
                        </th>
                        <th>
                            <p>Action</p>
                        </th>

                    </tr>
                    @forelse($cms_pages as $page)
                        <tr>
                            <td>
                                <p>{{ $page->name ? $page->name : '' }}</p>
                            </td>
                            <td>
                                <p>{{ $page->page_title ? Str::limit($page->page_title, 50, '....') : '' }}</p>
                            </td>
                            <td>
                                <p>{{ $page->page_content ? Str::limit($page->page_content, 50, '....') : '' }}</p>
                            </td>
                            <td>
                                <p>
                                    @if ($page->media_url)
                                        <img alt="image" src="{{ Storage::url($page->media_url) }}" width="100"
                                            height="100">
                                    @endif
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{-- <span class="custom-switch-indicator"></span> --}}
                                </p>
                                <div class="toggle-btn">
                                    <input type="checkbox" id="switch10{{ $page->id }}" class="custom-switch-input"
                                        @if ($page->status == '1') checked="checked" @endif
                                        onchange="toggleStatus(this, 'CmsPage', '{{ $page->id }}');"
                                        url="{{ route('cms.status') }}"><label
                                        for="switch10{{ $page->id }}">Toggle</label>
                                </div>

                            </td>
                            {{-- <td>
                                <p>{{ $user->industry_type ? $user->industry_type : 'N/A' }}</p>
                            </td> --}}
                            <td>
                                <a href="{{ route('admin.cms.edit', [$page->id]) }}" class="edit"><i style="color: green"
                                        class="fa-solid fa-pen-to-square"></i></a>

                            </td>

                            {{-- <td>
                                <div class="table-pro-quantity">
                                    1
                                </div>
                            </td> --}}
                        </tr>
                    @empty
                        <tr>
                            <td class="no-record-found">
                                <center>Did not found any User </center>
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
@endpush
