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
                <a href="" class="btn primary-btn">Payment</a>
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

                                        <div class="dropdown">


                                            <a href="#" class="btn primary-btn" data-bs-toggle="modal"
                                                data-bs-target="#Package-modal"><i class="fa-solid fa-eye"></i> Add
                                                Dimension</a>

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


    <!-- Modal -->
    <div class="modal fade Package-modal" id="Package-modal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="package-main">
                        <h3>Package</h3>
                        <p>Rates are calculated based on package dimensions and weight. It's recommended to enter the
                            correct weight and dimensions. If not, you may receive adjustment charges.</p>
                        <div class="custm-dimention">
                            <div class="from-group">
                                <div class="fromfield">
                                    <input type="text" name="" id="" class="form-control">
                                </div>

                            </div>
                            <p>X</p>
                            <div class="from-group">
                                <div class="fromfield">
                                    <input type="text" name="" id="" class="form-control">
                                </div>

                            </div>
                            <p>X</p>
                            <div class="from-group">
                                <div class="fromfield">
                                    <input type="text" name="" id="" class="form-control">
                                </div>

                            </div>
                            <p>X</p>
                            <div class="from-group">
                                <div class="fromfield">
                                    <select name="" id="" class="form-control">
                                        <option value="">cm</option>
                                        <option value="">in</option>
                                        <option value="">mm</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.back-btn').on('click', function() {
            $("#fullPageLoader").removeClass('d-none');
        });
    </script>
@endpush
