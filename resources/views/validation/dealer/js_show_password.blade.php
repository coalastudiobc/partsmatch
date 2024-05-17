<script>
    jQuery(document).ready(function() {

        jQuery('.toggle-password').click(function() {
            iconEle = jQuery(this).children('svg:last').hasClass('d-none');
            if (iconEle) {
                jQuery(this).children('svg:first').addClass('d-none');
                jQuery(this).children('svg:last').removeClass('d-none');
            } else {
                jQuery(this).children('svg:first').removeClass('d-none');
                jQuery(this).children('svg:last').addClass('d-none');
            }
            var element = jQuery(this).siblings('input');
            var attr = element.attr("type") == "text" ? "password" : "text";
            var className = (attr == 'password') ? 'fa-eye' : 'fa-eye-slash';
            jQuery(element).attr("type", attr);
        });

    });
</script>
