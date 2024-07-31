    <div class="custm-table-head">
        <div class="custm-table-head-box">
            <p>Image</p>
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
            <p>Created At</p>
        </div>
    </div>
    
@forelse ($groups as $parcels)
    @if(count($parcels) == 1)
       @php $item = $parcels[0];@endphp
    <div class="custm-table-body" id="{{'outer'.$item->id}}">
                <div class="custm-table-head-box ">
                    <img class="available-to-add-input" src="{{ $item->product?->productImage?->first()?->file_url ? Storage::url($item->product->productImage->first()->file_url) : asset('assets/images/logo.svg')  }}">
                    {{-- <img  class="available-to-add-input" src="{{ $item->product ? ( $item->product->productImage ? ($item->product->productImage[0] ? Storage::url($item->product->productImage[0]->file_url) : asset('assets/images/logo.svg'))  :asset('assets/images/logo.svg')) : asset('assets/images/logo.svg') )}}" > --}}
                </div>
                <div class="custm-table-head-box">
                    <p>{{$item->product->name ?  $item->product->name : "" }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>{{ $item->quantity }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>${{$item->product->price ?  $item->product->price : "" }}</p>
                </div>
                 <div class="custm-table-head-box">
                    <p>{{ $item->product->created_at->format('m/d/Y') }}</p>
                </div>
                {{-- <div class="custm-table-head-box">
                    <p>${{ $item->quantity * $item->product_price }}</p>
                </div> --}}
            </div>  
    @elseif(count($parcels) > 1)
@dump($parcels)

    <div class="grouped-data mb-3">
        @forelse ($parcels as $item)
            @php $productIds = array_column($parcels, 'product_id'); $productIdsString = implode(',', $productIds); @endphp
            <div class="custm-table-body" id="{{'outer'.$item->id}}">
                <div class="custm-table-head-box ">
                    <img  class="available-to-add-input" src="{{Storage::url($item->product->productImage[0]->file_url)}}" >
                </div>
                <div class="custm-table-head-box">
                    <p>{{ $item->quantity }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>{{$item->product->name ?  $item->product->name : "" }}</p>
                </div>
                <div class="custm-table-head-box">
                    <p>${{$item->product->price ?  $item->product->price : "" }}</p>
                </div>
                 <div class="custm-table-head-box">
                    <p>{{ $item->product->created_at->format('m/d/Y') }}</p>
                </div>
                <div class="custm-table-head-box">
                    <div class="pro-status dimensionbtn">
                        <div class="dropdown" title="Add dimension of package">
                            <a href="javascript:void(0)" class="btn primary-btn open-dimension-modal"  style="font-size: 14px;padding: 12px 7px;" alt=""> </a>
                        </div>
                    </div>
                        <button class="dismantle btn secoundary-btn">Dismantle group</button>
                </div>
            </div>
        @empty
        @endforelse
        </div>
   
    @endif
@empty
@endforelse

