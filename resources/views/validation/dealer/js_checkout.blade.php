<script>
    $(document).ready(function() {
        const rules = {
            first_name: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
                regex: nameRegex
            },
            last_name: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
                regex: nameRegex
            },
            country: {
                required: true
            },
            state: {
                required: true
            },
            city: {
                required: true
            },
            shiping_address1: {
                required: true
            },
            shiping_address2: {
                required: true
            },
            pin_code: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6,
            },



        }
        const messages = {
            name: {
                required: `{{ __('customvalidation.user.name.required') }}`,
                minlength: `{{ __('customvalidation.user.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.name.regex', ['regex' => '${nameRegex}']) }}`,
            },

            shipping_address1: {
                required: `{{ __('customvalidation.user.address.required') }}`,
            },

            shipping_address2: {
                required: `{{ __('customvalidation.user.address.required') }}`,
            },
            pin_code: {
                required: `{{ __('customvalidation.user.pin_code.required') }}`,
                // digits: 'only number allowed',
                minlength: `{{ __('customvalidation.user.pin_code.minlength') }}`,
                maxlength: `{{ __('customvalidation.user.pin_code.maxlength') }}`,
            },
            country: {
                required: `{{ __('customvalidation.user.country.required') }}`,
            },
            state: {
                required: `{{ __('customvalidation.user.country.required') }}`,
            },
            city: {
                required: `{{ __('customvalidation.user.country.required') }}`,
            },


        };
        handleValidation('product-card-details', rules, messages, true);
    });
</script>
