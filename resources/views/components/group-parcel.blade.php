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
                                <a href="javascript:void(0)" id="{{random_int(10000, 99999)}}"class="btn primary-btn open-dimension-modal" data-product_id="{{$productIdsString}}" style="font-size: 14px;padding: 12px 7px;" alt=""><i class="fa-solid fa-plus"></i> {{$item->parcel && !is_null($item->parcel) && $item->parcel->status  ? "Edit dimensions" : "Add dimensions"  }}</a>
                            </div>
                        </div>
                            <button class="dismantle btn secondary-btn" data-ids="{{$productIdsString}}">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24" width="20" height="20"><path d="M7.831,16.169c-.557-.557-.975-1.207-1.281-1.901l1.57-1.57c.175,.761,.548,1.48,1.125,2.057,.675,.675,1.54,1.076,2.472,1.193l1.898,1.898c-.444,.098-.9,.154-1.365,.154-1.67,0-3.239-.65-4.419-1.831ZM.043,1.457L22.543,23.957l1.414-1.414-6.831-6.831,5.043-5.043c1.181-1.18,1.831-2.75,1.831-4.419,0-1.669-.65-3.239-1.831-4.419C20.989,.65,19.42,0,17.75,0s-3.239,.65-4.419,1.831l-2.2,2.2c.205-.015,.411-.03,.618-.03,.681,0,1.346,.091,1.99,.25l1.005-1.005c.803-.803,1.87-1.245,3.005-1.245s2.202,.442,3.005,1.245,1.245,1.87,1.245,3.005-.442,2.203-1.245,3.005l-5.043,5.043-5.852-5.852c.587-.294,1.227-.446,1.89-.446,1.135,0,2.202,.442,3.005,1.245,.577,.577,.95,1.296,1.125,2.057l1.57-1.57c-.306-.694-.724-1.345-1.281-1.901-1.18-1.181-2.749-1.831-4.419-1.831-1.209,0-2.365,.341-3.359,.977L1.457,.043,.043,1.457ZM0,17.75c0,1.669,.65,3.239,1.831,4.419,1.18,1.181,2.749,1.831,4.419,1.831s3.239-.65,4.419-1.831l2.2-2.2c-.205,.015-.411,.03-.618,.03-.681,0-1.346-.091-1.99-.25l-1.006,1.006c-.803,.803-1.87,1.245-3.005,1.245s-2.202-.442-3.005-1.245-1.245-1.87-1.245-3.005,.442-2.203,1.245-3.005l3.673-3.673-1.414-1.414-3.673,3.673C.65,14.511,0,16.081,0,17.75Z" fill="CurrentColor" /></svg>
                                </span>
                                Unbind Group</button>
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

