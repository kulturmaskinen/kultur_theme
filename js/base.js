+function ($) {


$(document).ready(function($) {
        $('.panels-flexible-region-container-fluid-center-inside').css("height", $(document).height() - 270);
    
        });


    $(window).on("resize", function () {

        if ($(window).width() < 768) {
            $('.panels-flexible-region-node_view-center').prependTo($('.panels-flexible-region-node_view-left').parent());
        }
        else {

            $('.panels-flexible-region-node_view-left').prependTo($('.panels-flexible-region-node_view-center').parent());

        }

    }).resize();

}(jQuery);