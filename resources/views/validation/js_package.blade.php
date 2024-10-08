<script>
    jQuery(document).ready(function() {
        const rules = {
            name: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
                regex: nameRegex,
            },
            price: {
                required: true,
            },
            time_type: {
                required: true,
            },
            description: {
                minlength: packageMinLength,
                maxlength: packageMaxLength,
            }
        }
        const messages = {
            name: {
                required: `{{ __('customvalidation.user.name.required') }}`,
                minlength: `{{ __('customvalidation.user.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.user.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                regex: `{{ __('customvalidation.user.name.regex', ['regex' => '${nameRegex}']) }}`,
            },
            price: {
                required: `{{ __('customvalidation.packageprice.price.required') }}`,
            },
            time_type: {
                required: `{{ __('customvalidation.package.timetype.required') }}`,
            },
            description: {
                minlength: `{{ __('customvalidation.package.description.min', ['min' => '${packageMinLength}', 'max' => '${packageMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.package.description.max', ['min' => '${packageMinLength}', 'max' => '${packageMaxLength}']) }}`,
            },
        };

        handleValidation('package', rules, messages);
    });
</script>
