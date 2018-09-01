jQuery(document).ready(function() {
    jQuery('.navbar-toggler').click(function () {
        //jQuery('#exCollapsingNavbar').toggleClass('collapsed', 1000, 'swing');
        if (jQuery('#exCollapsingNavbar').hasClass('collapsed')) {
            // expand the bar
            jQuery('#exCollapsingNavbar').height(jQuery('#exCollapsingNavbar').find('.navbar-nav').height());
            jQuery('#exCollapsingNavbar').removeClass('collapsed');
        } else {
            // collpse the bar
            jQuery('#exCollapsingNavbar').height('0px');
            jQuery('#exCollapsingNavbar').addClass('collapsed');
        }
    });
});
