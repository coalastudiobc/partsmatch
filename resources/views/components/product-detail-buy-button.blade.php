@if(!$product->deleted_at)
@auth
    {{-- @if(($product->user_id !== auth()->id() ) && ($product->dealer_id !== auth()->id()) && ( auth()->user()->working_for ? ($product->dealer_id !== auth()->user()->working_for):false)) --}}
        {{-- @if( $product->user_id !== auth()->id()
         && $product->dealer_id !== auth()->id()  
         && ($product->dealer_id !==(int) auth()->user()->working_for)
         && ($product->productOfDealer ? ((int)$product->productOfDealer->first()->working_for !== (int) auth()->user()->working_for):false)) --}}
         @php
    $userId = auth()->id();
    $workingFor = (int) auth()->user()->working_for;
    $isNotUserProduct = $product->user_id !== $userId;
    $isNotDealerProduct = $product->dealer_id !== $userId;
    $isNotWorkingForDealer = (int) $product->dealer_id !== $workingFor;
    $isNotWorkingForProductOfDealer = $product->productOfDealer ? 
        (int) $product->productOfDealer->first()->working_for !== $workingFor 
        : false;
@endphp

@if($isNotUserProduct && $isNotDealerProduct && $isNotWorkingForDealer && $isNotWorkingForProductOfDealer)
                <div class="product-quantity-box mb-3">
                    @if($product->stocks_avaliable <> 0)
                        <div class="quantity-btn">
                            <a href="javascript:void(0)" class="decrease-btn">-</a>
                            <input type="text" placeholder="1" class="quantity-input" value="1" data-stock="{{$product->stocks_avaliable}}" data-product_id="{{$product->id}}">
                            <a href="javascript:void(0)" class="increase-btn">+</a>
                        </div>
                    @endif

                    @if(($product->stocks_avaliable < 5) && ($product->stocks_avaliable >= 1) )
                        <div class="left-badge">
                            <p>Only {{$product->stocks_avaliable}} left</p>
                        </div>
                    @elseif($product->stocks_avaliable == 0)
                        <div class="left-badge">
                            <p>Out of stock</p>
                        </div>
                    @endif
                </div>
                @if (!in_array($product->id, authCartProducts()) && ($product->stocks_avaliable >0))
                    <button product-id="{{ $product->id }}" class="btn secondary-btn full-btn addtocart cart_add">Add to
                        Cart
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                            <g clip-path="url(#clip0_162_2238)">
                                <path d="M6.61281 12.2833H6.61368C6.6144 12.2833 6.61512 12.2832 6.61585 12.2832H16.708C16.9565 12.2832 17.1749 12.1184 17.2432 11.8795L19.4697 4.08652C19.5177 3.91852 19.4841 3.7379 19.379 3.59845C19.2738 3.459 19.1092 3.37695 18.9346 3.37695H5.32905L4.93114 1.58628C4.87446 1.33159 4.64862 1.15039 4.38769 1.15039H1.04785C0.740394 1.15039 0.491211 1.39957 0.491211 1.70703C0.491211 2.01449 0.740394 2.26367 1.04785 2.26367H3.94122C4.01167 2.58099 5.8454 10.8329 5.95092 11.3076C5.35935 11.5648 4.94433 12.1546 4.94433 12.8398C4.94433 13.7606 5.69348 14.5098 6.61425 14.5098H16.708C17.0155 14.5098 17.2646 14.2606 17.2646 13.9531C17.2646 13.6457 17.0155 13.3965 16.708 13.3965H6.61425C6.30738 13.3965 6.05761 13.1467 6.05761 12.8398C6.05761 12.5334 6.30651 12.2841 6.61281 12.2833ZM18.1966 4.49023L16.2881 11.1699H7.06073L5.57635 4.49023H18.1966Z" fill="white" />
                                <path d="M6.05762 16.1797C6.05762 17.1005 6.80676 17.8496 7.72754 17.8496C8.64831 17.8496 9.39746 17.1005 9.39746 16.1797C9.39746 15.2589 8.64831 14.5098 7.72754 14.5098C6.80676 14.5098 6.05762 15.2589 6.05762 16.1797ZM7.72754 15.623C8.03442 15.623 8.28418 15.8728 8.28418 16.1797C8.28418 16.4866 8.03442 16.7363 7.72754 16.7363C7.42066 16.7363 7.1709 16.4866 7.1709 16.1797C7.1709 15.8728 7.42066 15.623 7.72754 15.623Z" fill="white" />
                                <path d="M13.9248 16.1797C13.9248 17.1005 14.6739 17.8496 15.5947 17.8496C16.5155 17.8496 17.2646 17.1005 17.2646 16.1797C17.2646 15.2589 16.5155 14.5098 15.5947 14.5098C14.6739 14.5098 13.9248 15.2589 13.9248 16.1797ZM15.5947 15.623C15.9016 15.623 16.1514 15.8728 16.1514 16.1797C16.1514 16.4866 15.9016 16.7363 15.5947 16.7363C15.2878 16.7363 15.0381 16.4866 15.0381 16.1797C15.0381 15.8728 15.2878 15.623 15.5947 15.623Z" fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_162_2238">
                                    <rect width="19" height="19" fill="white" transform="translate(0.491211)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>

            @elseif($product->stocks_avaliable == 0)
                <button  class="btn disabled-btn btn btn-secondary full-btn ">Out of stock</button>

            @else
                <a href="{{ route('Dealer.cart.cart.index') }}" class="btn secondary-btn full-btn cart_add">Go to Cart</a>
            @endif
    @endif
@endauth
@guest
<a href="{{ route('login') }}" class="btn secondary-btn full-btn">Add to
    Cart
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
        <g clip-path="url(#clip0_162_2238)">
            <path d="M6.61281 12.2833H6.61368C6.6144 12.2833 6.61512 12.2832 6.61585 12.2832H16.708C16.9565 12.2832 17.1749 12.1184 17.2432 11.8795L19.4697 4.08652C19.5177 3.91852 19.4841 3.7379 19.379 3.59845C19.2738 3.459 19.1092 3.37695 18.9346 3.37695H5.32905L4.93114 1.58628C4.87446 1.33159 4.64862 1.15039 4.38769 1.15039H1.04785C0.740394 1.15039 0.491211 1.39957 0.491211 1.70703C0.491211 2.01449 0.740394 2.26367 1.04785 2.26367H3.94122C4.01167 2.58099 5.8454 10.8329 5.95092 11.3076C5.35935 11.5648 4.94433 12.1546 4.94433 12.8398C4.94433 13.7606 5.69348 14.5098 6.61425 14.5098H16.708C17.0155 14.5098 17.2646 14.2606 17.2646 13.9531C17.2646 13.6457 17.0155 13.3965 16.708 13.3965H6.61425C6.30738 13.3965 6.05761 13.1467 6.05761 12.8398C6.05761 12.5334 6.30651 12.2841 6.61281 12.2833ZM18.1966 4.49023L16.2881 11.1699H7.06073L5.57635 4.49023H18.1966Z" fill="white" />
            <path d="M6.05762 16.1797C6.05762 17.1005 6.80676 17.8496 7.72754 17.8496C8.64831 17.8496 9.39746 17.1005 9.39746 16.1797C9.39746 15.2589 8.64831 14.5098 7.72754 14.5098C6.80676 14.5098 6.05762 15.2589 6.05762 16.1797ZM7.72754 15.623C8.03442 15.623 8.28418 15.8728 8.28418 16.1797C8.28418 16.4866 8.03442 16.7363 7.72754 16.7363C7.42066 16.7363 7.1709 16.4866 7.1709 16.1797C7.1709 15.8728 7.42066 15.623 7.72754 15.623Z" fill="white" />
            <path d="M13.9248 16.1797C13.9248 17.1005 14.6739 17.8496 15.5947 17.8496C16.5155 17.8496 17.2646 17.1005 17.2646 16.1797C17.2646 15.2589 16.5155 14.5098 15.5947 14.5098C14.6739 14.5098 13.9248 15.2589 13.9248 16.1797ZM15.5947 15.623C15.9016 15.623 16.1514 15.8728 16.1514 16.1797C16.1514 16.4866 15.9016 16.7363 15.5947 16.7363C15.2878 16.7363 15.0381 16.4866 15.0381 16.1797C15.0381 15.8728 15.2878 15.623 15.5947 15.623Z" fill="white" />
        </g>
        <defs>
            <clipPath id="clip0_162_2238">
                <rect width="19" height="19" fill="white" transform="translate(0.491211)" />
            </clipPath>
        </defs>
    </svg>
</a>
@endguest

@else
<span>No longer available</span>
@endif