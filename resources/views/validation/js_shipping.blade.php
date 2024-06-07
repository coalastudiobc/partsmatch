<script>
    jQuery(document).ready(function() {
        jQuery("#shipping").validate({
            rules: {
                range_from: {
                    required: true,
                    number: true, // Use 'number' instead of 'decimal'
                    min: 0, // Minimum value should be greater than or equal to zero
                },
                range_to: {
                    required: true,
                    greaterThan: '#range_from', // Corrected selector
                },
                shipping_charge_type: {
                    required: true,
                },
                shipping_charge: {
                    required: true,
                    number: true, // Use 'number' instead of 'decimal'
                }
            },
            messages: {
                range_from: {
                    required: "Please enter the value of Range From.",
                    number: "Only numbers!",
                    min: "Number should be greater than or equal to zero.",
                },
                range_to: {
                    required: "Please enter the value of Range To.",
                    number: "Only numbers!",
                    greaterThan: "Please enter a value greater than the specified range from.",
                },
                shipping_charge_type: {
                    required: "Please select a shipping charge type.",
                },
                shipping_charge: {
                    required: "Please enter the shipping charge.",
                    number: "Only numbers!",
                },
            },
            submitHandler: function(form) {
                // Submit the form via regular form submission
                form.submit();
            }
        });

        // Custom validation method for 'greaterThan'
        jQuery.validator.addMethod("greaterThan", function(value, element, params) {
            return parseFloat(value) > parseFloat($(params).val()); // Parse as float for comparison
        }, "Must be greater than {0}");

    });
    // $("#shipping").validate({
    //     rules = {
    //         range_from: {
    //             required: true,
    //             decimal: true,
    //             minlength: true,

    //         },
    //         range_to: {
    //             required: true,
    //             greaterThan: '#greaterFrom',
    //         },
    //         shipping_charge_type: {
    //             required: true,
    //         },
    //         shipping_charge: {
    //             required: true,
    //             decimal: true,
    //         }
    //     }
    //     messages = {
    //         range_from: {
    //             required: "Please enter the value of Range From.",
    //             decimal: "Only numbers!",
    //             minlength: 'number should be greater than zero',
    //         },
    //         range_to: {
    //             required: "Please enter the value of Range To.",
    //             decimal: "Only numbers!",
    //             greaterThan: "Please enter a value greater than the specified range_from.",
    //         },
    //         shipping_charge_type: {
    //             required: `{{ __('customvalidation.shipping.shipping_charge_type.required') }}`,
    //         },
    //         shipping_charge: {
    //             required: `{{ __('customvalidation.shipping.shipping_charge.required') }}`,
    //             decimal: "Only numbers!",
    //         },

    //     }

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
    // jQuery('#submitFiveJune').on('click', function(e) {
    //     if (jQuery('#shipping').valid()) {
    //         jQuery('#shipping').submit();
    //     } else {
    //         handlevalidation('shipping', rules, messages, true)
    //     }
    // });
    // var check = jQuery('#shipping').validate({
    //     rules,
    //     messages
    // });
    // jQuery('#submitFiveJune').on('click', function(e) {
    //     e.preventDefault();
    //     if (jQuery('#shipping').valid()) {
    //         jQuery('#shipping').submit();
    //     }
    // });
    //     submitHandler: function(form) {
    //         // Prevent default form submission
    //         event.preventDefault();

    //         // Submit the form via regular form submission
    //         form.submit();
    //     }
    // });

    // // Custom validation method for range_to
    // $.validator.addMethod("greaterThan", function(value, element, params) {
    //     return value > $(params).val();
    // }, "Must be greater than {0}");
</script>
