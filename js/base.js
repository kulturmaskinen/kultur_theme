+function ($) {

    $(document).ready(function ($) {
        $('.pane-page-content').css("height", $(document).height() - 260);

        checkSize();
// run test on resize of the window
        $(window).resize(checkSize);

    });

    function checkSize() {

        if ($(window).width() < 768) {

            $('.panels-flexible-region-node_view-center').prependTo($('.panels-flexible-region-node_view-left').parent());

        } else {

            $('.panels-flexible-region-node_view-left').prependTo($('.panels-flexible-region-node_view-center').parent());

        }
    }

}(jQuery);