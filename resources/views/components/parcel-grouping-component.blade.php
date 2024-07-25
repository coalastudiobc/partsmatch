<div>
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
                            <a href="#" class="btn primary-btn harvinder" style="font-size: 14px;padding: 12px 7px;" id="{{ $item->id }}" data-productName="{{ $item->product->name }}" data-productId="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#Package-modal" data-flag="{{ $flag }}">
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
            @empty
            @endforelse
            </div>