@extends('layouts.front')
@section('content')
    <section class="page-content-sec">
        <div class="container" id="cartContainer">
            @include('components.cart-component')
        </div>
    </section>
@endsection
@include('layouts.include.footer')
@push('scripts')
    <script>
        $(document).ready(function() {
            // increass the number of product
            $(document).on('click', '.plus', function() {
                var element = $(this).prev();
                var quan = element.val();
                var stocks_avaliable = element.attr('productQuantity');
                console.log(stocks_avaliable);
                var sum = parseInt(quan) + 1;
                element.val(sum)
            });
            $(document).on('click', '.minus', function() {
                // descreass the number of product
                var element = $(this).next();
                var quan = element.val();
                var sum = parseInt(quan) - 1;
                element.val(sum)
            });

            // delete product form the cart
            $(document).on('click', '.cartDelete', function() {
                var cart_id = $(this).attr('cart_id')
                url = APP_URL + '/dealer/delete/to/cart/' + cart_id
                console.log(url);
                var response = ajaxCall(url, 'get', null, false);
                response.then(handleStateData).catch(handleStateError)

                function handleStateData(response) {
                    if (response.success == true) {
                        $('#cartContainer').html(response.cart);
                        $('.cart-icon').html(response.cart_icon);
                        return toastr.success("Cart product delete successfully");
                    } else {
                        jQuery('#errormessage').html(response.error);
                    }
                }

                function handleStateError(error) {
                    console.log('error', error)

                }
            });

            // update cart with plus

            $(document).on('click', '.cartupdateplus', function() {
                var cart_id = $(this).attr('cartid')
                var product_id = $(this).attr('product-id')
                var element = $(this).prev();
                var quan = parseInt(element.val());
                console.log(quan);
                var url = APP_URL + '/dealer/update/to/cart/' + cart_id + '/' + product_id
                var formData = new FormData()
                formData.append('quantity', quan)
                // console.log(formData)
                // console.log(url);
                var DataQuantity = "plusQuantity"
                formData.append('dataquantity', DataQuantity)
                var response = ajaxCall(url, 'post', formData, true);
                response.then(handleStateData).catch(handleStateError)

                function handleStateData(response) {
                    if (response.success == true) {
                        console.log('hererererer')
                        // location.reload();
                        $('#cartContainer').html(response.cart);
                        return toastr.success("Cart product updated successfully");
                    } else {
                        // jQuery('#errormessage').html(response.error);
                        location.reload();

                        // return toastr.error(response.message);

                    }
                }

                function handleStateError(error) {
                    console.log('error', error)

                }
            });

            // update cart with minus
            $(document).on('click', '.cartupdateminus', function() {
                var cart_id = $(this).attr('cartid')
                var product_id = $(this).attr('product-id')
                var element = $(this).next();
                var quan = parseInt(element.val());
                console.log(typeof(quan));
                var url = APP_URL + '/dealer/update/to/cart/' + cart_id + '/' + product_id
                var formData = new FormData()
                formData.append('quantity', quan)
                var DataQuantity = "minusQuantity"
                formData.append('dataquantity', DataQuantity)
                // console.log(formData)
                // console.log(url);
                var response = ajaxCall(url, 'post', formData, true);
                response.then(handleStateData).catch(handleStateError)

                function handleStateData(response) {
                    if (response.success == true) {
                        console.log('hererererer')
                        // location.reload();
                        $('#cartContainer').html(response.cart);
                        return toastr.success("Cart product decrease by 1 successfully");
                    } else {
                        jQuery('#errormessage').html(response.error);
                    }
                }

                function handleStateError(error) {
                    console.log('error', error)

                }
            });

            $(document).on('input', '.quantity', function() {
                $(this).val($(this).val().replace(/[^0-9]/g, ''));
            });
            $(document).on('change', '.quantity', function() {
                var quan = parseInt($(this).val())
                var product_id = parseInt($(this).next().attr('product-id'))
                var cart_id = parseInt($(this).next().attr('cartid'))
                var element = $('.quantity');
                // var quan = element.val();
                var url = APP_URL + '/dealer/update/to/cart/' + cart_id + '/' + product_id
                console.log(quan, product_id, cart_id, url);
                var formData = new FormData()
                formData.append('quantity', quan)
                // console.log(formData)
                // console.log(url);
                var DataQuantity = "plusQuantity"
                formData.append('dataquantity', DataQuantity)
                var response = ajaxCall(url, 'post', formData, true);
                response.then(handleStateData).catch(handleStateError)

                function handleStateData(response) {
                    if (response.success == true) {
                        console.log('hererererer')
                        // location.reload();
                        $('#cartContainer').html(response.cart);

                        return toastr.success("Cart product updated successfully");
                    } else {
                        // jQuery('#errormessage').html(response.error);
                        location.reload();

                        // return toastr.error(response.message);

                    }
                }

                function handleStateError(error) {
                    console.log('error', error)

                }
            });
        });
    </script>
@endpush
