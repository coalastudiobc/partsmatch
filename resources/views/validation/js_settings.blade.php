<script>
    jQuery(document).ready(function() {
        jQuery('#settings').find('button').attr('disabled', true);
        const rules = {
            stripe_key: {
                required: true,
            },
            secret_key: {
                required: true,
            },
            //   webhook_secret:{
            //       required:true,
            //   },
        }
        const messages = {
            stripe_key: {
                required: `{{ __('customvalidation.stripe_settings.stripe_key.required') }}`,
            },
            secret_key: {
                required: `{{ __('customvalidation.stripe_settings.secret_key.required') }}`,
            },
            webhook_secret: {
                required: `{{ __('customvalidation.stripe_settings.webhook_secret.required') }}`,
            },
        };

        handleValidation('settings', rules, messages);
        if (jQuery('#settings').valid()) {
            jQuery('#settings').find('button').attr('disabled', false);

        }
    });
</script>
