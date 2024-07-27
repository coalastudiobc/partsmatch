@forelse ($products as $item)
{{-- @dd($item->getGroupedWith() , groupWith($item->getOrderIdsWithSameParcel())); --}}
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
                    <a href="javascript:void(0)" id="{{random_int(10000, 99999)}}"class="btn primary-btn open-dimension-modal" data-product_id="{{$item->id}}" style="font-size: 14px;padding: 12px 7px;" alt=""> {{$item->parcel && !is_null($item->parcel) && $item->parcel->status ? "Edit" : "Add dimensions"  }}</a>
                </div>
            </div>
        </div>
    </div>
@empty
@endforelse

