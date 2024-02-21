<script>  
    jQuery(document).ready(function(){
          const rules = {
            stripe_id: {
                  required: true,
              },
              stripe_key: {
                  required: true,
              },
            //   webhook_secret:{
            //       required:true,
            //   },
          }
          const messages = {
            stripe_id: {
                  required: `{{ __('customvalidation.stripe_settings.stripe_id.required') }}`,
              },
              stripe_key: {
                  required: `{{ __('customvalidation.stripe_settings.stripe_key.required') }}`,
              },
            //   webhook_secret:{
            //     required: `{{ __('customvalidation.stripe_settings.webhook_secret.required') }}`,
            //   },
          };
  
          handleValidation('settings', rules, messages);
          
      });
  </script>