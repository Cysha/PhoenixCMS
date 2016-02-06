(function($) {
    // add support for csrf header
    jQuery.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

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

    // init bootstrap, we'll do this after any ajax requests too, so tooltips etc work
    initBS();
    jQuery(document).ajaxSuccess(function(event, request, settings) {
        initBS();
    });

    // close the bs3 popovers when you click outside the popover
    jQuery(':not(#anything)').on('click', function (e) {
        jQuery('[data-toggle="popover"]').each(function () {
            if (!jQuery(this).is(e.target) && jQuery(this).has(e.target).length === 0 && jQuery('[data-toggle="popover"]').has(e.target).length === 0) {
                jQuery(this).popover('hide');
                return;
            }
        });
    });
})(window.jQuery);

function initBS(){
    //jQuery('[type="checkbox"]').each(function () { jQuery(this).checkbox(); });
    //jQuery('[type="radio"]').each(function () { jQuery(this).radio(); });

    if (jQuery('[data-toggle="tooltip"]').length) {
        jQuery('[data-toggle="tooltip"]').tooltip();
    }
    if (jQuery('[data-toggle="popover"]').length) {
        jQuery('[data-toggle="popover"]').popover({html: true, trigger: 'hover'});
    }

    // jquery-ujs handler
    if (jQuery('[data-method="delete"]').length) {
        var elements = jQuery('[data-method="delete"]');

        elements.bind('ajax:success', function(e, data, status, xhr){
            jQuery(e.target).closest('tr').remove();

            // refresh the datatable if its present
            if (typeof datatable != 'undefined') {
                datatable.ajax.reload();
            }
        });
    }

    if (jQuery('[data-datatable="refresh"]').length) {
        var elements = jQuery('[data-datatable="refresh"]');

        elements.bind('ajax:success', function(e, data, status, xhr){
            if (typeof datatable != 'undefined') {
                datatable.ajax.reload();
            }
        });
    }
}


function parseUri (str) {
    var o   = parseUri.options,
        m   = o.parser[o.strictMode ? "strict" : "loose"].exec(str),
        uri = {},
        i   = 14;

    while (i--) uri[o.key[i]] = m[i] || "";

    uri[o.q.name] = {};
    uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) {
        if ($1) uri[o.q.name][$1] = $2;
    });

    return uri;
}

parseUri.options = {
    strictMode: true,
    key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],
    q:   {
        name:   "queryKey",
        parser: /(?:^|&)([^&=]*)=?([^&]*)/g
    },
    parser: {
        strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
        loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
    }
};
