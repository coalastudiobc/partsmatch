<script>
    jQuery(document).ready(function() {
        const rules = {
            ordercommission_type: {
                required: true,
            },
            ordercommission: {
                required: true,
            }
        }
        const messages = {

            ordercommission_type: {
                required: `{{ __('customvalidation.commission.ordercommission_type.required') }}`,
            },
            ordercommission: {
                required: `{{ __('customvalidation.commission.ordercommission.required') }}`,
            }
        };

        handleValidation('commission', rules, messages);

    });
</script>
