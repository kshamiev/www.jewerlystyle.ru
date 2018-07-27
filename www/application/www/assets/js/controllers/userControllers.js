'use strict'

jewerlystyle.controller('LoginCtrl', ['$scope','$timeout', '$window','Server', 'Messages', 'growlNotifications', function($scope, $timeout, $window, Server, Messages, growlNotifications) {
    var dataForPut = {};
    $scope.submit = function() {
        dataForPut.Login = $scope.login;
        dataForPut.Password = $scope.password;
        dataForPut.Memory = $scope.memory;
        var promise = Server.PUT('http://jewerlystyle.ru/api/users/login', dataForPut);
        promise.then(function(response) {
           if (response.Code == 200) {
               $window.location.href = response.Data;
           }
        }, function(response) {
            growlNotifications.add(Messages.getMsg(response), 'danger',5000);
            $scope.notifications = growlNotifications.notifications;
        });
    };
}]);

jewerlystyle.controller('LogoutCtrl', ['$scope', '$window', '$timeout', 'Server', function($scope, $window, $timeout, Server) {
    var dataForPut = {};
    $scope.logout = function() {
        var promise = Server.PUT('http://jewerlystyle.ru/api/users/logout', dataForPut);
        promise.then(function(response) {
            $window.location.href = response.Data;
        }, function(response) {
            console.log("error data ", response);
        })
    };
}]);

jewerlystyle.controller('RegistrationCtrl', ['$scope', '$window', '$timeout', 'Server', 'Messages', 'growlNotifications', 'Mistakes', function($scope, $window, $timeout, Server, Messages, growlNotifications, Mistakes) {
    var dataForPost = { Users: {} };
    $scope.EMAIL_REGEXP = /^[a-z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*$/i;
    $scope.registration = function() {
        dataForPost.Users.Name = $scope.name;
        dataForPost.Users.Login = $scope.login;
        dataForPost.Users.Email = $scope.email;
        dataForPost.Users.Phone = $scope.phone;
        dataForPost.Users.Address = $scope.address;
        dataForPost.Users.Keystring = $scope.keystring;
        if ($scope.isnews) {
            dataForPost.Users.IsNews = 'yes';
        }
        else {
            dataForPost.Users.IsNews = 'no';
        }
        var promise = Server.POST('http://jewerlystyle.ru/api/users/registration', dataForPost);
        promise.then(function(response) {
            growlNotifications.add(Messages.getMsg(response), 'success');
            $scope.notifications = growlNotifications.notifications;
            $timeout(function() {
                $window.location.href = "http://jewerlystyle.ru/user/profile";
            }, 3000);
        }, function(response) {
            growlNotifications.add(Messages.getMsg(response), 'danger', 5000);
            $scope.notifications = growlNotifications.notifications;
            Mistakes.displayMistakes(response.Data);
        });
    };
}]);

jewerlystyle.controller('ProfileCtrl', ['$scope', '$window', '$timeout', 'Server', 'Messages', '$upload', 'growlNotifications', 'Mistakes', function($scope, $window, $timeout, Server, Messages, $upload, growlNotifications, Mistakes) {
    var dataForPut = { Users: {ImgAvatar: {}} };
    $scope.showAvatar = false;
    $scope.showProgress = false;
    $scope.isnews = false;
    $scope.EMAIL_REGEXP = /^[a-z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*$/i;
    $scope.PHONE_REGEXP = /^\d{10}$/;
    var profile = Server.GET('http://jewerlystyle.ru/api/users/current');
    profile.then(function(response) {
        $scope.name = response.Data.Users.Name;
        $scope.email = response.Data.Users.Email;
        $scope.phone = response.Data.Users.Phone;
        $scope.address = response.Data.Users.Address;
        if (response.Data.Users.ImgAvatar) {
            $scope.getImage = 'http://jewerlystyle.ru/upload/data/' + response.Data.Users.ImgAvatar;
            $scope.showAvatar = true;
        }
        if ( response.Data.Users.IsNews == 'yes' ) {
            $scope.isnews = true;
        }
    }, function(response) {
       console.log(response);
    });

    $scope.onFileSelect = function($files) {
        for (var i=0; i < $files.length; i++) {
            var file = $files[i];
            $scope.upload = $upload.upload({
                url: 'http://jewerlystyle.ru/api/system/upload',
                method: 'POST',
                data: {myModel: $scope.imgavatar},
                file: file,
                fileFormDataName: 'myFile'
            }).progress(function(event) {
                console.log('percent: '+ parseInt(100.0*event.loaded/event.total));
                $scope.showProgress = true;
                angular.element('.profile-progress-bar').replaceWith('<span class="profile-progress-bar"><div style="width: '+parseInt(100.0*event.loaded/event.total)+'%">'+parseInt(100.0*event.loaded/event.total)+'%</div></span>');
            }).success(function(response) {
                $scope.showAvatar = true;
                $scope.imgavatar = response.Data[0];
                $scope.getImage = 'http://jewerlystyle.ru'+response.Data[1]+'/'+response.Data[0]+'.'+response.Data[2];
                growlNotifications.add(Messages.getMsg(response), 'success');
                $scope.notifications = growlNotifications.notifications;
            });
        }
    };

    $scope.saveProfile = function() {
        dataForPut.Users.Name = $scope.name;
        dataForPut.Users.Email = $scope.email;
        dataForPut.Users.Phone = $scope.phone;
        dataForPut.Users.Address = $scope.address;
        dataForPut.Users.Password = $scope.password;
        dataForPut.Users.PasswordR = $scope.passwordR;
        if ($scope.imgavatar) {
            dataForPut.Users.ImgAvatar.Hash = $scope.imgavatar;
        }
        if ($scope.removeavatar) {
            $scope.showAvatar = false;
        }
        if ($scope.isnews) {
            dataForPut.Users.IsNews = 'yes';
        }
        else {
            dataForPut.Users.IsNews = 'no';
        }
        dataForPut.Users.ImgAvatar.Rem = $scope.removeavatar;
        var promise = Server.PUT('http://jewerlystyle.ru/api/users/profile', dataForPut);
        promise.then(function(response) {
            growlNotifications.add(Messages.getMsg(response), 'success');
            $scope.notifications = growlNotifications.notifications;
        }, function(response) {
            growlNotifications.add(Messages.getMsg(response), 'danger', 5000);
            $scope.notifications = growlNotifications.notifications;
            Mistakes.displayMistakes(response.Data);
        });
    };
}]);

jewerlystyle.controller('ReminderCtrl', ['$scope', '$window', '$timeout', 'Server', 'Messages', 'growlNotifications', 'Mistakes', function($scope, $window, $timeout, Server, Messages, growlNotifications, Mistakes) {
    var dataForPut = { Users: {}};
    $scope.EMAIL_REGEXP = /^[a-z0-9!#$%&'*+/=?^_`{|}~.-]+@[a-z0-9-]+(\.[a-z0-9-]+)*$/i;
    $scope.reminder = function() {
        dataForPut.Users.Email = $scope.email;
        dataForPut.Users.Keystring = $scope.keystring;
        var promise = Server.PUT('http://jewerlystyle.ru/api/users/reminder', dataForPut);
        promise.then(function(response) {
            growlNotifications.add(Messages.getMsg(response), 'success');
            $scope.notifications = growlNotifications.notifications;
        }, function(response) {
            growlNotifications.add(Messages.getMsg(response), 'danger', 5000);
            $scope.notifications = growlNotifications.notifications;
            Mistakes.displayMistakes(response.Data);
        });
    };
}]);

jewerlystyle.controller('ShowHideCtrl', ['$scope', '$window', '$timeout', function($scope, $window, $timeout) {
    $scope.forwardToRegistration = function() {
        $timeout(function() {
            $window.location.href = 'http://jewerlystyle.ru/user/registration';
        }, 500);
    };
    $scope.showHideReminder = false;
}]);
