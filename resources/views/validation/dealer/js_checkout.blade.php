<script>
    $(document).ready(function() {


        $.validator.addMethod("is_checked", function(value, element, params) {
            return $(params).is(":checked"); // Custom method to validate if any radio button is checked
        }, "Please select an option.");

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
            phone_number: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
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
            pin_code: {
                required: true,
                digits: true,
                minlength: 2,
                maxlength: 6,
            },
            street1: {
                required: true,
                minlength: 10,
                maxlength: 35,
            },
            street2: {
                maxlength: 100,
            },
            shippingMethod: {
                is_checked: 'input[name="shippingMethod"]',
            },
        }
        const messages = {
            name: {
                required: `{{ __('customvalidation.user.name.required') }}`,
                minlength: `{{ __('customvalidation.user.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.name.regex', ['regex' => '${nameRegex}']) }}`,
            },
            phone_number: {
                required: `{{ __('customvalidation.user.phone_number.required') }}`,
                digits: "only number allowed",
                minlength: `{{ __('customvalidation.user.phone_number.minlength') }}`,
                maxlength: `{{ __('customvalidation.user.phone_number.maxlength') }}`,
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
                required: `{{ __('customvalidation.user.state.required') }}`,
            },
            city: {
                required: `{{ __('customvalidation.user.city.required') }}`,
            },
            shippingMethod: {
                is_checked: `{{ __('customvalidation.checkout.shippingMethod.required') }}`,
            },
            street1: {
                required: `{{ __('customvalidation.addresses.address1.required') }}`,
                minlength: `{{ __('customvalidation.addresses.address1.min') }}`,
                maxlength: `{{ __('customvalidation.addresses.address1.max') }}`,
            },
            description: {
                maxlength: `{{ __('customvalidation.addresses.description.max') }}`
            },
        };
        handleValidation('product-card-details', rules, messages, true);
        jQuery("#place-order").on("click", function(e) {
            if (($('#product-card-details').valid())) {
                jQuery('#fullPageLoader').removeClass('d-none');
            }
        });
    });
</script>