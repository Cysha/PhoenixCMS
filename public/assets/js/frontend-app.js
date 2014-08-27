jQuery( document ).ready(function(){
    jQuery('[data-toggle="tooltip"]').each(function() { jQuery(this).tooltip(); });
    jQuery('[data-toggle="popover"]').each(function() { jQuery(this).popover(); });

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