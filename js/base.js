+function ($) {

    jQuery.fn.exists = function () {
        return this.length > 0;
    };
    $(document).ready(function ($) {

        //$('.dropdown-menu').equalize();
        if ($(window).width() >= 800) {
            $('.navbar-nav').equalize({children: '.dropdown-menu', equalize: 'height'});
        }

        if ($('iframe').exists()) {
            $('iframe').attr('style', 'position: absolute; left: 0px; top: 0px; width: 90%; height: 100%');
            $('iframe').parent().attr('style', 'position: relative; width: 100%; height: 0px; padding-bottom: 60%;');
        }

        add_event_badge_touch_events();
        $("div ul").not(".menu-level-1 ul").removeClass('dropdown-menu');
        checkSize();
        // run test on resize of the window
        $(window).resize(checkSize);
        /*
         * Remove month and week tabs for calendar on mobile.
         */
        if($('.calendar-calendar').length > 0)
        {
            var elems = $('.tabs--primary li').not(".active");
            elems.hide();
        }
        /*
         * Change links so mobile users cant get month and week 
         */
        $(".view-id-calendar .views-field-title a").attr('href','/calendar-node-field-dato/day');
        $(".view-id-calendar .views-field-field-br-dtekst a").attr('href','/calendar-node-field-dato/day');
    });
    
    function checkSize() {
        //$('.pane-page-content').css("height", $(document).height() - 270);

        if ($(window).width() < 768) {

            if ($(window).width() < 768) {
                
                $('.col-lg-2 .col-md-4 .col-sm-4 .col-xs-12 .col-sm-height .col-md-height .col-xs-height .col-full-height .col-top').prependTo($('.col-lg-5 .col-md-6 .col-sm-6 .col-xs-12 .col-xs-height .col-full-height').parent());
                $('h2').prependTo($('.col-lg-5 .col-md-6 .col-sm-6 .col-xs-12 .col-xs-height .col-full-height').parent());
            } else {

                $('.col-lg-5 .col-md-6 .col-sm-6 .col-xs-12 .col-xs-height .col-full-height').prependTo($('.col-lg-2 .col-md-4 .col-sm-4 .col-xs-12 .col-sm-height .col-md-height .col-xs-height .col-full-height .col-top').parent());
                $('.col-lg-2 .col-md-4 .col-sm-4 .col-xs-12 .col-sm-height .col-md-height .col-xs-height .col-full-height .col-top').prependTo($('h2').parent());
            }

            $('.panels-flexible-region-node_view-center').prependTo($('.panels-flexible-region-node_view-left').parent());
        } else {

            $('.panels-flexible-region-node_view-left').prependTo($('.panels-flexible-region-node_view-center').parent());
        }
    }
    
    Drupal.behaviors.resetSearch = {
        attach: function (context) {
            if ($('#search_input').exists() && $.fn.fastLiveFilter !== undefined) {
                $('#search_input').fastLiveFilter('.fastfilter');
            }
        }
    };
    function add_event_badge_touch_events()
    {
        debugger;
        if(!detectIE())
        {
            $('.view-arrangementer').on('tap','.ribbon',function(){
                var Title = $(this).attr('title');
                $('#badge-info-popup').find('.modal-body').html(Title);
                $('#badge-info-popup').modal('show');
            });
        }
        else
        {
             $('.view-arrangementer').on('click','.ribbon',function(){
                var Title = $(this).attr('title');
                $('#badge-info-popup').find('.modal-body').html(Title);
                $('#badge-info-popup').modal('show');
            });
        }

    }
    
      
    Drupal.behaviors.replaceLocation = {
        attach: function (context) {
            $('.views-field-field-location-name-line .field-content').each(function () {
                if ($(this).html().match("^Kulturmaskinen - Store sal ")) {
                    $(this).replaceWith('<a href="/rum-og-steder/store-sal">' + $(this).html() + '</a>');
                }
                else if ($(this).html().match("^Magasinet")) {
                    $(this).replaceWith('<a href="/rum-og-steder/magasinet">' + $(this).html() + '</a>');
                }
                else if ($(this).html().match("^Kulturmaskinen")) {
                    $(this).replaceWith('<a href="/rum-og-steder/mødelokaler">' + $(this).html() + '</a>');
                }
                else if ($(this).html().match("^Amfiscenen")) {
                    $(this).replaceWith('<a href="/rum-og-steder/amfiscenen">' + $(this).html() + '</a>');
                }
                else if ($(this).html().match("^Farvergården")) {
                    $(this).replaceWith('<a href="/rum-og-steder/farvergården">' + $(this).html() + '</a>');
                }
                else if ($(this).html().match("^Rosenbæk Huset")) {
                    $(this).replaceWith('<a href="/rum-og-steder/rosenbæk-huset">' + $(this).html() + '</a>');
                }
            });
        }
    };
/**
 * detect IE
 * returns version of IE or false, if browser is not Internet Explorer
 */
function detectIE() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
       // IE 12 => return version number
       return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    // other browser
    return false;
}
}(jQuery);