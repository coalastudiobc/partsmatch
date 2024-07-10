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
            street1: {
                required: true,
                minlength: 10,
                maxlength: 35,
            },
            street2: {
                maxlength: 35,
            },
            description: {
                maxlength: 100,
            },
            pin_code: {
                required: true,
                digits: true,
                minlength: 2,
                maxlength: 6,
            },



        }
        const messages = {
            first_name: {
                required: `{{ __('customvalidation.user.name.required') }}`,
                minlength: `{{ __('customvalidation.user.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.name.regex', ['regex' => '${nameRegex}']) }}`,
            },
            last_name: {
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
            country: {
                required: `{{ __('customvalidation.user.country.required') }}`,
            },
            state: {
                required: `{{ __('customvalidation.user.state.required') }}`,
            },
            city: {
                required: `{{ __('customvalidation.user.city.required') }}`,
            },

            street1: {
                required: `{{ __('customvalidation.addresses.address1.required') }}`,
                minlength: `{{ __('customvalidation.addresses.address1.min') }}`,
                maxlength: `{{ __('customvalidation.addresses.address1.max') }}`
            },
            street2: {
                maxlength: `{{ __('customvalidation.addresses.address2.max') }}`
            },
            description: {
                maxlength: `{{ __('customvalidation.addresses.description.max') }}`
            },
            pin_code: {
                required: `{{ __('customvalidation.user.pin_code.required') }}`,
                digits: 'only number allowed',
                minlength: `{{ __('customvalidation.user.pin_code.minlength') }}`,
                maxlength: `{{ __('customvalidation.user.pin_code.maxlength') }}`,
            },


        };
        handleValidation('From_address', rules, messages, true);
    });
</script>
