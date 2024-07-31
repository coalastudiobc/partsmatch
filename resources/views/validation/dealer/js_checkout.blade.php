<script>
        function handleSpaces(event) {
            const input = event.target;
            const currentValue = input.value;
            const cursorPos = input.selectionStart; 

            if (currentValue.includes('  ')) {
                const newValue = currentValue.replace(/ {2}/g, '');
                input.value = newValue;
                input.selectionStart = input.selectionEnd = newValue.length;
            }
        }

        function preventLeadingSpaces(event) {
            const charCode = (event.which) ? event.which : event.keyCode;
            const input = event.target;
            const currentValue = input.value;
            
            if ([8, 9, 27, 13, 46, 190,189].indexOf(charCode) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (charCode === 65 && (event.ctrlKey === true || event.metaKey === true)) ||
                // Allow: Ctrl+C, Ctrl+X, Ctrl+V
                (event.ctrlKey === true && [67, 88, 86].indexOf(charCode) !== -1)) {
                // Let it happen, don't do anything
                return;
            }
            
            // Prevent leading space
            if (charCode === 32 && (currentValue.length === 0 || /^\s/.test(currentValue))) {
                event.preventDefault();
            }
        }

        function handleBlur(event) {
            const input = event.target;
            const value = input.value;

            let trimmedValue = value.trimEnd();
            if (value.endsWith(' ')) {
                trimmedValue += ' '; 
            }
            input.value = trimmedValue;
        }

        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('#product-card-details input[type="text"]');
            
            inputs.forEach(input => {
                input.addEventListener('keypress', preventLeadingSpaces);
                input.addEventListener('blur', handleBlur);
                input.addEventListener('input', handleSpaces);
            });
        });

    $(document).ready(function() {

        const rules = {
            first_name: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
                regex: firstNameRegex,
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
            country: {
                required: true
            },
            state: {
                required: true
            },
            city: {
                required: true
            },
            pin_code: {
                required: true,
                digits: true,
                minlength: 5,
                maxlength: 6,
            },
            street1: {
                required: true,
                minlength: 10,
                maxlength: 35,
            },
            street2: {
                maxlength: 100,
            },
            shippingMethod: {
                is_checked: 'input[name="shippingMethod"]',
            },
        }
        const messages = {
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
            phone_number: {
                required: `{{ __('customvalidation.user.phone_number.required') }}`,
                digits: "only number allowed",
                minlength: `{{ __('customvalidation.user.phone_number.minlength') }}`,
                maxlength: `{{ __('customvalidation.user.phone_number.maxlength') }}`,
            },
            pin_code: {
                required: `{{ __('customvalidation.user.pin_code.required') }}`,
                digits: 'only number are allowed',
                minlength: `{{ __('customvalidation.user.pin_code.minlength', ['min' => '${pincodeMinLength}', 'max' => '${pincodeMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.pin_code.minlength', ['min' => '${pincodeMinLength}', 'max' => '${pincodeMaxLength}']) }}`,
            },
            country: {
                required: `{{ __('customvalidation.user.country.required') }}`,
            },
            state: {
                required: `{{ __('customvalidation.user.state.required') }}`,
            },
            city: {
                required: `{{ __('customvalidation.user.city.required') }}`,
            },
            shippingMethod: {
                is_checked: `{{ __('customvalidation.checkout.shippingMethod.required') }}`,
            },
            street1: {
                required: `{{ __('customvalidation.addresses.address1.required') }}`,
                minlength: `{{ __('customvalidation.addresses.address1.min') }}`,
                maxlength: `{{ __('customvalidation.addresses.address1.max') }}`,
            },
            description: {
                maxlength: `{{ __('customvalidation.addresses.description.max') }}`
            },
        };
        handleValidation('product-card-details', rules, messages, true);
        jQuery("#place-order").on("click", function(e) {
            if (($('#product-card-details').valid())) {
                jQuery('#fullPageLoader').removeClass('d-none');
            }
        });
    });
</script>