<script>
    $(document).ready(function() {
        $("#submit").attr('disabled', false);

        $.validator.addMethod("phoneNumber", function (value, element) {
            var digits = value.replace(/\D/g, '');
            return this.optional(element) || (digits.length === 10);
        }, "Please enter a valid phone number with 10 digits.");

        $.validator.addMethod("phoneNumberFormat", function (value, element) {
        var digits = value.replace(/\D/g, '');
        if (digits.startsWith('0')) {
            return false; // Invalid: Starts with a zero
        }
        var formattedValue = '';
        if (digits.length > 0) {
            formattedValue = '(' + digits.substring(0, 3);
            if (digits.length > 3) {
                formattedValue += ') ' + digits.substring(3, 6);
            }
            if (digits.length > 6) {
                formattedValue += '-' + digits.substring(6, 10);
            }
        }
        return this.optional(element) || value === formattedValue;
        }, "Phone number format is invalid or starts with zero.");

        const rules = {
            name: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
                regex: nameRegex
            },
            dealershipName: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
                regex: nameRegex
            },
            phone_number: {
                required: true,
                phoneNumber:true,
                phoneNumberFormat:true,
                // digits: true,
                // minlength: 10,
                // maxlength: 10
            },

            email: {
                required: true,
                email: true,
                regex: emailRegex
            },
            country_id: {
                required: true
            },
            address: {
                required: true
            },
            zipcode: {
                required: true,
                // minlength: 5,
                // maxlength: 6,
            },
            image: {
                required: true,
                imageExtension: true,
            },
            industry_type: {
                required: true,
            },
            password: {
                required: true,
                minlength: passwordMinLength,
                maxlength: passwordMaxLength,
                regex: passwordRegex,
            },
            password_confirmation: {
                required: true,
                equalTo: "#password",

            }
        }
        const messages = {
            name: {
                required: `{{ __('customvalidation.user.name.required') }}`,
                minlength: `{{ __('customvalidation.user.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.name.regex', ['regex' => '${nameRegex}']) }}`,
            },
            dealershipName: {
                required: `{{ __('customvalidation.user.dealershipName.required') }}`,
                minlength: `{{ __('customvalidation.user.dealershipName.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.dealershipName.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.dealershipName.regex', ['regex' => '${nameRegex}']) }}`,
            },
            phone_number: {
                required: `{{ __('customvalidation.user.phone_number.required') }}`,
                minlength: `{{ __('customvalidation.user.phone_number.minlength') }}`,
                maxlength: `{{ __('customvalidation.user.phone_number.maxlength') }}`,
            },
            email: {
                required: `{{ __('customvalidation.user.email.required') }}`,
                email: `{{ __('customvalidation.user.email.email') }}`,
                regex: `{{ __('customvalidation.user.email.regex', ['regex' => '${emailRegex}']) }}`,
            },
            address: {
                required: `{{ __('customvalidation.user.address.required') }}`,
            },
            zipcode: {
                required: `{{ __('customvalidation.user.zipcode.required') }}`,
                minlength: `{{ __('customvalidation.user.pin_code.minlength', ['min' => '${pincodeMinLength}', 'max' => '${pincodeMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.pin_code.minlength', ['min' => '${pincodeMinLength}', 'max' => '${pincodeMaxLength}']) }}`,
            },
            country_id: {
                required: `{{ __('customvalidation.user.country.required') }}`,
            },
            image: {
                required: `{{ __('customvalidation.user.image.required') }}`,
                imageExtension: `{{ __('customvalidation.user.image.imageExtension') }}`,
            },
            industry_type: {
                required: `{{ __('customvalidation.user.industry_type.required') }}`,
            },
            password: {
                required: `{{ __('customvalidation.user.password.required') }}`,
                minlength: `{{ __('customvalidation.user.password.min', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.password.max', ['min' => '${passwordMinLength}', 'max' => '${passwordMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.password.regex', ['regex' => '${passwordRegex}']) }}`,

            },
            password_confirmation: {
                required: `{{ __('customvalidation.user.confirm_password.required') }}`,
                equalTo: `{{ __('customvalidation.user.confirm_password.equal') }}`,

            }
        };
        handleValidation('register', rules, messages);

        $("#register").on("submit", function() {
            if ($('#register').valid()) {
                $("#register").find('button').attr('disabled', true);
            }
        });
    });
</script>
