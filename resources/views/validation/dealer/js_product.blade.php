<script>
    jQuery(document).ready(function() {
        console.log("product");
        $("#submit").attr('disabled', false);

        const rules = {
            name: {
                required: true,
            },
            category: {
                required: true,

            },
            subcategory: {
                required: true,
            },
            description: {
                required: true,
            },
            images: {
                required: true,
                imageExtension: true,

            },
            stocks_avaliable: {
                required: true,
                number: true,
                regex: productStockRegex,
            },
            price: {
                required: true,
                number: true,
                regex:productPriceRegex,
            },
            part_number: {
                required: true,
                regex:partNumberRegex,
            },

        }
        const messages = {
            name: {
                required: `{{ __('customvalidation.product.name.required') }}`,
            },
            category: {
                required: `{{ __('customvalidation.product.category.required') }}`,
            },
            subcategory: {
                required: `{{ __('customvalidation.product.subcategory.required') }}`,
            },
            description: {
                required: `{{ __('customvalidation.product.description.required') }}`,

            },
            images: {
                required: `{{ __('customvalidation.product.images.required') }}`,
                imageExtension: `{{ __('customvalidation.user.image.imageExtension') }}`,

            },
            stocks_avaliable: {
                required: `{{ __('customvalidation.product.stocks_avaliable.required') }}`,
                number: `{{ __('customvalidation.product.stocks_avaliable.number') }}`,
                regex: `{{ __('customvalidation.product.stocks_avaliable.regex') }}`,
            },
            price: {
                required: `{{ __('customvalidation.product.price.required') }}`,
                number: `{{ __('customvalidation.product.price.number') }}`,
                regex: `{{ __('customvalidation.product.price.regex') }}`,
    
            },
            shipping_price: {
                required: `{{ __('customvalidation.product.shipping_price.required') }}`,
            },
            part_number: {
                required: `{{ __('customvalidation.product.part_number.required') }}`,
                regex: `{{ __('customvalidation.product.part_number.regex') }}`,
            },

        };

        handleValidation('product', rules, messages);

        $("#product").on("submit", function() {
            if ($('#product').valid()) {
                $("#submit").attr('disabled', true);
                $("#product").find('button').attr('disabled', true);
            }
        });

        jQuery('#sidebar-btn').on('click', function(e) {
            jQuery('.dashboard-left-box').addClass('open');
        });
        jQuery('.sidebar-cross-icon').on('click', function(e) {
            jQuery('.dashboard-left-box').removeClass('open');
        });

    });
</script>
