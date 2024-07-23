@extends('layouts.dealer')
@section('title', 'Order Management')
@section('heading', 'Order Management')
@section('content')
    <div class="dashboard-right-box">

        <div class="product-detail-table product-list-table">
            <div class="adress-info-haeder">
                <a class="back-btn" href="{{ route('Dealer.order.orderlist') }}"><i
                        class="fa-solid fa-angle-left back-btn"></i> Back</a>
                <div class="order-label-center">
                    <h3>Create New Full Fillment</h3>
                    <p>Step 2 of 2</p>
                </div>
                <a href="{{ route('Dealer.order.shippment.rates') }}"
                    class="btn primary-btn payment-btn disabled-shippmentPayment">Payment</a>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>OrderId</th>
                            <th>Total product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total Price</th>
                            <th>product Uploaded at</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($orderProducts as $item)
                            <tr>
                                <td>
                                    <div class="pro-list-name">
                                        <h4>{{ $item->order_id }}</h4>
                                    </div>
                                </td>
                                <td>
                                    <p>{{ $item->product->name }}</p>
                                </td>

                                <td>
                                    <p>{{ $item->quantity }}</p>
                                </td>
                                <td>
                                    <p>${{ $item->product_price }}</p>
                                </td>
                                <td>
                                    <p>${{ $item->quantity * $item->product_price }}</p>
                                </td>
                                <td>
                                    <p>{{ $item->product->created_at->format('d/m/y') }}</p>
                                </td>
                                <td>
                                    <div class="pro-status">
                                        <div class="dropdown" title="Add dimension of package">
                                            @php
                                                $flag = IspackageParcel($item->id, $item->product->id) ? 1 : 0;
                                            @endphp
                                            <a href="#" class="btn primary-btn harvinder" id="{{ $item->id }}"
                                                data-productName="{{ $item->product->name }}"
                                                data-productId="{{ $item->id }}" data-bs-toggle="modal"
                                                data-bs-target="#Package-modal" data-flag="{{ $flag }}">
                                                @if ($flag)
                                                    Edit
                                                @else
                                                    <img src="{{ asset('assets/images/add-round-icon.svg') }}"
                                                        alt="">
                                                    Add Dimension
                                                @endif
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!--package dimensions Modal -->
    <div class="modal fade Package-modal" id="Package-modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="packageDimension" action="">
                        @csrf
                        <div class="package-main">
                            <h3>Package Dimentions of <b class="productName"></b></h3>
                            <p>Rates are calculated based on package dimensions and weight. It's recommended to enter the
                                correct weight and dimensions. If not, you may receive adjustment charges.</p>
                            <div class="custm-dimention-box">
                                <p>Dimention</p>
                                <div class="custm-dimention mb-3">

                                    <div class="form-group">
                                        <div class="formfield">
                                            <input type="text" name="length" id="" class="form-control"
                                                placeholder="length">
                                            <span class="dimention-parameter">
                                                L
                                            </span>
                                        </div>
                                    </div>
                                    <p>X</p>
                                    <div class="form-group">
                                        <div class="formfield">
                                            <input type="text" name="width" id="" class="form-control"
                                                placeholder="width">
                                            <span class="dimention-parameter">
                                                W
                                            </span>
                                        </div>
                                    </div>
                                    <p>X</p>
                                    <div class="form-group">
                                        <div class="formfield">
                                            <input type="text" name="height" id="" class="form-control"
                                                placeholder="height">
                                            <span class="dimention-parameter">
                                                H
                                            </span>
                                        </div>
                                    </div>
                                    <p>X</p>
                                    <div class="form-group">
                                        <div class="formfield">
                                            <select name="distance_unit" id="" class="form-control">
                                                <option value="in">in</option>
                                                <option value="mm">mm</option>
                                                <option value="cm">cm</option>
                                            </select>
                                            <span class="custm-drop-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23"
                                                    viewBox="0 0 24 23" fill="none">
                                                    <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515"
                                                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="custm-dimention-box">
                                <p>Package Weight</p>
                                <div class="custm-dimention mb-3">

                                    <div class="form-group">
                                        <div class="formfield">
                                            <input type="text" name="weight" id="" class="form-control"
                                                placeholder="weight">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="formfield">
                                            <select name="mass_unit" id="" class="form-control">
                                                <option value="g">g</option>
                                                <option value="kg">kg</option>
                                                <option value="oz">oz</option>
                                            </select>
                                            <span class="custm-drop-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23"
                                                    viewBox="0 0 24 23" fill="none">
                                                    <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515"
                                                        stroke-width="1.8" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                    </path>
                                                </svg>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group checkbox-field">
                                <div class="formfield">
                                    <input type="checkbox" class="" name="" id="checkbox3">
                                </div>
                                <label for="checkbox3">Create a return label</label>
                            </div>
                            <div class="d-flex align-items-center gap-2 justify-content-end">
                                {{-- <a href="#" class="btn secondary-btn md-btn mr-1">Back</a> --}}
                                <button class="btn primary-btn sm-btn mr-1" id="submit" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    @includeFirst(['validation.dealer.js_package_dimension'])
    <script>
        $('.back-btn').on('click', function() {
            $("#fullPageLoader").removeClass('d-none');
        });
    </script>
@endpush
