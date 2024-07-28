@forelse ($products as $product)
    <x-home-product-tab :product="$product" />
@empty
<div class="collection-box">
    <img src="{{ asset('assets/images/no-product.svg') }}" alt="" width="300">
    <p class="text-center mt-1"> <b>No products avaliable at the moment</b></p>
</div>
@endforelse