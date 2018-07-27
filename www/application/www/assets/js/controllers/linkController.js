'use strict'

jewerlystyle.controller('ActiveLinksCtrl', ['$scope', function($scope) {
    var lnk = window.location.pathname.toString();
    var string = "a[href='"+lnk+"']";
    angular.element(string).parent().addClass("active");
}]);
