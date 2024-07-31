<script>
    $(document).ready(function() {
        $("#packageDimension").validate({
            rules: {
                length: {
                    required: true,
                    number: true,
                    min: 0
                },
                width: {
                    required: true,
                    number: true,
                    min: 0
                },
                height: {
                    required: true,
                    number: true,
                    min: 0
                },
                weight: {
                    required: true,
                    number: true,
                    min: 0
                },
                create_return_label: {
                    checkboxRequired: true
                }
            },
            messages: {
                length: {
                    required: "Please enter the length.",
                    number: "Length must be a number.",
                    min: "Length must be a positive number."
                },
                width: {
                    required: "Please enter the width.",
                    number: "Width must be a number.",
                    min: "Width must be a positive number."
                },
                height: {
                    required: "Please enter the height.",
                    number: "Height must be a number.",
                    min: "Height must be a positive number."
                },
                weight: {
                    required: "Please enter the weight.",
                    number: "Weight must be a number.",
                    min: "Weight must be a positive number."
                },
                create_return_label: {
                    checkboxRequired: "You must check the box to create a return label."
                }
            },
            errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    error.insertAfter(element);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: (form, event) => {
                event.preventDefault();
                var formData = $(form).serializeArray();
                let url = APP_URL + '/dealer/parcel/dimension';
                const result = ajaxCall(url, 'post', formData, true);
                $("#fullPageLoader").removeClass('d-none');
                result.then(handleParcelSuccessResponse).catch(handleParcelErrorResponse)

                function handleParcelSuccessResponse(response) {
                    $("#fullPageLoader").addClass('d-none');
                    $('#Package-modal').modal('toggle');
                    if (response.status == false) {
                        var errorMessage = response.message;
                        errorMessage += ' Please make group first.';
                        toastr.error(errorMessage);
                    } else {
                        if (response.payment) {
                            $('#PaymentInitiate').attr('href', response.paymentUrl);
                            $('#PaymentInitiate').removeClass('disabled_select');
                        }
                        $('#outerContainerFull').html(response.data);
                    }
                }

                function handleParcelErrorResponse(error) {
                    console.log('error', error)
                    $("#fullPageLoader").addClass('d-none');

                }
            }
        });
        var productIds = 0;
        $(document).on('click', '.add-dimension-btn', function() {
            console.log($(this).closest('.grouped-data').data('ids'));
            productIds = $(this).closest('.grouped-data').data('ids');
            console.log(productIds, typeof productIds, productIds.length);

            if (typeof productIds === 'string') {
                console.log(productIds, productIds);
                productIds = $(this).closest('.grouped-data').data('ids').split(',');
            } else {
                console.log($(this).closest('.grouped-data').data('ids'));
                productIds = $(this).closest('.grouped-data').data('ids');
            }
            console.log('Product IDs:', productIds);
        });

        // jQuery('.harvinder').on('click', function(e) {
        //     var productIds = $(this).closest('.grouped-data').data('ids').split(',');
        //     console.log(productIds);
        //     var productName = jQuery(this).attr('data-productName');
        //     jQuery(this).addClass('addingDim');
        //     order_item_id = jQuery(this).attr('data-productId');
        //     jQuery('.productName').text(productName);
        //     console.log(productName);
        // });
        var flag = jQuery('.harvinder').data('flag');
        if (flag) {
            if (jQuery('.payment-btn').hasClass('disabled-shippmentPayment')) {
                jQuery('.payment-btn').removeClass('disabled-shippmentPayment')
            }
            console.log(flag);
        }
        $('.btn-close').on('click', function(e) {
            var productIds = 0;
        })
    });
</script>