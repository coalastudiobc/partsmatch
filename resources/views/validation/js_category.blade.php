<script>
  jQuery(document).ready(function(){
        const rules = {
            name: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
                regex: nameRegex,
            }
        }
        const messages = {

            name: {
                required:  `{{ __('customvalidation.category.name.required') }}`,
                regex:     `{{ __('customvalidation.category.name.regex', ['regex' => '${nameRegex}']) }}`,
            }
        };

        handleValidation('category', rules, messages);

    });
</script>
