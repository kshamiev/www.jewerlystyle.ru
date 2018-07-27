'use strict'
jewerlystyle.controller('ModalWindowsCtrl', ['$scope', 'Server', function($scope, Server) {
    $scope.showLoginFlag = false;
    $scope.modalShown = false;
    Server.Subscribe('changeLoginFlag', function() {
        $scope.showLoginFlag = !$scope.showLoginFlag;
    });
    Server.Subscribe('changeSliderFlag', function() {
        $scope.modalShown = !$scope.modalShown;
    });
}]);

jewerlystyle.controller('ModalLoginCtrl', ['$scope','$timeout', '$window','Server', 'Messages', 'growlNotifications', function($scope, $timeout, $window, Server, Messages, growlNotifications) {
    var dataForPut = {};
    $scope.submit = function() {
        dataForPut.Login = $scope.login;
        dataForPut.Password = $scope.password;
        dataForPut.Memory = $scope.memory;
        var promise = Server.PUT('http://jewerlystyle.ru/api/users/login', dataForPut);
        promise.then(function(response) {
            if (response.Code == 200) {
                Server.SubscribeEvent('saveProduct', {});
            }
        }, function(response) {
            Server.SubscribeEvent('showingMistake', Messages.getMsg(response));
        });
    };
}]);

jewerlystyle.controller('ShowMistakeCtrl', ['$scope', 'Server', '$timeout', function($scope, Server, $timeout) {
    $scope.showMistake = false;
    Server.Subscribe('showingMistake', function(evt) {
        $scope.msg = evt;
        $scope.showMistake = true;
        $timeout(function() {
            $scope.showMistake = !$scope.showMistake;
        },5000);
    });
}]);
