jQuery( document ).ready(function(){

    if( $('[data-toggle="tooltip"]').length ){
        $('[data-toggle="tooltip"]').tooltip();
    }
    if( $('[data-toggle="popover"]').length ){
        $('[data-toggle="popover"]').popover({ html: true });
    }

    // close the popovers when you click outside the popover
    $(':not(#anything)').on('click', function (e) {
        $('.popover-link').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
                return;
            }
        });
    });

    /**
     * @code example:
     *
     *  __selector('html.ReportsController.create', function(element) {
     *      // this is only ran when <html class="ReportsController create"> exists
     *      // and element will be the html element (that we passed in above)
     *  });
    **/
    window.__selector = function(selector, closure) {
        jQuery(document).ready(function() {
            if (jQuery(selector).length && typeof closure !== 'undefined') {
                closure(jQuery(selector));
            }
        });
    };



});
