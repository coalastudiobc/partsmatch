<script>
    jQuery(document).ready(function() {
        jQuery('.toggle-password').click(function() {
            jQuery(this).find('i').removeClass('fa-eye fa-eye-slash');
            var element = jQuery(this).siblings('input');
            var attr = element.attr("type") == "text" ? "password" : "text";
            var className = (attr == 'password') ? 'fa-eye' : 'fa-eye-slash';
            jQuery(this).find('i').addClass(className);
            jQuery(element).attr("type", attr);
        });

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
