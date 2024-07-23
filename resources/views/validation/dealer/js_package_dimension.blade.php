<script>
    $(document).ready(function() {
        $.validator.addMethod('checkboxRequired', function(value, element) {
            return $('#checkbox3').is(':checked');
        }, 'You must accept the terms.');

        // Initialize form validation
        $("#packageDimension").validate({
            rules: {
                length: {
                    required: true,
                    number: true,
                    min: 0
                },
                width: {
                    required: true,
                    number: true,
                    min: 0
                },
                height: {
                    required: true,
                    number: true,
                    min: 0
                },
                dimension_unit: {
                    required: true
                },
                weight: {
                    required: true,
                    number: true,
                    min: 0
                },
                weight_unit: {
                    required: true
                },
                create_return_label: {
                    checkboxRequired: true
                }
            },
            messages: {
                length: {
                    required: "Please enter the length.",
                    number: "Length must be a number.",
                    min: "Length must be a positive number."
                },
                width: {
                    required: "Please enter the width.",
                    number: "Width must be a number.",
                    min: "Width must be a positive number."
                },
                height: {
                    required: "Please enter the height.",
                    number: "Height must be a number.",
                    min: "Height must be a positive number."
                },
                dimension_unit: {
                    required: "Please select a dimension unit."
                },
                weight: {
                    required: "Please enter the weight.",
                    number: "Weight must be a number.",
                    min: "Weight must be a positive number."
                },
                weight_unit: {
                    required: "Please select a weight unit."
                },
                create_return_label: {
                    checkboxRequired: "You must check the box to create a return label."
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") === "create_return_label") {
                    error.insertAfter($("#checkbox3").parent().next("label"));
                } else {
                    error.addClass('invalid-feedback');
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            submitHandler: (form, event) => {
                event.preventDefault();
                let formData = $(form).serialize();

                // fetch($(form).attr('action') {
                //         method: $(form).attr('method'),
                //         body: formData
                //     })
                //     .then(response => {
                //         if (response.ok) {
                //             return response.json(); // Parse JSON from the response
                //         } else {
                //             return response.json().then(errorData => {
                //                 throw new Error(errorData.message ||
                //                     'An error occurred while submitting the form.');
                //             });
                //         }
                //     })
                //     .then(result => {
                //         console.log('Success:', result);
                //         alert('Form submitted successfully!');
                //         // You might want to redirect the user or do something with the result
                //         // window.location.href = result.redirect_url;
                //     })
                //     .catch(error => {
                //         console.error('Fetch Error:', error);
                //         alert(error.message || 'An error occurred while submitting the form.');
                //     });

                var test = jQuery('.harvinder').attr('data-productId');
                let url = APP_URL + '/dealer/parcel/dimension/' + test;
                const result = ajaxCall(url, 'post', formData, true);
                result.then(handleCountryData).catch(handleCountryError)

                function handleCountryData(response) {
                    console.log(response);
                }

                function handleCountryError(error) {
                    console.log('error', error)
                }
            }
        });
        jQuery('.harvinder').on('click', function(e) {
            var test = jQuery(this).attr('data-productName');
            jQuery('.productName').text(test);
            console.log(test);
        });
    });
</script>
