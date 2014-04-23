jQuery(document).ready(function(){

    if( $('[data-toggle="tooltip"]').length ){
        $('[data-toggle="tooltip"]').tooltip();
    }
    if( $('[data-toggle="popover"]').length ){
        $('[data-toggle="popover"]').popover({ html: true });
    }

    if( jQuery('select[multiple]').length ){
        jQuery('select[multiple]').multiSelect();
    }

    if( jQuery('#attribute-set-order') ){
        jQuery("#attribute-set-order").tableDnD({
            onDrop: function(table, row) {
                jQuery('#order').val($.tableDnD.serialize());
            }
        });
    }

    $('#permissions [id^="select"]').click(function(e){
        // console.log(this);
        e.preventDefault();
        $(this).parents('div.col-md-12').find(':checkbox').attr('checked', 'checked');
    });

    $('#permissions [id^="deselect"]').click(function(e){
        // console.log(this);
        e.preventDefault();
        $(this).parents('div.col-md-12').find(':checkbox').removeAttr('checked', 'checked');
    });

    $('#permissions [id^="toggle"]').click(function(e){
        // console.log(this);
        e.preventDefault();
        var checkBoxes = $(this).parents('div.col-md-12').find(':checkbox');
        checkBoxes.each(function(){
            if (this.checked === true) {
                this.checked = false;
            }else{
                this.checked = true;
            }
        });
    });

});
