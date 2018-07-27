'use strict'

jewerlystyle.controller('SliderCtrl', ['$scope', 'Server',  function($scope, Server) {
    $scope.showSliderModal = function() {
         Server.SubscribeEvent('changeSliderFlag', {});
    };
}]);


jewerlystyle.controller('ModalSliderCtrl', ['$scope', function($scope) {
    var slider = angular.element('#carousel .carousel-slider');
    var item = angular.element('#carousel .catousel-item');
    var total = item.length;
    var width = item.width();
    var index = 0;
    slider.width(total * width);
    function carouselSlide(index) {
        slider.stop().animate({left: -index * width+'px'});
    }

    $scope.prev = function() {
        index -= 1;
        carouselSlide( index = (index < 0) ? total - 1 : index );
    };

    $scope.next = function() {
        index += 1;
        carouselSlide( index = (index > total - 1) ? 0 : index );
    };
}]);
