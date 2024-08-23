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
                        <th>
                            <p>Name</p>
                        </th>
                        <th>
                            <p>Image</p>
                        </th>
                        <th>
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
                                    <img src="{{ asset('storage/' . $make->image_url) }}" alt="brand Image">
                                </div>
                            </td>

                            <td>
                                <a href="{{ route('admin.brands.edit.make', ['id' => json_encode($make->id)]) }}"
                                    class="btn primary-btn">
                                    edit</a>
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
