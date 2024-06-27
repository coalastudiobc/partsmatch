<script>
    jQuery(document).ready(function() {

        jQuery(document).on('click', '.eye-icon', function() {
            $type = jQuery(this).parent().find('input[name="password"]').attr('type');
            if ($type == 'password') {
                jQuery(document).find('#eye-cross-icon').removeClass('d-none');
                jQuery(document).find('.eye-icon').addClass('d-none');
                jQuery(this).parent().find('input[name="password"]').attr('type', 'text');
            } else {
                jQuery(document).find('.eye-icon').addClass('d-none');
                jQuery(document).find('#eye-cross-icon').removeClass('d-none');
                jQuery(this).parent().find('input[name="password"]').attr('type', 'password');
            }

        })

        jQuery(document).on('click', '#eye-cross-icon', function() {
            $type = jQuery(this).parent().find('input[name="password"]').attr('type');
            if ($type == 'password') {
                jQuery(document).find('#eye-cross-icon').addClass('d-none');
                jQuery(document).find('.eye-icon').removeClass('d-none');
                jQuery(this).parent().find('input[name="password"]').attr('type', 'text');
            } else {
                jQuery(document).find('.eye-icon').removeClass('d-none');
                jQuery(document).find('#eye-cross-icon').addClass('d-none');
                jQuery(this).parent().find('input[name="password"]').attr('type', 'password');
            }

        })
    });
</script>
