@extends('layouts.admin')

@section('title', 'Shipping')
@section('heading', 'Shipping')

@section('content')

    <div class="dashboard-right-box">
        <x-alert-component />

        <div class="card-header-form padding">
            <h2>Shipping</h2>
            <a class="btn primary-btn btn-lg float-end" href="{{ route('admin.shipping.add') }}">Add
                new range</a>
        </div>
        <div class="product-detail-table">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>
                            <p>Range</p>
                        </th>

                        <th>
                            <p>Type</p>
                        </th>
                        <th>
                            <p>value</p>
                        </th>

                        <th>
                            <p>Action</p>
                        </th>

                    </tr>

                    @forelse($shipping_details as $key => $shipping)
                        <tr>
                            <td>
                                <p>{{ $shipping->range_from ?? '' }} - {{ $shipping->range_to ?? '' }}</p>
                                {{-- </td>

                            <td> --}}
                                {{-- <p>{{ $shipping->range_to ?? '' }}</p> --}}
                            </td>
                            <td>
                                <p>{{ $shipping->type ?? '' }}</p>
                            </td>
                            <td>
                                <p>{{ $shipping->value ?? '' }}</p>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.shipping.edit', [jsencode_userdata($shipping->id)]) }}"
                                        title="edit"><i class="fa-solid fa-pen-to-square" style="color: #3EBE62;"></i></a>
                                    <a href="{{ route('admin.shipping.delete', [jsencode_userdata($shipping->id)]) }}"
                                        class="delete" data-bs-toggle="tooltip" data-bs-placement="top" title="delete"><i
                                            class="fa-regular fa-trash-can" style="color: #E13F3F;"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="no-record-found">
                                <center>Did not found any shipping </center>
                            </td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
        {!! $shipping_details->links('admin.pagination') !!}

    </div>

@endsection
