<div class="modal-body">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    <h3>Add Feature Products</h3>
    <div class="product-detail-table product-list-table pro-manage-table">
        <div class="table-responsive">
            <form id="feature-product-form" action="{{ route('Dealer.feature.products.save') }}" method="POST">
                @csrf
                <table class="table">
                    <tr>
                        <th>Select</th>
                        <th>Part Image</th>
                        <th>Part Number</th>
                        <th>Part Name</th>
                        <th>Quantity</th>
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>
                            <input type="checkbox" name="featured_product_Ids[]" value="{{ $product->id }}" class="feature-checkbox"  id="featureCheckbox"
                                @if(in_array($product->id, $alreadyFeaturedProductIds)) checked @endif>
                        </td>
                        <td> <div class="pro-img-box">
                            <img src="{{ $product->productImage && count($product->productImage) ? Storage::url($product->productImage[0]->file_url) : asset('assets/images/gear-logo.svg') }}"
                                alt="img">
                        </div></td>
                        <td>{{ $product->part_number }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->stocks_avaliable }}</td>
                    </tr>
                    @endforeach
                </table>
                <p id="limit-message" style="color:red;"></p>
                <button type="submit" class="btn primary-btn float-end" id="submit-button">Add in Features</button>
            </form>
        </div>
    </div>
</div>

