<script>
    jQuery(document).ready(function() {
        const rules = {
            name: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
                regex: nameRegex,
            },
            image: {
                filesize: profilePicSize,
                extension: profilePicMimes,
            },
            email: {
                required: true,
                email: true,
                regex: emailRegex,
            },
            phone_number: {
                required: true,
                phoneNumber:true,
                phoneNumberFormat:true,
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
                required: `{{ __('customvalidation.user.name.required') }}`,
                minlength: `{{ __('customvalidation.profile.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.profile.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                regex: `{{ __('customvalidation.profile.name.regex', ['regex' => '${nameRegex}']) }}`,
            },
            image: {
                filesize: `{{ __('customvalidation.profile.profile_pic.size', ['min' => '${profilePicSize}']) }}`,
                extension: `{{ __('customvalidation.profile.profile_pic.mimes', ['mime' => '${profilePicMimes}']) }}`,
            },
            email: {
                required: `{{ __('customvalidation.user.email.required') }}`,
                email: `{{ __('customvalidation.user.email.email') }}`,
                regex: `{{ __('customvalidation.user.email.regex', ['regex' => '${emailRegex}']) }}`,
            },
            phone_number: {
                required: `{{ __('customvalidation.user.phone_number.required') }}`,
                minlength: `{{ __('customvalidation.user.phone_number.minlength') }}`,
                maxlength: `{{ __('customvalidation.user.phone_number.maxlength') }}`,
            },
            industry_type: {
                required: `{{ __('customvalidation.user.industry_type.required') }}`,

            },
            address: {
                required: `{{ __('customvalidation.user.address.required') }}`,
            },
        };

        handleValidation('account_setting', rules, messages);
        $("#account_setting").on("submit", function() {
            if ($('#account_setting').valid()) {
                $("#submit").attr('disabled', true);
                $("#account_setting").find('button').attr('disabled', true);
            }
        });
    });
</script>