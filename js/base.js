+function ($) {

    $(document).ready(function ($) {
      $( "div ul" ).not( ".menu-level-1 ul" ).removeClass('dropdown-menu');
        checkSize();
// run test on resize of the window
        $(window).resize(checkSize);

    });

    function checkSize() {
        
        $('.pane-page-content').css("height", $(document).height() - 270);
        
        if ($(window).width() < 768) {

            if ($(window).width() < 768) {

        $('.col-md-3.col-xs-12.col-sm-height.col-md-height.col-xs-height.col-full-height.col-top').prependTo($('.col-xs-12.col-sm-6.col-md-8.col-xs-height.col-full-height').parent());
                } else {

        $('.col-xs-12.col-sm-6.col-md-8.col-xs-height.col-full-height').prependTo($('.col-md-3.col-xs-12.col-sm-height.col-md-height.col-xs-height.col-full-height.col-top').parent());
                }

        $('.panels-flexible-region-node_view-center').prependTo($('.panels-flexible-region-node_view-left').parent());
                } else {

$('.panels-flexible-region-node_view-left').prependTo($('.panels-flexible-region-node_view-center').parent());
        }
    }

}(jQuery);