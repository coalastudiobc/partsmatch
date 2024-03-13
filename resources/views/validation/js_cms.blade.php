<script>
    jQuery(document).ready(function() {
        const rules = {
            name: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
            },
            slug: {
                required: true,
                minlength: nameMinLength,
                maxlength: nameMaxLength,
            },
            short_content: {
                minlength: nameMinLength,
                maxlength: nameMaxLength,
            },
            content: {
                required: true,
                minlength: nameMinLength,
            },
            page_title: {
                minlength: nameMinLength,
                maxlength: nameMaxLength,
            },
            meta_title: {
                minlength: nameMinLength,
                maxlength: nameMaxLength,
            },
            meta_description: {
                minlength: nameMinLength,
            },
            status: {
                required: true,
            },
            image: {
                // filesize: profilePicSize,
                // extension: profilePicMimes
            }

        }
        const messages = {
            name: {
                required: `{{ __('customvalidation.cms.name.required') }}`,
                minlength: `{{ __('customvalidation.cms.name.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.cms.name.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
            },
            slug: {
                required: `{{ __('customvalidation.cms.slug.required') }}`,
                minlength: `{{ __('customvalidation.cms.slug.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.cms.slug.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
            },
            content: {
                required: `{{ __('customvalidation.cms.content.required') }}`,
                minlength: `{{ __('customvalidation.cms.content.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
            },
            short_content: {
                minlength: `{{ __('customvalidation.cms.short_content.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.cms.short_content.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
            },
            page_title: {
                minlength: `{{ __('customvalidation.cms.page_title.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.cms.page_title.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
            },
            meta_title: {
                minlength: `{{ __('customvalidation.cms.meta_title.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                maxlength: `{{ __('customvalidation.cms.meta_title.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
            },
            meta_description: {
                minlength: `{{ __('customvalidation.cms.meta_description.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
            },
            status: {
                required: `{{ __('customvalidation.cms.status.required') }}`,
            },
            image: {
                filesize: `{{ __('customvalidation.cms.image.size', ['min' => '${profilePicSize}']) }}`,
                extension: `{{ __('customvalidation.cms.image.mimes', ['mime' => '${profilePicMimes}']) }}`
            },
        };

        handleValidation('cms', rules, messages);


    });
</script>
