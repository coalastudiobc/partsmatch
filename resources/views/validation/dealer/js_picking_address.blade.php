<script>
    jQuery(document).ready(function() {
        // Initialize jQuery Validation
        $("#From_address").validate({
            rules: {
                country: {
                    required: true,
                },
                state: {
                    required: true,
                    minlength: 1,
                },
                city: {
                    required: true,
                },
                pin_code: {
                    required: true,
                    minlength: 5,
                    maxlength: 10,
                },
                email: {
                    email: true,
                    regex: emailRegex
                },
                first_name: {
                    required: true,
                    minlength: nameMinLength,
                    maxlength: nameMaxLength,
                    regex: firstNameRegex
                },
                last_name: {
                    required: true,
                    minlength: nameMinLength,
                    maxlength: nameMaxLength,
                    regex: lastNameRegex
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
                    required: `{{ __('customvalidation.user.firstName.required') }}`,
                    minlength: `{{ __('customvalidation.user.firstName.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                    maxlength: `{{ __('customvalidation.user.firstName.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                    regex: `{{ __('customvalidation.user.firstName.regex', ['regex' => '${nameRegex}']) }}`,
                },
                last_name: {
                    required: `{{ __('customvalidation.user.lastName.required') }}`,
                    minlength: `{{ __('customvalidation.user.lastName.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                    maxlength: `{{ __('customvalidation.user.lastName.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                    regex: `{{ __('customvalidation.user.lastName.regex', ['regex' => '${nameRegex}']) }}`,
                },
                email: {
                    email: `{{ __('customvalidation.user.email.email') }}`,
                    regex: `{{ __('customvalidation.user.email.regex', ['regex' => '${emailRegex}']) }}`,
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
                if (error.prop('type') === 'hidden') {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },

            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },

            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form, event) {
                event.preventDefault();

                var countryValue = $('#country_code').val();
                var stateValue = $('#state_iso').val();
                var cityValue = $('#city_name').val();
                var hasErrors = false; // Flag to track if there are validation errors

                // Validate country
                if (!countryValue) {
                    $('#country_code').addClass('is-invalid');
                    if ($('#country_code').next('.invalid-feedback').length === 0) {
                        $('#country_code').after('<span class="invalid-feedback" role="alert"><strong>Please select a country.</strong></span>');
                    }
                    hasErrors = true;
                }

                // Validate state
                if (!stateValue) {
                    $('#state_iso').addClass('is-invalid');
                    if ($('#state_iso').next('.invalid-feedback').length === 0) {
                        $('#state_iso').after('<span class="invalid-feedback" role="alert"><strong>Please select a state.</strong></span>');
                    }
                    hasErrors = true;
                }

                // Validate city
                if (!cityValue) {
                    $('#city_name').addClass('is-invalid');
                    if ($('#city_name').next('.invalid-feedback').length === 0) {
                        $('#city_name').after('<span class="invalid-feedback" role="alert"><strong>Please select a city.</strong></span>');
                    }
                    hasErrors = true;
                }

                if (hasErrors) {
                    return; // Prevent form submission if there are validation errors
                }
                let formData = $(form).serialize();
                jQuery('#fullPageLoader').removeClass('d-none');
                $("#From_address").find('button').attr('disabled', true);
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: formData,
                    success: function(response) {
                        if (response.status === true) {
                            jQuery('#fullPageLoader').addClass('d-none');
                            $("#From_address").find('button').attr('disabled', false);
                            $(function() {
                                $('#pickadress-modal').modal('toggle');
                            });
                            $(".add-address-box").removeClass('open');
                            location.reload();
                            toastr.success(response.message);

                        } else {
                            jQuery('#fullPageLoader').addClass('d-none');
                            $("#From_address").find('button').attr('disabled', false);
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        jQuery('#fullPageLoader').addClass('d-none');
                        $("#From_address").find('button').attr('disabled', false);
                        console.log('Error:', error);
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
            jQuery('#selectedItem').text(capitalizeFirst(selecttext));
            jQuery('input[name="country"]').val(selectitem);
            $('#country_code').removeClass('is-invalid').next('.invalid-feedback').text('');
            jQuery('#country_code').val(jQuery(this).attr('data-iso_code'));
            jQuery('#state_iso').val('');
            jQuery('#city_name').val('');
            jQuery('#selectedState').text('Select State');
            jQuery('#selectedCity').text('Select City');
            jQuery('.state').empty();
            jQuery('.city').empty();

            let url = APP_URL + '/dealer/state/' + selectitem;
            if (jQuery.isNumeric(selectitem) && selectitem > 0) {
                ajaxCall(url, 'get').then(handleCountryData).catch(handleCountryError);
            }
        });

        // Handle State Selection
        jQuery(document).on('click', '.state_dropdown_item', function() {
            var stateId = jQuery(this).attr('data-value');
            var statevalue = jQuery(this).attr('data-name');
            var selecttext = jQuery(this).attr('data-text');
            jQuery('#selectedState').text(selecttext);
            jQuery('input[name="state"]').val(statevalue);
            jQuery('input[name="state"]').removeClass('is-invalid').next('.invalid-feedback').text('');
            jQuery('#city_name').val('');
            jQuery('#selectedCity').text('Select City');
            jQuery('.city').empty();

            let url = APP_URL + '/dealer/cities/' + stateId;
            if (jQuery.isNumeric(stateId) && stateId > 0) {
                ajaxCall(url, 'get').then(handleStateData).catch(handleCountryError);
            }
        });

        // Handle City Selection
        jQuery(document).on('click', '.city_dropdown_item', function() {
            var cityId = jQuery(this).attr('data-value');
            var selecttext = jQuery(this).attr('data-text');
            jQuery('#selectedCity').text(selecttext);
            jQuery('input[name="city"]').val(cityId);
            jQuery('input[name="city"]').removeClass('is-invalid').next('.invalid-feedback').text('');
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
                                                                    data-text="${capitalizeFirst(state.name)}"
                                                                    data-name="${capitalizeFirst(state.name)}"
                                                                    href="javascript:void(0)">${capitalizeFirst(state.name)}</a>
                                                            </li>`)
            });
            jQuery('#state').html(options);
        }



        function handleStateData(response) {
            let options = '<li> <a href="javascript:void(0)"> Select </a></li>';
            jQuery('.city').empty();
            response.data.forEach(city => {
                $('.city').append(`<li><a class="dropdown-item city_dropdown_item" 
                                                                data-value="${city.id}" 
                                                                data-text="${capitalizeFirst(city.name)}" 
                                                                href="javascript:void(0)">${capitalizeFirst(city.name)}</a></li>`
                );
            });
        }

        function handleCountryError(error) {
            console.log('Error:', error);
        }
    });
</script>