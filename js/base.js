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

            $('.panels-flexible-region-node_view-center').prependTo($('.panels-flexible-region-node_view-left').parent());

        } else {

            $('.panels-flexible-region-node_view-left').prependTo($('.panels-flexible-region-node_view-center').parent());

        }
    }

}(jQuery);