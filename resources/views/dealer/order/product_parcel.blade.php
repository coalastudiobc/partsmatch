@extends('layouts.dealer')
@section('content')
<div class="dashboard-right-box">

    <div class="product-detail-table product-list-table">
        <div class="adress-info-haeder">
            <a class="back-btn" href="{{ route('Dealer.order.orderlist') }}"><i class="fa-solid fa-angle-left back-btn"></i> Back</a>
            <div class="order-label-center">
                <h3>Create New FulFillment</h3>
                <p>Step 2 of 2</p>
            </div>
            <div class="d-flex gap-3 align-items-cneter justify-content-end">
                <a href="javascript:void(0)" id="makeGroup" class="btn secondary-btn"><img src="{{ asset('assets/images/add-round-icon.svg') }}" alt="">Make Group</a>
                <a href="javascript:void(0)" id="createGroup" class="btn secondary-btn d-none">Create Group</a>
                <a href="javascript:void(0)" id="cancel" class="btn secondary-btn d-none">Cancel</a>
                <a href="{{ !isFullFilledOrder($order->id) ? '#' : route('Dealer.order.shippment.rates',['order'=>$order->id])  }}" id="PaymentInitiate" class="btn primary-btn payment-btn disabled-shippmentPayment @if(!isFullFilledOrder($order->id))disabled_select @endif ">Make FulFill</a>

            </div>
        </div>
        <div class="x-scroll">
            <div class="cstm-table-box make-group" id="outerBox">
                <div class="custm-table-head">
                    <div class="custm-table-head-box">
                        <p></p>
                    </div>
                    <div class="custm-table-head-box">
                        <p>Order ID</p>
                    </div>
                    <div class="custm-table-head-box">
                        <p>Product name</p>
                    </div>
                    <div class="custm-table-head-box">
                        <p>Quantity</p>
                    </div>
                    <div class="custm-table-head-box">
                        <p>Price</p>
                    </div>
                    <div class="custm-table-head-box">
                        <p>Total price</p>
                    </div>
                    <div class="custm-table-head-box">
                        <p>Action</p>
                    </div>
                </div>
                <div id="outerContainerFull">
                    <x-group-parcel  :groups=$groups/>
                </div>
            </div>
        </div>
    </div>

    <!--package dimensions Modal -->
    
</div>
@endsection

@section('modals')
<div class="modal fade Package-modal" id="Package-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="packageDimension" action="">
                        @csrf
                        <input type=hidden name="products" value="" id="prodIdContainer">
                        <input type=hidden name="element_to_change" value="" id="elementTochange">
                        <input type=hidden name="order_id" value="{{$order->id}}" >
                        <div class="package-main">
                            <h3>Package Dimensions </h3>
                            <p>Rates are calculated based on package dimensions and weight. It's recommended to enter the
                                correct weight and dimensions. If not, you may receive adjustment charges.</p>
                            <div class="custm-dimention-box">
                                <p>Dimensions</p>
                                <div class="custm-dimention mb-3">

                                    <div class="form-group">
                                        <div class="formfield">
                                            <input type="text" name="length" id="" class="form-control" placeholder="length">
                                            <span class="dimention-parameter">
                                                L
                                            </span>
                                        </div>
                                    </div>
                                    <p>X</p>
                                    <div class="form-group">
                                        <div class="formfield">
                                            <input type="text" name="width" id="" class="form-control" placeholder="width">
                                            <span class="dimention-parameter">
                                                W
                                            </span>
                                        </div>
                                    </div>
                                    <p>X</p>
                                    <div class="form-group">
                                        <div class="formfield">
                                            <input type="text" name="height" id="" class="form-control" placeholder="height">
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
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                                    <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
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
                                        <input type="text" name="weight" id="" class="form-control" placeholder="weight">

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="formfield">
                                        <select name="mass_unit" id="" class="form-control">
                                            <option value="g">g</option>
                                            <option value="kg">kg</option>
                                            <option value="oz">oz</option>
                                            <option value="lb">lb</option>
                                        </select>
                                        <span class="custm-drop-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                                <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <!--    <div class="form-group checkbox-field">
                            <div class="formfield">
                                <input type="checkbox" class="" name="" id="checkbox3">
                            </div>
                             <label for="checkbox3">Create a return label</label>
                        </div>  -->
                        <div class="d-flex align-items-center gap-2 justify-content-end">
                            <button class="btn primary-btn sm-btn mr-1" id="submit" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@includeFirst(['validation.dealer.js_package_dimension'])
    <script>
    $(document).on('click','.open-dimension-modal', function() {
        var prod_id = $(this).attr('data-product_id');
        var prodIds = [];
        prodIds.push(prod_id);
        $("#prodIdContainer").val(prodIds);
        $("#elementTochange").val($(this).attr('id'));
        $("#Package-modal").modal('show');
    });
    $('#makeGroup').on('click', function() {
        $(".available-to-add-input").removeClass('d-none');
        $('#makeGroup').addClass('d-none');
        $('#createGroup').removeClass('d-none');
        $('#cancel').removeClass('d-none');

    });
    $('#cancel').on('click', function() {
        $(".available-to-add-input").addClass('d-none');
        $('#makeGroup').removeClass('d-none');
        $('#cancel').addClass('d-none');
        $('#createGroup').addClass('d-none');
    });
    $('#createGroup').on('click', function() {
        // Check if any checkboxes are checked
        var total_in_group = parseInt($('input.available-to-add-input:checked').length);
        if ( total_in_group > 1) {
            var htmlContent ="";
            var ids =[];
            $('input.available-to-add-input:checked').each(function(index, item) {
                var singleOrderProduct = $($(item).attr('data-add'));
                ids.push($(item).attr('data-product_id'));
            });
            var order_id ="{{$order->id}}";
            var formData = {'product_ids' : ids,'_token' :CSRF,'order_id' : order_id};
            let url = APP_URL + '/dealer/parcel/groups';
            const result = ajaxCall(url, 'post', formData, true);
            $("#fullPageLoader").removeClass('d-none');
            result.then(handleParcelGroup).catch(handleParcelGroupError)

            function handleParcelGroup(response) {
                console.log(response);
                $("#fullPageLoader").addClass('d-none');
                if (response.status == false) {
                    var errorMessage = response.message;
                    errorMessage += ' Please make group first.';
                    toastr.error(errorMessage);
                } else {
                    if (response.payment) {
                        $('#PaymentInitiate').attr('href', response.paymentUrl);
                        $('#PaymentInitiate').removeClass('disabled_select');
                    }
                    $(".available-to-add-input").addClass('d-none');
                    $('#makeGroup').removeClass('d-none');
                    $('#cancel').addClass('d-none');
                    $('#createGroup').addClass('d-none');
                    $('#outerContainerFull').html(response.data);
                }
            }

            function handleParcelGroupError(error) {
                console.log('error', error)

            }
            $('#outerContainerFull').append("<div class='grouped-data mb-3'>"+htmlContent+"</div>");
        } else {
            alert('Please select at least two items to create a group.');
        }
    });

    $(document).on('click','.dismantle', function() {
        // Check if any checkboxes are checked
        var product_ids = $(this).attr('data-ids');
        var order_id ="{{$order->id}}";
        var formData = {'product_ids' : product_ids,'_token' :CSRF,'order_id' : order_id};
        let url = APP_URL + '/dealer/parcel/groups/delete';
        const result = ajaxCall(url, 'post', formData, true);
        $("#fullPageLoader").removeClass('d-none');
        result.then(handleParcelGroupDelete).catch(handleParcelGroupDeleteError)

        function handleParcelGroupDelete(response) {
            $("#fullPageLoader").addClass('d-none');
            if (response.status == false) {
                var errorMessage = response.message;
                errorMessage += ' Please make group first.';
                toastr.error(errorMessage);
            } else {
                if (response.payment_btn_disable) {
                    $('#PaymentInitiate').attr('href', "#");
                    $('#PaymentInitiate').addClass('disabled_select');
                }
                $(".available-to-add-input").addClass('d-none');
                $('#makeGroup').removeClass('d-none');
                $('#cancel').addClass('d-none');
                $('#createGroup').addClass('d-none');
                $('#outerContainerFull').html(response.data);
            }
        }

        function handleParcelGroupDeleteError(error) {
            console.log('error', error)

        }
        
    });

    </script>
@endpush