(function($) {
    // add support for csrf header
    jQuery.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    // init bootstrap, we'll do this after any ajax requests too, so tooltips etc work
    initBS();
    $( document ).ajaxSuccess(function( event, request, settings ) {
        initBS();
    });

    // close the popovers when you click outside the popover
    $(':not(#anything)').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('[data-toggle="popover"]').has(e.target).length === 0) {
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
})(window.jQuery);

function initBS(){
    //jQuery('[type="checkbox"]').each(function () { jQuery(this).checkbox(); });
    //jQuery('[type="radio"]').each(function () { jQuery(this).radio(); });

    if( jQuery('[data-toggle="tooltip"]').length ){
        jQuery('[data-toggle="tooltip"]').tooltip();
    }
    if( jQuery('[data-toggle="popover"]').length ){
        jQuery('[data-toggle="popover"]').popover({
            html: true,
            trigger: 'hover'
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
