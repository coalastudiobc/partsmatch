<script>
    jQuery(document).ready(function(){
          const rules = {
            title: {
                  required: true,
                  minlength: nameMinLength,
                  maxlength: nameMaxLength,
              },
              description: {
                  required: true,
                  minlength: nameMinLength,
              },
              short_content: {
                  required: true,
                  minlength: nameMinLength,
              },
              media_url: {
                @if(!$blog->id)
                    required: true,
                @endif
                filesize: profilePicSize,
                extension: profilePicMimes,
              },
              banner_url: {
                @if(!$blog->id)
                    required: true,
                @endif
                filesize: profilePicSize,
                extension: profilePicMimes,
              }

          }
          const messages = {
            title: {
                  required:  `{{ __('customvalidation.blog.title.required') }}`,
                  minlength: `{{ __('customvalidation.blog.title.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
                  maxlength: `{{ __('customvalidation.blog.title.max', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
              },
              description: {
                  required:  `{{ __('customvalidation.blog.description.required') }}`,
                  minlength: `{{ __('customvalidation.blog.description.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
              },
              short_content: {
                  required:  `{{ __('customvalidation.blog.short_content.required') }}`,
                  minlength: `{{ __('customvalidation.blog.short_content.min', ['min' => '${nameMinLength}', 'max' => '${nameMaxLength}']) }}`,
              },
              media_url: { 
                required:  `{{ __('customvalidation.blog.media_url.required') }}`,
                filesize: `{{ __('customvalidation.blog.media_url.size', ['min' =>'${profilePicSize}'])}}`,
                extension: `{{ __('customvalidation.blog.media_url.mimes', ['mime' => '${profilePicMimes}']) }}`,
              },
              banner_url: { 
                required:  `{{ __('customvalidation.blog.banner_url.required') }}`,
                filesize: `{{ __('customvalidation.blog.banner_url.size', ['min' =>'${profilePicSize}'])}}`,
                extension: `{{ __('customvalidation.blog.banner_url.mimes', ['mime' => '${profilePicMimes}']) }}`,
              },
          };

          handleValidation('blog', rules, messages);

          
      });
  </script>
