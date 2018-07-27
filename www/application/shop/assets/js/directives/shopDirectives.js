'use strict'

jewerlystyle.directive('startslider', function() {
    return {
        restrict: 'A',
        link: function(scope, elm, attrs) {
            elm.ready(function() {
                $("." + $(elm[0]).attr('class')).bxSlider({
                    mode: 'horizontal',
                    autoControls: false,
                    pager: false,
                    infiniteLoop: false,
                    hideControlOnEnd: true,
                    slideWidth: 100,
                    slideHeight: 100,
                    minSlides: 2,
                    maxSlides: 6,
                    moveSlides: 1,
                    slideMargin: 5
                });
            });
        }
    };
});
