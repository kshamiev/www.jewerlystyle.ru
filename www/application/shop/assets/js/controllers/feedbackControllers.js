jewerlystyle.controller('FeedbackSendCtrl', ['$scope', 'Server', 'Messages', 'growlNotifications', 'Mistakes', function($scope, Server, Messages, growlNotifications, Mistakes) {
    $scope.EMAIL_REGEXP = /^[a-z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*$/i;
    $scope.showFeedbackForm = true;
    $scope.sendFeedback = function() {
        var dataForPost = { Message: { } };
        dataForPost.Message.Name = $scope.message.name;
        dataForPost.Message.Message = $scope.message.message;
        dataForPost.Message.Email = $scope.message.email;
        dataForPost.Message.Fio = $scope.message.fio;
        dataForPost.Message.Keystring = $scope.message.keystring;
        var operationResult = Server.POST("http://jewerlystyle.ru/api/feedback", dataForPost);
        operationResult.then(function(response) {
            var msg = Messages.getMsg(response);
            $scope.showFeedbackForm = false;
            Server.SubscribeEvent('hidingForm', msg);
        }, function(response) {
            growlNotifications.add(Messages.getMsg(response), 'danger', 5000);
            $scope.notifications = growlNotifications.notifications;
            Mistakes.displayMistakes(response.Data);
        });
    };
}]);

jewerlystyle.controller('HideFeedbackCtrl', ['$scope', 'Server', function($scope, Server) {
    $scope.hideForm = false;
    Server.Subscribe('hidingForm', function(evt) {
        $scope.msg = evt;
        $scope.hideForm = true;
    });
}]);
