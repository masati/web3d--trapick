$(function(){
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });


    $('.select2').select2( {
        width: '100%'
    });

    $('label.checkbox input').change(function(){
        if( this.checked )
            $(this).parent().addClass('on');
        else
            $(this).parent().removeClass('on');
    }).trigger('change');

    $(".slider").lightSlider({ gallery: true, item: 1})
});

$.fn.modal.Constructor.prototype.enforceFocus = function () {
    var $modalElement = this.$element;
    $(document).on('focusin.modal', function (e) {
        var $parent = $(e.target.parentNode);
        if ($modalElement[0] !== e.target && !$modalElement.has(e.target).length
            // add whatever conditions you need here:
            &&
            !$parent.hasClass('cke_dialog_ui_input_select') && !$parent.hasClass('cke_dialog_ui_input_text')) {
            $modalElement.focus()
        }
    })
};
