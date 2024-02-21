<script>
jQuery(document).ready(function(){
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
        country_id:{
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
            equalTo: "#password_confirmation"
        }
    }
    const messages = {
        name: {
            required: `{{ __('customvalidation.user.name.required') }}`,
            minlength: `{{ __('customvalidation.user.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
            maxlength: `{{ __('customvalidation.user.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
            regex: `{{ __('customvalidation.user.name.regex', ['regex' => '${nameRegex}']) }}`,
        },
        email: {
            required: `{{ __('customvalidation.user.email.required') }}`,
            email: `{{ __('customvalidation.user.email.email') }}`,
            regex: `{{ __('customvalidation.user.email.regex', ['regex' => '${emailRegex}']) }}`,
        },
        country_id: {
            required: `{{ __('customvalidation.user.country.required') }}`,
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
    handleValidation('register', rules, messages);
});
</script>
