<script>
    jQuery(document).ready(function() {
        console.log("hwrerere");
        const rules = {
            name: {
                required: true,
                // minlength: nameMinLength,
                // maxlength: nameMaxLength,
                // regex: nameRegex,
            },

            email: {
                required: true,
                email: true,
                // regex: emailRegex,
            },
            phone_number: {
                required: true,
            },
            industry_type: {
                required: true,
            },
            address: {
                required: true,
            },
        }
        const messages = {
            name: {
                required: `__('customvalidation.user.name.required')`,
                // minlength: `{{ __('customvalidation.profile.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                // maxlength: `{{ __('customvalidation.profile.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                // regex: `{{ __('customvalidation.profile.name.regex', ['regex' => '${nameRegex}']) }}`,
            },
            email: {
                required: `__('customvalidation.user.email.required')`,
                email: `{{ __('customvalidation.user.email.email') }}`,
                // regex: `{{ __('customvalidation.user.email.regex', ['regex' => '${emailRegex}']) }}`,
            },
            phone_number: {
                required: `__('customvalidation.user.phone_number.required')`,
            },
            industry_type: {
                required: `__('customvalidation.user.industry_type.required')`,

            },
            address: {
                required: `__('customvalidation.user.address.required')`,
            },
        };

        handleValidation('account_setting', rules, messages);
    });
</script>
