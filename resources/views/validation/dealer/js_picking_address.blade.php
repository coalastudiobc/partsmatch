<script>
    jQuery(document).ready(function() {
        // Initialize jQuery Validation
        $("#From_address").validate({
            rules: {
                country: {
                    required: true,
                    minlength: 1,
                },
                state: {
                    required: true,
                    minlength: 1,
                },
                city: {
                    required: true, 
                    minlength: 1,
                },
                pin_code: {
                    required: true, 
                    minlength: 5, 
                    maxlength: 10, 
                },
                first_name: {
                    required: true,
                    minlength: nameMinLength,
                    maxlength: nameMaxLength,
                    regex: nameRegex
                },
                last_name: {
                    required: true,
                    minlength: nameMinLength,
                    maxlength: nameMaxLength,
                    regex: nameRegex
                },
                phone_number: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                street1: {
                    required: true,
                    minlength: 10,
                    maxlength: 35,
                },
                street2: {
                    maxlength: 35,
                },
                description: {
                    maxlength: 100,
                },

            },

            messages: {
                country: {
                    required: "Please select a country.",
                },
                state: {
                    required: "Please select a state.",
                },
                city: {
                    required: "Please select a city.",
                },
                pin_code: {
                    required: "Please enter a pin code.",
                    minlength: "PIN code must be at least 5 characters long.",
                    maxlength: "PIN code must be at most 10 characters long."
                },
                first_name: {
                    required: `{{ __('customvalidation.user.name.required') }}`,
                    minlength: `{{ __('customvalidation.user.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                    maxlength: `{{ __('customvalidation.user.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                    regex: `{{ __('customvalidation.user.name.regex', ['regex' => '${nameRegex}']) }}`,
                },
                last_name: {
                    required: `{{ __('customvalidation.user.name.required') }}`,
                    minlength: `{{ __('customvalidation.user.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                    maxlength: `{{ __('customvalidation.user.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                    regex: `{{ __('customvalidation.user.name.regex', ['regex' => '${nameRegex}']) }}`,
                },
                street1: {
                    required: `{{ __('customvalidation.addresses.address1.required') }}`,
                    minlength: `{{ __('customvalidation.addresses.address1.min') }}`,
                    maxlength: `{{ __('customvalidation.addresses.address1.max') }}`
                },
                street2: {
                    maxlength: `{{ __('customvalidation.addresses.address2.max') }}`
                },
                description: {
                    maxlength: `{{ __('customvalidation.addresses.description.max') }}`
                },

                phone_number: {
                    required: `{{ __('customvalidation.user.phone_number.required') }}`,
                    digits: "only number allowed",
                    minlength: `{{ __('customvalidation.user.phone_number.minlength') }}`,
                    maxlength: `{{ __('customvalidation.user.phone_number.maxlength') }}`,
                },
            },
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');

                if (element.prop('type') === 'hidden') {
                    error.insertAfter(element
                        .parent()); // For hidden elements, insert after parent element
                } else {
                    error.insertAfter(element); // Insert error message after the element
                }
            },

            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },

            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            },
            submitHandler: function(form, event) {
                event.preventDefault();
                let formData = $(form).serialize();

                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: formData,
                    success: function(response) {
                        // Handle the response from the server
                        if (response.status === true) {
                            $(function() {
                                $('#pickadress-modal').modal('toggle');
                            });
                            $(".add-address-box").removeClass('open');
                            location.reload();
                            toastr.success(response.message);

                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.log('Error:', error);
                        console.log('Status:', status);
                        console.log('XHR:', xhr);
                    }
                });
            }
        });
        // $("#From_address").on("submit", function(event) {
        //     event.preventDefault();

        //     if ($("#From_address").valid()) {
        //         console.log('Form is valid, submitHandler will be called');
        //         $("#From_address").validate().submitHandler($("#From_address")[0]);
        //     } else {
        //         console.log('Form is not valid');
        //     }
        // });

        // Handle Country Selection
        jQuery(document).on('click', '.custom_dropdown_item', function() {
            var selectitem = jQuery(this).attr('data-value');
            var selecttext = jQuery(this).attr('data-text');
            jQuery('#selectedItem').text(selecttext);
            jQuery('input[name="country"]').val(selectitem);
            jQuery('#country_code').val(jQuery(this).attr('data-iso_code'));
            jQuery('#state_iso').val('');
            jQuery('#city_name').val('');
            jQuery('#selectedState').text('Select State');
            jQuery('#selectedCity').text('Select City');
            jQuery('.state').empty();
            jQuery('.city').empty();

            let url = APP_URL + '/dealer/state/' + selectitem;
            if (jQuery.isNumeric(selectitem) && selectitem > 0) {
                ajaxCall(url, 'get')
                    .then(handleCountryData)
                    .catch(handleCountryError);
            }
        });

        // Handle State Selection
        jQuery(document).on('click', '.state_dropdown_item', function() {
            var stateId = jQuery(this).attr('data-value');
            var statevalue = jQuery(this).attr('data-name');
            var selecttext = jQuery(this).attr('data-text');
            jQuery('#selectedState').text(selecttext);
            jQuery('input[name="state"]').val(statevalue);
            jQuery('#city_name').val('');
            jQuery('#selectedCity').text('Select City');
            jQuery('.city').empty();

            let url = APP_URL + '/dealer/cities/' + stateId;
            if (jQuery.isNumeric(stateId) && stateId > 0) {
                ajaxCall(url, 'get')
                    .then(handleStateData)
                    .catch(handleCountryError);
            }
        });

        // Handle City Selection
        jQuery(document).on('click', '.city_dropdown_item', function() {
            var cityId = jQuery(this).attr('data-value');
            var selecttext = jQuery(this).attr('data-text');
            jQuery('#selectedCity').text(selecttext);
            jQuery('input[name="city"]').val(cityId);
        });

        // Utility function for AJAX calls
        function ajaxCall(url, method, data = {}) {
            return $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'json'
            });
        }

        function handleCountryData(response) {
            let options = '<li> <a href="javascript:void(0)"> Select </a></li>';
            jQuery('.state').empty();
            jQuery('#city').html('<option value="">Select City</option>');
            response.data.forEach(state => {
                $('.state').append(`<li><a class="dropdown-item state_dropdown_item select_state"
                                                                    data-value="${state.id}"
                                                                    data-text="${state.name}"
                                                                    data-name="${state.name}"
                                                                    href="javascript:void(0)">${state.name}</a>
                                                            </li>`)
            });
            jQuery('#state').html(options);
        }



        function handleStateData(response) {
            let options = '<li> <a href="javascript:void(0)"> Select </a></li>';
            jQuery('.city').empty();
            response.data.forEach(city => {
                $('.city').append(
                    `<li><a class="dropdown-item city_dropdown_item" data-value="${city.id}" data-text="${city.name}" href="javascript:void(0)">${city.name}</a></li>`
                );
            });
        }

        function handleCountryError(error) {
            console.log('Error:', error);
        }
    });
</script>
