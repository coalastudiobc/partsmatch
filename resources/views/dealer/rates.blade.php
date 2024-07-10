@extends('layouts.front')
@section('content')
    <div class="col-xl-5 col-lg-12 col-md-12">
        <div class="order-summary cstm-card">
            <h2>Products and Shipment Rates</h2>
            <ul class="order-summary-list">
                @foreach ($rateResults as $userId => $shipment)
                    {{-- Display products --}}
                    @foreach ($shipment->parcel as $parcel)
                        @php
                            $productDetail = getProductDetaiByParcelId($parcel);
                        @endphp

                        <li>
                            <div class="summary-list-box">
                                <div class="summary-img-txt">
                                    <div class="summary-img-box">
                                        <img src="{{ asset('storage/' . $productDetail->productImage[0]->file_url) }}"
                                            alt="Product Image">
                                    </div>
                                    <div class="summary-txt-box">
                                        <h3>{{ $productDetail->name ?? 'Product Name' }}</h3>
                                        <p>{{ $productDetail->category->name ?? 'Product Category Name' }}</p>
                                    </div>
                                </div>
                                <p>${{ isset($productDetail->quantity) ? number_format($productDetail->price * $productDetail->quantity, 2, '.', ',') : $productDetail->price }}
                                </p>
                            </div>
                        </li>
                    @endforeach

                    {{-- Display shipment rates --}}
                    <form action="{{ route('dealer.checkout.rates') }}" method="POST">
                        @csrf
                        @if ($shipment->rates_list)
                            @foreach ($shipment->rates_list as $rates)
                                <li>
                                    <div class="summary-list-box">
                                        <div class="summary-img-txt">
                                            <div class="summary-img-box">
                                                <img src="{{ $rates->provider_image_75 }}" alt="Provider Image">
                                                <div class="order-sum-number">
                                                    <input type="radio" name="shipmentRates[{{ $userId }}]"
                                                        value="{{ $rates->object_id }}">
                                                </div>
                                            </div>
                                            <div class="summary-txt-box">
                                                <h3>{{ $rates->servicelevel_name }}</h3>
                                                <p>{{ $rates->days }}</p>
                                            </div>
                                        </div>
                                        <p>${{ $rates->amount }}</p>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                @endforeach
                <button type="submit" class="btn primary-btn">Next</button>
                </form>
            </ul>
            {{-- Add your form closing tag if needed --}}
        </div>
    </div>


    </div>
@endsection
