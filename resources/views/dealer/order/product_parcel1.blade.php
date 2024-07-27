@extends('layouts.dealer')
@section('title', 'Order Management')
@section('heading', 'Order Management')
@section('content')
<div class="dashboard-right-box">

    <div class="product-detail-table product-list-table">
        <div class="adress-info-haeder">
            <a class="back-btn" href="{{ route('Dealer.order.orderlist') }}"><i class="fa-solid fa-angle-left back-btn"></i> Back</a>
            <div class="order-label-center">
                <h3>Create New Full Fillment</h3>
                <p>Step 2 of 2</p>
            </div>
            <div class="d-flex gap-3 align-items-cneter">
                <a href="javascript:void(0)" id="makeGroup" class="btn secondary-btn"><img src="{{ asset('assets/images/add-round-icon.svg') }}" alt="">Make Group</a>
                <a href="javascript:void(0)" id="createGroup" class="btn secondary-btn d-none">Create Group</a>
                <a href="javascript:void(0)" id="cancel" class="btn secondary-btn d-none">Cancel</a>
                <a href="{{ isFullFilledOrder($order->id) ? '#' : route('Dealer.order.shippment.rates',$order->id)  }}" id="PaymentInitiate" class="btn primary-btn payment-btn disabled-shippmentPayment @if(isFullFilledOrder($order->id))disabled_select @endif ">Payment</a>

            </div>
        </div>
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
            @isset($orderProducts)
            @forelse ($orderProducts as $item)
            <div class="custm-table-body" id="{{'outer'.$item->id}}">
                <div class="custm-table-head-box ">
                    <input type="checkbox" class="available-to-add-input d-none" data-add="{{'#outer'.$item->id}}" data-product_id="{{$item->id}}">
                </div>
                <div class="custm-table-head-box">
                    <p>{{ $item->order_id }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>{{$item->product ?  $item->product->name :"" }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>{{ $item->quantity }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>${{ $item->product_price }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>${{ $item->quantity * $item->product_price }}</p>
                </div>
                <div class="custm-table-head-box">
                    <div class="pro-status dimensionbtn">
                        <div class="dropdown" title="Add dimension of package">
                            @php
                            $flag = IspackageParcel($item->id, $item->product->id) ? 1 : 0;
                            @endphp
                            @if ($flag)
                            <a href="#" class="btn primary-btn harvinder" style="font-size: 14px;padding: 12px 7px;" id="{{ $item->id }}" data-productName="{{ $item->product->name }}" data-productId="{{ $item->id }}" data-flag="{{ $flag }}">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
            @endisset
        </div>

        @isset($groups)
        @forelse ($groups as $item)
        @if(count($item)>1)
        <div class="grouped-data">
            @foreach($item as $itemData)
            @if($itemData)
            <div class="custm-table-body" id="{{ 'outer'.$itemData->ordeItems->id }}">
                <div class="custm-table-head-box ">
                    <input type="checkbox" class="available-to-add-input d-none" data-add="{{ '#outer'.$itemData->ordeItems->id }}" data-product_id="{{ $itemData->ordeItems->id }}">
                </div>
                <div class="custm-table-head-box">
                    <p>{{ $itemData->ordeItems->order_id }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>{{ $itemData->product ? $itemData->product->name : "" }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>{{ $itemData->ordeItems->quantity }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>${{ $itemData->ordeItems->product_price }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>${{ $itemData->ordeItems->quantity * $itemData->ordeItems->product_price }}</p>
                </div>
                <div class="custm-table-head-box">
                    <div class="pro-status dimensionbtn">
                        <div class="dropdown" title="Add dimension of package">
                            @php
                            $flag = IspackageParcel($itemData->ordeItems->id, $itemData->ordeItems->product->id) ? 1 : 0;
                            @endphp
                            <a href="#" class="btn primary-btn harvinder" style="font-size: 14px;padding: 12px 7px;" id="{{ $itemData->ordeItems->id }}" data-productName="{{ $itemData->ordeItems->product->name }}" data-productId="{{ $itemData->ordeItems->id }}" data-bs-toggle="modal" data-bs-target="#Package-modal" data-flag="{{ $flag }}">
                                @if ($flag)
                                Edit
                                @else
                                <img src="{{ asset('assets/images/add-round-icon.svg') }}" alt="">
                                Add Dimension
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @else
        <?php $item = $item[0]; ?>
        <div class="custm-table-body" id="{{ 'outer'. $item->ordeItems->id }}">
            <div class="custm-table-head-box ">
                <input type="checkbox" class="available-to-add-input d-none" data-add="{{ '#outer'.$item->ordeItems->id }}" data-product_id="{{ $item->ordeItems->id }}">
            </div>
            <div class="custm-table-head-box">
                <p>{{ $item->ordeItems->order_id }}</p>
            </div>
            <div class="custm-table-head-box">
                <p>{{ $item->product ? $item->product->name : "" }}</p>
            </div>
            <div class="custm-table-head-box">
                <p>{{ $item->ordeItems->quantity }}</p>
            </div>
            <div class="custm-table-head-box">
                <p>${{ $item->ordeItems->product_price }}</p>
            </div>
            <div class="custm-table-head-box">
                <p>${{ ($item->ordeItems->quantity) * ($item->ordeItems->product_price) }}</p>
            </div>

            <div class="custm-table-head-box">
                <div class="pro-status dimensionbtn">
                    <div class="dropdown" title="Add dimension of package">
                        <?php $flag = IspackageParcel($item->ordeItems->id, $item->ordeItems->product->id) ? 1 : 0; ?>
                        @if ($flag)
                        <a href="#" class="btn primary-btn harvinder" style="font-size: 14px;padding: 12px 7px;" id="{{ $item->ordeItems->id }}" data-productName="{{ $item->ordeItems->product->name }}" data-productId="{{ $item->ordeItems->id }}" data-flag="{{ $flag }}">
                            Edit
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @empty
        @endforelse
        @endisset
    </div>

    <!--package dimensions Modal -->
    <div class="modal fade Package-modal" id="Package-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                            <div class="form-group checkbox-field">
                                <div class="formfield">
                                    <input type="checkbox" class="" name="" id="checkbox3">
                                </div>
                                <!-- <label for="checkbox3">Create a return label</label> -->
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


    $('#makeGroup').on('click', function() {
        $(".available-to-add-input").removeClass('d-none');
        $('#makeGroup').addClass('d-none');
        $('#createGroup').removeClass('d-none');
        $('#cancel').removeClass('d-none');

    });

    // $('#createGroup').on('click', function() {
    //     if($('input.available-to-add-input:checked').length > 0){
    //         var data ="";
    //         $('input.available-to-add-input:checked').each(function(index, item) {
    //             data = data+ $($(item).attr('data-add')).prop('outerHTML');
    //             $($(item).attr('data-add')).remove();
    //         });
    //         data = '<div class="grouped-data">'+ data + '</div>';
    //         $('#outerBox').append(data);
    //         $('#makeGroup').removeClass('d-none');
    //         $('#cancel').addClass('d-none');
    //         $('#createGroup').addClass('d-none');
    //     }else{
    //         alert('select any data entry')
    //     }
    //             });

    // $('#cancel').on('click', function() {
    //     $(".available-to-add-input").addClass('d-none');
    //     $('#makeGroup').removeClass('d-none');
    //     $('#cancel').addClass('d-none');
    //     $('#createGroup').addClass('d-none');


    // });

    var selectedProductIds = []; // Array to store selected product IDs

    // Function to handle creating groups
    $('#createGroup').on('click', function() {
        // Check if any checkboxes are checked
        if ($('input.available-to-add-input:checked').length > 0) {
            var selectedProductIds = [];
            var groupedItems = [];

            $('input.available-to-add-input:checked').each(function(index, item) {
                var $container = $($(item).attr('data-add'));
                var htmlContent = $container.prop('outerHTML');

                $container.remove();

                // Extract product ID and push to array
                var productId = $(item).data('product_id');
                selectedProductIds.push(productId);

                // Push HTML content to groupedItems array
                groupedItems.push(htmlContent);
            });

            var groupedData = $('<div class="grouped-data"></div>');
            groupedData.attr('data-ids', selectedProductIds.join(','));
            groupedData.html(groupedItems.join(''));

            $('#outerBox').append(groupedData);

            // Append the "Add Dimension" button dynamically for this group
            // var addButton = $('<button class="btn add-dimension-btn">Add Dimension</button>');
            var flag = groupedData.find('a.btn').data('flag');
            var buttonHtml = '';
            if (flag) {
                buttonHtml = '<a href="#" class="btn primary-btn harvinder add-dimension-btn add-dimension-btn" style="font-size: 14px;padding: 12px 7px;" id="' + groupedData.find('a.btn').attr('id') + '" data-productName="' + groupedData.find('a.btn').data('productname') + '" data-productId="' + groupedData.find('a.btn').data('productid') + '" data-bs-toggle="modal" data-bs-target="#Package-modal" data-flag="' + flag + '">Edit</a>';
            } else {
                buttonHtml = '<a href="#" class="btn primary-btn harvinder add-dimension-btn" style="font-size: 14px;padding: 12px 7px;" id="' + groupedData.find('a.btn').attr('id') + '" data-productName="' + groupedData.find('a.btn').data('productname') + '" data-productId="' + groupedData.find('a.btn').data('productid') + '" data-bs-toggle="modal" data-bs-target="#Package-modal" data-flag="' + flag + '"> Add Dimension</a>';
            }

            // Append the button HTML to pro-status div
            groupedData.find('.pro-status').html(buttonHtml);
            // groupedData.find('.pro-status').append(addButton);

            // Clear selectedProductIds array after grouping
            selectedProductIds = [];

            // Hide and show appropriate buttons
            $('#makeGroup').removeClass('d-none');
            $('#cancel').addClass('d-none');
            $('#createGroup').addClass('d-none');
        } else {
            alert('Please select at least one item to create a group.');
        }
    });

    // Function to handle cancel button click
    $('#cancel').on('click', function() {
        $(".available-to-add-input").addClass('d-none');
        $('#makeGroup').removeClass('d-none');
        $('#cancel').addClass('d-none');
        $('#createGroup').addClass('d-none');
    });

    // Event delegation for "Add Dimension" button
    $(document).on('click', '.add-dimension-btn', function() {
        console.log($(this).closest('.grouped-data').data('ids'));
        var productIds = $(this).closest('.grouped-data').data('ids');
        console.log(productIds, typeof productIds, productIds.length);

        if (typeof productIds === 'string') {
            console.log(productIds, productIds);
            var productIds = $(this).closest('.grouped-data').data('ids').split(',');
        } else {
            var productIds = $(this).closest('.grouped-data').data('ids');
        }
        console.log('Product IDs:', productIds);
    });
</script>
@endpush