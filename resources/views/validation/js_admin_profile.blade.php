<script>
    jQuery(document).ready(function() {
        const rules = {
            name: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
                regex: nameRegex,
            },

            email: {
                required: true,
                email: true,
                regex: emailRegex,
            },
            phone_number: {
                digits: true,
                minlength: 10,
                maxlength: 10,
            },
            password: {
                minlength: passwordMinLength,
                maxlength: passwordMaxLength,
                regex: passwordRegex,
            },
            confirm_password: {
                equalTo: "#conPassword",
            },
            profile_pic: {
                filesize: profilePicSize,
                extension: profilePicMimes,
            },
        }
        const messages = {
            name: {
                required: `{{ __('customvalidation.profile.name.required') }}`,
                minlength: `{{ __('customvalidation.profile.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.profile.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                regex: `{{ __('customvalidation.profile.name.regex', ['regex' => '${nameRegex}']) }}`,
            },
            email: {
                required: `{{ __('customvalidation.profile.email.required') }}`,
                email: `{{ __('customvalidation.profile.email.email') }}`,
                regex: `{{ __('customvalidation.profile.email.regex', ['regex' => '${emailRegex}']) }}`,
            },
            phone_number: {
                digits: `{{ __('customvalidation.profile.phone_number.digits') }}`,
                minlength: `{{ __('customvalidation.profile.phone_number.minlength') }}`,
                maxlength: `{{ __('customvalidation.profile.phone_number.maxlength') }}`,
            },
            profile_pic: {
                filesize: `{{ __('customvalidation.profile.profile_pic.size', ['min' => '${profilePicSize}']) }}`,
                extension: `{{ __('customvalidation.profile.profile_pic.mimes', ['mime' => '${profilePicMimes}']) }}`,
            },

            password: {
                // required: `{{ __('customvalidation.user.password.required') }}`,
                minlength: `{{ __('customvalidation.user.password.min', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.password.max', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.password.regex', ['regex' => '${passwordRegex}']) }}`,

            },
            confirm_password: {
                equalTo: `{{ __('customvalidation.user.confirm_password.equal') }}`,
                // required: `{{ __('customvalidation.user.confirm_password.required') }}`,
            }
        };

        handleValidation('adminprofile', rules, messages);
    });
</script>
