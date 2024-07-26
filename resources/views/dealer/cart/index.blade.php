@extends('layouts.front')
@section('title', 'Cart Products')
@section('content')
    <section class="page-content-sec">
        <div class="container" id="cartContainer">
            <x-alert-component />
            @include('components.cart')
        </div>
    </section>
@endsection
@include('layouts.include.footer')
@push('scripts')
    <script>
        $(document).ready(function() {


            // delete product form the cart
              $(document).on('click', '.cartDelete', function() {
                var product_id = $(this).attr('data-product_id')
                url = APP_URL + '/dealer/delete/to/cart/' + product_id
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


            // update cart with minus
            $(document).on('click', '.cartupdate', function() {
                var container = $(this).parent().parent().parent().find('.targetLoaderDiv');
                container.addClass('d-none');
                $('.button-loader').removeClass('d-none');
                var element = $(this).attr('data_quantity_id');
                var quan = $(element).val();
                if ($(this).hasClass('minus')) {
                    var sum = parseInt(quan) - 1;
                    $(element).val(sum);
                    quan = sum;
                } else if ($(this).hasClass('plus')) {
                    var sum = parseInt(quan) + 1;
                    $(element).val(sum)
                    quan = sum;
                }

                var product_id = $(this).attr('data-product_id')
                var url = APP_URL + '/dealer/update/to/cart/' + product_id
                var formData = new FormData()
                formData.append('quantity', quan)
                var response = ajaxCall(url, 'post', formData, true);
                response.then(handleStateData).catch(handleStateError)

                function handleStateData(response) {
                    container.removeClass('d-none');
                    $('.button-loader').addClass('d-none');
                    if (response.success == true) {
                        $('#cartContainer').html(response.cart);
                        if (response.status == true) {
                            return toastr.success(response.message);
                        } else {
                            return toastr.error(response.message);

                        }
                    } else {

                        return toastr.error(response.message);

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
                $('#overlay').addClass('overlay');
                $('#loader').addClass('loader');
                var quan = $(this).val();
                var product_id = $(this).attr('data-product_id')
                var url = APP_URL + '/dealer/update/to/cart/' + product_id
                var formData = new FormData()
                formData.append('quantity', quan)
                var response = ajaxCall(url, 'post', formData, true);
                response.then(handleStateData).catch(handleStateError)

                function handleStateData(response) {
                    $('#overlay').removeClass('overlay');
                    $('#loader').removeClass('loader');
                    if (response.success == true) {
                        $('#cartContainer').html(response.cart);
                        if (response.status == true) {
                            return toastr.success(response.message);
                        } else {
                            return toastr.error(response.message);

                        }
                    } else {

                        return toastr.error(response.message);

                    }
                }

                function handleStateError(error) {
                    console.log('error', error)

                }
            });

            jQuery('#checkout-btn').on('click', function(e) {
                // e.preventDefault();
                jQuery('#fullPageLoader').removeClass('d-none');
                console.log('hlo');
            })
        });
    </script>
@endpush
