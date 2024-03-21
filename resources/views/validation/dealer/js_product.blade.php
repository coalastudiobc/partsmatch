<script>
    jQuery(document).ready(function() {
        console.log("product");
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
            price: {
                required: true,
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
            price: {
                required: `{{ __('customvalidation.product.price.required') }}`,
            },
            shipping_price: {
                required: `{{ __('customvalidation.product.shipping_price.required') }}`,
            },

        };

        handleValidation('product', rules, messages);
    });
</script>
