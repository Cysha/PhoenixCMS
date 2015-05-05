$(function() {
    //$('#side-menu').metisMenu();
});

//Collapses the sidebar on window resize
$(function() {

    $(window).bind("resize", function() {
        if ($(this).width() < 768) {
            $('div.sidebar-collapse').addClass('collapse');
        } else {
            $('div.sidebar-collapse').removeClass('collapse');
        }
    });
});
