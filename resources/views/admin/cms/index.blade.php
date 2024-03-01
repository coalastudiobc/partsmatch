@extends('layouts.admin')

@section('title', 'Cms Management')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12">
                        <div class="card">
                            {{-- <x-alert-component /> --}}
                            <div class="card-header">
                                {{-- <h4>{{ $delete ? 'Deleted Pages' : 'All Pages' }}</h4> --}}
                                {{-- <x-search-form :dateField="false"/>     --}}
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tr>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Image</th>
                                            {{-- @if (!$delete) --}}
                                            <th>Status</th>
                                            {{-- @endif --}}
                                            <th>Action</th>
                                        </tr>
                                        @forelse($cms_pages as $page)
                                            <tr>
                                                <td>{{ $page->name ? $page->name : '' }}</td>
                                                <td>{{ $page->page_title ? Str::limit($page->page_title, 50, '....') : '' }}
                                                </td>
                                                <td>{{ $page->page_content ? Str::limit($page->page_content, 50, '....') : '' }}
                                                </td>
                                                <td>
                                                    @if ($page->media_url)
                                                        <img alt="image" src="{{ Storage::url($page->media_url) }}"
                                                            width="100" height="100">
                                                    @endif
                                                </td>
                                                {{-- @if (!$delete) --}}
                                                <td>
                                                    <label>
                                                        <input type="checkbox" class="custom-switch-input"
                                                            @if ($page->status == '1') checked="checked" @endif
                                                            onchange="toggleStatus(this, 'CmsPage', '{{ $page->id }}');"
                                                            url="{{ route('admin.cms.status') }}">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                </td>
                                                {{-- @endif --}}
                                                <td>
                                                    {{-- @if ($delete) --}}
                                                    {{-- <a href="{{ route('admin.cms.restore', [jsencode_userdata($page->id)]) }}"
                                                        class="btn btn-primary restore">Restore</a> --}}
                                                    {{-- @else --}}
                                                    <a href="{{ route('admin.cms.edit', [$page->id]) }}"
                                                        class="btn btn-primary edit">Edit</a>
                                                    {{-- <a href="{{ route('admin.cms.delete', [($page->id)]) }}"
                                                        class="btn btn-danger delete">Delete</a> --}}
                                                    {{-- @endif --}}
                                                </td>

                                            </tr>
                                        @empty
                                            {{-- <tr>
                                                <td class="empty_records" colspan="5">
                                                    @if ($delete)
                                                        No Cms page deleted yet!
                                                    @else
                                                        No Cms page yet!
                                                    @endif
                                                </td>
                                            </tr> --}}
                                        @endforelse
                                    </table>
                                    <div class="card-footer text-right">
                                        <nav class="d-inline-block">
                                            {{-- {!! $cms_pages->links('admin.pagination') !!} --}}
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
