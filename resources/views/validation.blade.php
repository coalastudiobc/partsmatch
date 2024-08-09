<script>
    const usernameRegex = {{ config('validation.username_regex') }};

    //media
    const mediaSize = {{ config('validation.js_media_size') }};
    const mediaNameMaxLength = {{ config('validation.js_media_name_max_length') }};
    const mediaMimes = "{{ config('validation.js_media_mimes') }}";

    //name
    const nameRegex = {{ config('validation.name_regex') }};
    const nameMinLength = {{ config('validation.name_minlength') }};
    const nameMaxLength = {{ config('validation.name_maxlength') }};
    const firstNameRegex={{ config('validation.first_name_regex') }};
    const lastNameRegex={{ config('validation.last_name_regex') }};

    //email
    const emailRegex = {{ config('validation.email_regex') }};

    //part number regex
    const partNumberRegex = {{ config('validation.part_number_regex') }};

    //product price regex
    const productPriceRegex = {{ config('validation.product_price_regex') }};

    //product stock regex
    const productStockRegex = {{ config('validation.product_stock_regex') }};

    //Pincode
    const pincodeMinLength = {{ config('validation.pincode_minlength') }};
    const pincodeMaxLength = {{ config('validation.pincode_maxlength') }};

    //password
    const passwordRegex = {{ config('validation.password_regex') }};
    const passwordMinLength = parseInt(`${passwordRegex}`.match(/(?<={)\d+/)[0]);
    const passwordMaxLength = parseInt(`${passwordRegex}`.match(/\d+(?=})/)[0]);

    //profile
    const profilePicMimes = "{{ config('validation.js_profile_pic_mimes') }}";
    const profilePicSize = "{{ config('validation.js_profile_pic_size_user') }}";

    //certificate
    const certificateMimes = "{{ config('validation.js_certificate_mimes') }}";
    const certificateSize = "{{ config('validation.js_certificate_size') }}";

    //name
    const packageRegex = {{ config('validation.package_regex') }};
    const packageMinLength = parseInt(`${packageRegex}`.match(/(?<={)\d+/)[0]);
    const packageMaxLength = parseInt(`${packageRegex}`.match(/\d+(?=})/)[0]);

    const accountMinLength = {{ config('validation.account_minlength') }};
    const accountMaxLength = {{ config('validation.account_maxlength') }};

    const routingMinLength = {{ config('validation.routing_minlength') }};
    const routingMaxLength = {{ config('validation.routing_maxlength') }};

    const descriptionMaxLength = {{ config('validation.descriptionMaxLength') }};

    const pdfExtension = "{{ config('validation.pdf_extension') }}";
    const pdfMaxSize = {{ config('validation.pdf_max_size') }};
</script>
