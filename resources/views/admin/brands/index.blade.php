@extends('layouts.admin')
@section('title', 'Brands')
@section('heading', 'All Brands')

@section('content')
    <div class="dashboard-right-box " >
        <div class="serach-and-filter-box justify-content-end">
            <form action="">
                <div class="pro-search-box">
                    <input type="text" name="filter_by_name" class="form-control"
                        value="{{ old('filter_by_name', request()->filter_by_name) }}" placeholder="Search Product By Name">
                    <button type="submit" class="btn primary-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </form>
        </div>
        {{-- <div class="card-header-form padding">
            <a class="btn primary-btn btn-lg float-end" href="{{ route('admin.brands.add') }}">Add
                brands</a>
        </div> --}}
        <div class="product-detail-table product-list-table brand-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th width="30%">
                            <p>Name</p>
                        </th>
                        <th width="30%">
                            <p>Image</p>
                        </th>
                        <th width="30%">
                            <p>Status</p>
                        </th>
                        <th width="10%">
                            <p>Action</p>
                        </th>
                    </tr>
                    @forelse ($makes as $key => $make)
                        <tr>
                            <td>
                                <p>{{ $make->makes ? $make->makes : 'N/A' }}</p>
                            </td>
                            <td>
                                <div class="brands-imgs">
                                    <img src="{{ $make->image_url ? asset('storage/' . $make->image_url) : asset('assets/images/car-logo2.png') }}" alt="brand Image">
                                </div>
                            </td>
                            <td>
                                <div class="toggle-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Click to Active /Inactive listing of brands in marketplace">
                                    <input type="checkbox" id="switch100{{ $key }}" class="custom-switch-input"
                                    @if ($make->status == '1') checked="checked" @endif
                                        onchange="toggleStatus(this, 'CarBrandMake', '{{ $make->id }}');"
                                        url="{{ route('admin.brands.listing.status') }}" ><label
                                        for="switch100{{ $key }}">Toggle</label>
                                </div>
                            </td>
                            <td>
                                <a href="{{ route('admin.brands.edit.make', ['id' => json_encode($make->id)]) }}"
                                    class="btn primary-btn">
                                    Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="no-record-found">
                                <center>Did not found any parts </center>
                            </td>
                        </tr>
                    @endforelse
                </table>
                {!! $makes->appends('filter_by_name', request()->filter_by_name)->links('admin.pagination') !!}

            </div>
        </div>
    </div>
@endsection
