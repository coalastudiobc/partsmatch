@extends('layouts.dealer')
@section('title', 'Order Management')
@section('heading', 'Order Management')
@section('content')

<div class="dashboard-right-box">
    <div class="custm-card">
        <div class="adress-info-main">
            <div class="adress-info-haeder">
                <a href="#"><i class="fa-solid fa-angle-left"></i> Back to orders</a>
                <div class="order-label-center">
                    <h3>Create New Label</h3>
                    <p>Steps 1 of 2</p>
                </div>
                <a href="#" class="btn primary-btn">Next:Order Details</a>
            </div>
            <div class="right-btn-box">
                <a href="#" class="btn primary-btn add-address-btn"><img src="{{ asset('assets/images/add-round-icon.svg') }}" alt=""> Add Address</a>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="adress-info-inner">
                        <div class="address-haeding-edit">
                            <h3>Adress 1</h3>
                            <a href="#">Edit</a>
                        </div>
                        <label for="adress">
                            <input type="radio" name="order-adress" id="adress">
                            <div class="adress-info-text">
                                <h2>Salinas Richardson Inc </h2>
                                <p>733 N Kedzie Ave, Chicago, IL 60612, United States </p>
                                <p>xigisywo@mailinator.com 0019168897416</p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="adress-info-inner add-addres-box">
                        <div class="address-haeding-edit">
                            <h3>Adress 2</h3>
                            <a href="#">Edit</a>
                        </div>
                        <label for="adress1">
                            <input type="radio" name="order-adress" id="adress1">
                            <div class="adress-info-text">
                                <h2>Salinas Richardson Inc</h2>
                                <p>733 N Kedzie Ave, Chicago, IL 60612, United States</p>
                                <p>xigisywo@mailinator.com +1 (916) 889-7416</p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="adress-info-inner add-address-box">
                        <form action="">
                            <div class="row">
                                <h3>Personal Information</h3>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">First Name</label>
                                        <div class="formfield">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Last Name</label>
                                        <div class="formfield">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <div class="formfield">
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <div class="formfield">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <h3>Address</h3>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Country</label>
                                        <div class="formfield">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <div class="formfield">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">State</label>
                                        <div class="formfield">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Street</label>
                                        <div class="formfield">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Postal Code / Zip</label>
                                        <div class="formfield">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group checkbox-field">
                                        <div class="formfield">
                                            <input type="checkbox" class="" id="checkbox3">
                                        </div>
                                        <label for="checkbox3">This is a residential address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center gap-2 justify-content-end">
                                        {{-- <a href="#" class="btn secondary-btn md-btn mr-1 cancel-address">Back</a> --}}
                                        <button class="btn primary-btn md-btn mr-1" id="submit" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a href="#" class="cancel-address"><i class="fa-solid fa-xmark"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="product-detail-table product-list-table">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>OrderId</th>
                        <th>Total product</th>
                        <th>Total price</th>
                        <th>Quantity</th>
                        <th>Shippment Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>

                    <tr>
                        <td>
                            <div class="pro-list-name">

                                <h4>1</h4>
                            </div>
                        </td>
                        <td>
                            <p>1</p>
                        </td>
                        <td>
                            <p>$1000</p>
                        </td>

                        <td>
                            <p>1</p>
                        </td>
                        <td>
                            <p>$0</p>
                        </td>
                        <td>
                            <p>18-07-2024</p>
                        </td>

                        <td>
                            <div class="pro-status">

                                <div class="dropdown">


                                    <a href="#" class="btn primary-btn" data-bs-toggle="modal" data-bs-target="#Package-modal">view</a>

                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


<!-- Modal -->
<div class="modal fade Package-modal" id="Package-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="package-main">
                    <h3>Package Dimentions</h3>
                    <p>Rates are calculated based on package dimensions and weight. It's recommended to enter the correct weight and dimensions. If not, you may receive adjustment charges.</p>
                    <div class="custm-dimention-box">
                        <p>Dimention</p>
                        <div class="custm-dimention mb-3">

                            <div class="form-group">
                                <div class="formfield">
                                    <input type="text" name="" id="" class="form-control" placeholder="length">
                                    <span class="dimention-parameter">
                                        L
                                    </span>
                                </div>
                            </div>
                            <p>X</p>
                            <div class="form-group">
                                <div class="formfield">
                                    <input type="text" name="" id="" class="form-control" placeholder="width">
                                    <span class="dimention-parameter">
                                        W
                                    </span>
                                </div>
                            </div>
                            <p>X</p>
                            <div class="form-group">
                                <div class="formfield">
                                    <input type="text" name="" id="" class="form-control" placeholder="height">
                                    <span class="dimention-parameter">
                                        H
                                    </span>
                                </div>
                            </div>
                            <p>X</p>
                            <div class="form-group">
                                <div class="formfield">
                                    <select name="" id="" class="form-control">
                                        <option value="">in</option>
                                        <option value="">mm</option>
                                        <option value="">cm</option>
                                    </select>
                                    <span class="custm-drop-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                            <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
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
                                    <input type="text" name="" id="" class="form-control" placeholder="weight">

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="formfield">
                                    <select name="" id="" class="form-control">
                                        <option value="">g</option>
                                        <option value="">kg</option>
                                        <option value="">oz</option>
                                    </select>
                                    <span class="custm-drop-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                            <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group checkbox-field">
                        <div class="formfield">
                            <input type="checkbox" class="" id="checkbox3">
                        </div>
                        <label for="checkbox3">Create a return label</label>
                    </div>
                    <div class="d-flex align-items-center gap-2 justify-content-end">
                        {{-- <a href="#" class="btn secondary-btn md-btn mr-1">Back</a> --}}
                        <button class="btn primary-btn sm-btn mr-1" id="submit" type="submit">Submit</button>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
{{-- @includeFirst(['validation.dealer.js_product']) --}}
<script>
    $('.add-address-btn').on('click', function() {
        $(".add-address-box").addClass('open');
    });
    $('.cancel-address').on('click', function() {
        $(".add-address-box").removeClass('open');
    });
</script>

@endpush