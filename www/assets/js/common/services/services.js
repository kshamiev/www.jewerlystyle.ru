'use strict';
jewerlystyle.service('Server', ['$http', '$q', function ($http, $q) {

    // Подписка на каналы для передачи данных между контроллерами
    var subscribe = [];
    this.Subscribe = function (channel, func) {
        if (false == subscribe.hasOwnProperty(channel)) {
            subscribe[channel] = [];
        }
        subscribe[channel].push(func);
    };
    this.SubscribeEvent = function () {
        if ( 0 == arguments.length || false == subscribe.hasOwnProperty(arguments[0])) {
            // TODO здесь нужно дописать обработчик ошибок
        }
        for (var i in subscribe[arguments[0]]) {
            switch (arguments.length) {
                case 1:
                    subscribe[arguments[0]][i]();
                    break;
                case 2:
                    subscribe[arguments[0]][i](arguments[1]);
                    break;
                case 3:
                    subscribe[arguments[0]][i](arguments[1], arguments[2]);
                    break;
                case 4:
                    subscribe[arguments[0]][i](arguments[1], arguments[2], arguments[3]);
                    break;
                case 5:
                    subscribe[arguments[0]][i](arguments[1], arguments[2], arguments[3], arguments[4]);
                    break;
                case 6:
                    subscribe[arguments[0]][i](arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
                    break;
                default:
                // TODO здесь нужно дописать обработчик ошибок
            }
        }
    };

    // Хранение данных для доступа из разных контроллеров
    var data = [];
    this.SetData = function (index, value) {
        data[index] = value;
    };
    this.GetData = function (index) {
        return data[index];
    };
    this.RemData = function (index) {
        delete data[index];
    };

    this.SliceToMap = function (slice) {
        var map = {};
        var id = 0; // вдальнейшем оставить лишь одни Id
        for (var i in slice) {
            if (slice[i].hasOwnProperty('Id')) {
                id = slice[i].Id;
            } else {
                id++;
            }
            map[id] = slice[i];
        }
        return map;
    };

    // Реализация общения с сервером. Запрос и посылка данных. (Сервеной частью приложения).
    // GET, POST, PUT, DELETE, HEAD, OPTIONS, PATCH, TRACE, LINK, UNLINK, CONNECT
    this.QUERY = function (url, method, data) {
        if (undefined == data)
            data = {};
        var Deferred = $q.defer();
        $http({method: method, url: url, data: data})
            .success(function (data, status, headers, config) {
                if (status == 403) {
                    alert('Доступ чтения запрещён');
                } else if (0 < data.error) {
                    console.log(data.errorMessage);
                }
                Deferred.resolve(data);
            })
            .error(function (data, status, headers, config) {
                if (status == 403) {
                    alert('Доступ чтения запрещён');
                } else {
                    console.log('Error http get:', data);
                }
                Deferred.reject(data);
            });
        return Deferred.promise;
    };

    this.GET = function (url) {
        return this.QUERY(url, 'GET', {});
    };
    this.POST = function (url, data) {
        return this.QUERY(url, 'POST', data);
    };
    this.PUT = function (url, data) {
        return this.QUERY(url, 'PUT', data);
    };
    this.DELETE = function (url) {
        return this.QUERY(url, 'DELETE', {});
    };

    //
}]);

jewerlystyle.service('Messages', [function() {
    this.getMsg = function (obj) {
        return obj.Message
    };
}]);

jewerlystyle.service('Mistakes', ['$timeout', function($timeout) {
    this.displayMistakes = function (obj) {
        for (var i in obj) {
            if (typeof obj[i] !== 'function') {
                angular.element('#'+i).text(obj[i][1]);
            }
        }
        $timeout(function () {
            for (var i in obj) {
                if (typeof obj[i] !== 'function') {
                    angular.element('#'+i).text("");
                }
            }
        },10000);
    };
}]);

jewerlystyle.service('SessionService', function() {
    this.sItem = function(key, value) {
       sessionStorage.setItem(key, value);
    };
    this.rItem = function(key) {
       sessionStorage.removeItem(key);
    };
    this.gItem = function(key) {
        return sessionStorage.getItem(key);
    };
});
