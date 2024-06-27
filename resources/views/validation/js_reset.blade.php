<script>
    jQuery(document).ready(function() {
        console.log("check reset");
        $("#reset_password").find('button').attr('disabled', false);
        const rules = {
            email: {
                // required: true,
                // //email: true,
                // regex: emailRegex,
            },
            password: {
                required: true,
                minlength: passwordMinLength,
                maxlength: passwordMaxLength,
                regex: passwordRegex,

            },
            password_confirmation: {
                required: true,
                equalTo: '#password',
            }
        }
        const messages = {

            email: {
                // required: `{{ __('customvalidation.login.email.required') }}`,
                // //email: `{{ __('customvalidation.login.email.email') }}`,
                // regex: `{{ __('customvalidation.login.email.regex', ['regex' => '${emailRegex}']) }}`,
            },
            password: {
                required: `{{ __('customvalidation.login.password.required') }}`,
                minlength: `{{ __('customvalidation.login.password.min', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.login.password.max', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.password.regex', ['regex' => '${passwordRegex}']) }}`,
            },
            password_confirmation: {
                required: `{{ __('customvalidation.login.password_confirmation.required') }}`,
                equalTo: `{{ __('customvalidation.login.password_confirmation.equalTo') }}`,

            }
        };

        handleValidation('reset_password', rules, messages);

        $("#reset_password").on("submit", function() {
            if ($('#login').valid()) {
                $("#login").find('button').attr('disabled', true);
            }
        });

    });
</script>
