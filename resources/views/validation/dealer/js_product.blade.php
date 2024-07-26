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
            },
            stocks_avaliable: {
                required: true,
                number: true,
            },
            price: {
                required: true,
                number: true,
                regex: /^\d+(\.\d{1,2})?$/,
            },
            shipping_price: {
                required: true,
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
            },
            stocks_avaliable: {
                required: `{{ __('customvalidation.product.stocks_avaliable.required') }}`,
                number: `{{ __('customvalidation.product.stocks_avaliable.number') }}`,
            },
            price: {
                required: `{{ __('customvalidation.product.price.required') }}`,
                number: `{{ __('customvalidation.product.price.number') }}`,
                regex: `{{ __('customvalidation.product.price.regex') }}`, // Add this message in your validation messages
    
            },
            shipping_price: {
                required: `{{ __('customvalidation.product.shipping_price.required') }}`,
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
