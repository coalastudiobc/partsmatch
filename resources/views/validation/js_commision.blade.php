<script>
    jQuery(document).ready(function() {
        rules = {
            ordercommission_type: {
                required: true,
            },
            ordercommission: {
                required: true,
                decimal: true,
            }
        }
        const messages = {

            ordercommission_type: {
                required: `{{ __('customvalidation.commission.ordercommission_type.required') }}`,
            },
            ordercommission: {
                required: `{{ __('customvalidation.commission.ordercommission.required') }}`,
                decimal: "Only numbers!",
            },

        };

        // jQuery('#checkcommission').on('keyup', function(e) {
        //     var $this = $('#checkcommission');

        //     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //         $this.val('');
        //         return false;
        //     } else {

        //         if (jQuery('#checktype :selected').val() == 'Percentage') {
        //             var val = $this.val();
        //             if (val > 100) {
        //                 $this.val($this.val().substring(0, val == 100 ? 3 : 2));
        //             } else if (val < 1) {
        //                 $this.val('');
        //             }

        //         } else {
        //             var val = $this.val();
        //             if (val > 9999) {
        //                 $this.val($this.val().substring(0, 4));
        //             } else if (val < 1) {
        //                 $this.val('');
        //             }
        //         }
        //     }
        // });
        handleValidation('commission', rules, messages);
    });
</script>
