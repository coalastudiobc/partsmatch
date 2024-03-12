<script>
    jQuery(document).ready(function() {

        $("#login").find('button').attr('disabled', false);
        const rules = {
            email: {
                required: true,
                regex: emailRegex,
            },
            password: {
                required: true,
                minlength: passwordMinLength,
                maxlength: passwordMaxLength,
            }
        }
        const messages = {

            email: {
                required: `{{ __('customvalidation.login.email.required') }}`,
                regex: `{{ __('customvalidation.login.email.regex', ['regex' => '${emailRegex}']) }}`,
            },
            password: {
                required: `{{ __('customvalidation.login.password.required') }}`,
                minlength: `{{ __('customvalidation.login.password.min', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.login.password.max', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
            }
        };

        // handleValidation('login', rules, messages);

        $("#login").on("submit", function() {
            if ($('#login').valid()) {
                $("#login").find('button').attr('disabled', true);
            }
        });

    });
</script>
