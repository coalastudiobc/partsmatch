@forelse ($groups as $parcels)
    @if(count($parcels) == 1)
       @php $item = $parcels[0];@endphp
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
                <div class="custm-table-head-boxc dimensionAndDismantleBtn">
                    <div class="pro-status dimensionbtn">
                        <div class="dropdown" title="Add dimension of package">
                            <a href="javascript:void(0)" id="{{random_int(10000, 99999)}}"class="btn primary-btn open-dimension-modal" data-product_id="{{$item->product_id}}" style="font-size: 14px;padding: 12px 7px;" alt=""> {{$item->parcel && !is_null($item->parcel) && $item->parcel->status ? "Edit dimensions" : "Add dimensions"  }}</a>
                        </div>
                    </div>
                </div>
            </div>  
    @elseif(count($parcels) > 1)
    <div class="grouped-data mb-3">
        @forelse ($parcels as $item)
            @php $productIds = array_column($parcels, 'product_id'); $productIdsString = implode(',', $productIds); @endphp
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
                <div class="custm-table-head-box dimensionAndDismantleBtn">
                    <div class="dimensionAndDismantleBtn">
                        @if($loop->first)
                        <div class="pro-status dimensionbtn">
                            <div class="dropdown" title="Add dimension of package">
                                <a href="javascript:void(0)" id="{{random_int(10000, 99999)}}"class="btn primary-btn open-dimension-modal" data-product_id="{{$productIdsString}}" style="font-size: 14px;padding: 12px 7px;" alt=""> {{$item->parcel && !is_null($item->parcel) && $item->parcel->status  ? "Edit dimensions" : "Add dimensions"  }}</a>
                            </div>
                        </div>
                            <button class="dismantle btn secondary-btn" data-ids="{{$productIdsString}}">Unbind Group</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
        @endforelse
        </div>
   
    @endif
@empty
@endforelse

