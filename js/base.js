+function ($) {

    jQuery.fn.exists = function () {
        return this.length > 0;
    };
                        $(window).load(function() {
               

        });
    
    $(document).ready(function ($) {
        //$('.dropdown-menu').equalize();
        
        $('.navbar-nav').equalize({children: '.dropdown-menu', equalize: 'height'});
 
        if ($('iframe').exists()) {
            $('iframe').attr('style', 'position: absolute; left: 0px; top: 0px; width: 100%; height: 100%');
            $('iframe').parent().attr('style', 'position: relative; width: 100%; height: 0px; padding-bottom: 60%;');
        }
        
      add_event_badge_touch_events();
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
           $('h2').prependTo($('.col-xs-12.col-sm-6.col-md-8.col-xs-height.col-full-height').parent());     
            } else {

        $('.col-xs-12.col-sm-6.col-md-8.col-xs-height.col-full-height').prependTo($('.col-md-3.col-xs-12.col-sm-height.col-md-height.col-xs-height.col-full-height.col-top').parent());
              $('.col-md-3.col-xs-12.col-sm-height.col-md-height.col-xs-height.col-full-height.col-top').prependTo($('h2').parent());  
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
        $('.ribbon').on('tap',function(){
            var Title = $(this).attr('title');
            $('#badge-info-popup').find('.modal-body').text(Title);
            $('#badge-info-popup').modal('show');
        });
    }

}(jQuery);