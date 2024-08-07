<div class="modal-body">

    <div class="pro-detail-body ">
        <div id="loaderid" class="spinner-grow" style="display:block; margin:0 auto;"></div>
        <div class="product-slider d-none">
            @foreach ($product['product_image'] as $a => $image)
                <img class="model-pro-img" src="{{ Storage::url($image['file_url']) }}" alt="">
            @endforeach
        </div>
        <div class="product-infography">

            <h2 class="mt-3">{{ $product['name'] }}</h2>
            {{-- <span>{{ $product->subcategory_id }}</span> --}}
            <p>{{ $product['description'] }} </p>
            <div class="product-quantity-box">
                <p>Stocks Avaliable:</p>
                <p>{{ $product['stocks_avaliable'] }} |</p>
                <p>Year:</p>
                <p>{{ $product['year'] }} |</p>
                <p>Model:</p>
                <p>{{ $product['model'] }} |</p>
                <p>Brand:</p>
                <p>{{ $product['brand'] }}</p>

                {{-- <div class="left-input">
                    <input type="text" placeholder="{{  }}">
                </div> --}}
            </div>

            <div class="singlr-pro-detail model-more-info-box">
                <div class="product-name-detail">
                    <h3>{{ $product['name'] }}</h3>
                    <h3>${{ $product['price'] }}</h3>
                    {{-- <h3>{{ $product['year'] }}</h3>
                    <h3>{{ $product['model'] }}</h3>
                    <h3>{{ $product['brand'] }}</h3> --}}
                </div>
                <div class="more-info-box ">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#additional-information" aria-expanded="false"
                                    aria-controls="collapseTwo">
                                    Additional Information
                                </button>
                            </h2>
                            <div id="additional-information" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{{ $product['additional_details'] }}</p>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#additional-information2" aria-expanded="false"
                                    aria-controls="collapseTwodf">
                                    Other Specification
                                </button>
                            </h2>
                            <div id="additional-information2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{{ $product['other_specification'] }} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<script>
    setTimeout(() => {
        document.querySelector('.product-slider').classList.remove('d-none')
        // Hide the loader
        document.getElementById('loaderid').classList.add('d-none');
    }, 2000);
</script>
