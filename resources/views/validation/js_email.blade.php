<script>
    jQuery(document).ready(function() {
        $("#send_email").find('button').attr('disabled', false);
        const rules = {
            email: {
                required: true,
                regex: emailRegex,
            },

        }
        const messages = {

            email: {
                required: `{{ __('customvalidation.login.email.required') }}`,
                regex: `{{ __('customvalidation.login.email.regex', ['regex' => '${emailRegex}']) }}`,
            },
        };

        handleValidation('send_email', rules, messages);

        $("#send_email").on("submit", function() {
            if ($('#login').valid()) {
                $("#login").find('button').attr('disabled', true);
            }
        });

    });
</script>
