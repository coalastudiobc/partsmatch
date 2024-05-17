<script>
    jQuery(document).ready(function() {
        // $("#submit").attr('disabled', false);

        const rules = {
            name: {
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

            email: {
                required: true,
                email: true,
                regex: emailRegex
            },
            country_id: {
                required: true
            },
            address: {
                required: true
            },
            zipcode: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6,
            },
            image: {
                required: true,
                imageExtension: true
            },
            industry_type: {
                required: true,
            },
            password: {
                required: true,
                minlength: passwordMinLength,
                maxlength: passwordMaxLength,
                regex: passwordRegex,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password",

            }
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
            email: {
                required: `{{ __('customvalidation.user.email.required') }}`,
                email: `{{ __('customvalidation.user.email.email') }}`,
                regex: `{{ __('customvalidation.user.email.regex', ['regex' => '${emailRegex}']) }}`,
            },
            address: {
                required: `{{ __('customvalidation.user.address.required') }}`,
            },
            zipcode: {
                required: `{{ __('customvalidation.user.zipcode.required') }}`,
                // digits: 'only number allowed',
                minlength: `{{ __('customvalidation.user.zipcode.minlength') }}`,
                maxlength: `{{ __('customvalidation.user.zipcode.maxlength') }}`,
            },
            country_id: {
                required: `{{ __('customvalidation.user.country.required') }}`,
            },
            image: {
                required: `{{ __('customvalidation.user.image.required') }}`,
                imageExtension: `{{ __('customvalidation.user.image.imageExtension') }}`,
            },
            industry_type: {
                required: `{{ __('customvalidation.user.industry_type.required') }}`,
            },
            password: {
                required: `{{ __('customvalidation.user.password.required') }}`,
                minlength: `{{ __('customvalidation.user.password.min', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.password.max', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.password.regex', ['regex' => '${passwordRegex}']) }}`,

            },
            password_confirmation: {
                required: `{{ __('customvalidation.user.confirm_password.required') }}`,
                equalTo: `{{ __('customvalidation.user.confirm_password.equal') }}`,

            }
        };
        handleValidation('register', rules, messages);

        // $("#submit").on("submit", function() {
        //     if ($('#register').valid()) {
        //         $("#submit").attr('disabled', true);
        //     }
        // });
    });
</script>
