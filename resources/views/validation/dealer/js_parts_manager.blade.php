<script>
    jQuery(document).ready(function() {
        console.log("hwrerere");
        const rules = {
            name: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
                regex: nameRegex,
            },
            image: {
                required: true,
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

            },
            password: {
                required: true,
                minlength: passwordMinLength,
                maxlength: passwordMaxLength,
                regex: passwordRegex,
            },
            password_confirmation: {
                required: true,
                equalTo: "#manager_confirm_password"
            }
        }
        const messages = {
            name: {
                required: `{{ __('customvalidation.user.name.required') }}`,
                minlength: `{{ __('customvalidation.profile.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.profile.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                regex: `{{ __('customvalidation.profile.name.regex', ['regex' => '${nameRegex}']) }}`,
            },
            image: {
                required: `{{ __('customvalidation.profile.profile_pic.required') }}`,
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
            },
            password: {
                required: `{{ __('customvalidation.user.password.required') }}`,
                minlength: `{{ __('customvalidation.user.password.min', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.password.max', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.password.regex', ['regex' => '${passwordRegex}']) }}`,

            },
            password_confirmation: {
                equalTo: `{{ __('customvalidation.user.confirm_password.equal') }}`,
                required: `{{ __('customvalidation.user.confirm_password.required') }}`,
            }
        };

        handleValidation('parts_manager', rules, messages);
    });
</script>
