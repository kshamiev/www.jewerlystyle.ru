'use strict'

jewerlystyle.controller('ClearBasketCtrl', ['$scope', '$window', '$timeout', 'Server', function($scope, $window, $timeout, Server) {
    $scope.showLinks = true;
    var tag = angular.element('.not-found');
    if (tag.length !== 0) {
        $scope.showLinks = false;
    }
    $scope.clearBasket = function() {
        var clearBasket = Server.DELETE('http://jewerlystyle.ru/api/basket');
        clearBasket.then(function(response){
            if (response.Code == 200) {
                $timeout(function() {
                    $window.location.href = 'http://jewerlystyle.ru/basket'
                },500);
            }
        }, function(response) {
            console.log("someThingWentWrong", response)
        });
    };
}]);

jewerlystyle.controller('RemoveWaresCtrl', ['$scope', '$window', '$timeout', 'Server', function($scope, $window, $timeout, Server) {
    $scope.removeWares = function(waresId) {
        var url = 'http://jewerlystyle.ru/api/basket/'+waresId.toString();
        var removedWares = Server.DELETE(url);
        removedWares.then(function(response){
            if (response.Code == 200) {
                $timeout(function() {
                    $window.location.href = 'http://jewerlystyle.ru/basket'
                },500);
            }
        }, function(response) {
            console.log("someThingWentWrong", response)
        });
    };
}]);

jewerlystyle.controller('AddToBasketCtrl', ['$scope', '$window', '$timeout', 'Server', 'Messages', 'growlNotifications', '$cookieStore', function($scope, $window, $timeout, Server, Messages, growlNotifications, $cookieStore) {
    var path = $window.location.pathname;
    var waresId = path.match(/\d+/);
    var goods = Server.GET('http://jewerlystyle.ru/api/product/'+waresId);
    goods.then(function(response) {
        var array = $scope.goodsArray = response.Data;
        var flag = [];
        var packid, pack, goodsSum, goodsId;
        $scope.packs = [];
        for (var i = 0; i < array.length ; i++) {
            if ($scope.goodsArray[i].CntReserve == "0") {
                $scope.goodsArray[i].presence = "нет в наличии";
            } else {
                $scope.goodsArray[i].presence = "в наличии";
            }
            goodsSum = parseInt($scope.goodsArray[i].CntReserve) + parseInt($scope.goodsArray[i].CntBasket || 0);
            goodsId = parseInt($scope.goodsArray[i].Shop_Goods_ID);
            Server.SetData(goodsId+100, goodsSum);
            $scope.goodsArray[i].disabledButton = true;
            if (flag[array[i].Packing]) continue;
            flag[array[i].Packing] = true;
            pack = array[i].Packing;
            packid = parseInt(array[i].PackingID);
            $scope.packs.push({ name: pack, id: packid });
            Server.SetData(packid, pack);
        }
        $scope.currentPack = $scope.packs[0];
    }, function(response) {
        console.log(response);
    });

    $scope.getCurrent = function(currentPackId) {
        var curPosition = Server.GET('http://jewerlystyle.ru/api/product/'+waresId+'/'+currentPackId);
        curPosition.then(function(response) {
            var goodsId, goodsSum;
            var packId = Server.GetData(currentPackId);
            $scope.goodsArray = response.Data;
            for (var i = 0; i < $scope.goodsArray.length; i++) {
                $scope.goodsArray[i].Packing = packId;
                $scope.goodsArray[i].disabledButton = true;
                if ($scope.goodsArray[i].CntReserve == "0") {
                    $scope.goodsArray[i].presence = "нет в наличии";
                } else {
                    $scope.goodsArray[i].presence = "в наличии";
                }
                goodsSum = parseInt($scope.goodsArray[i].CntReserve) + parseInt($scope.goodsArray[i].CntBasket || 0);
                goodsId = parseInt($scope.goodsArray[i].Shop_Goods_ID);
                Server.SetData(goodsId+100, goodsSum);
            }
        }, function(response) {
            console.log("error");
        });
    };

    $scope.saveToBasket = function(goodsInBasket, goodsId, event) {
        var curUser = Server.GET('http://jewerlystyle.ru/api/users/current');
        curUser.then(function(response) {
            if (response.Data.Users.Login == 'guest') {
                Server.SubscribeEvent('changeLoginFlag', {});
                Server.Subscribe('saveProduct', function() {
                    var dataForPut = {};
                    dataForPut.Shop_Goods_ID = goodsId;
                    dataForPut.Cnt = goodsInBasket;
                    var operationResult = Server.PUT("http://jewerlystyle.ru/api/basket", dataForPut);
                    operationResult.then(function (response) {
                        Server.SubscribeEvent('changeLoginFlag', {});
                        growlNotifications.add(Messages.getMsg(response), 'success');
                        $scope.notifications = growlNotifications.notifications;
                        Server.SubscribeEvent('addToCart', {});
                    }, function (response) {
                        console.log('error', response);
                    });
                });
            } else {
                var dataForPut = {};
                dataForPut.Shop_Goods_ID = goodsId;
                dataForPut.Cnt = goodsInBasket;
                var operationResult = Server.PUT("http://jewerlystyle.ru/api/basket", dataForPut);
                operationResult.then(function (response) {
                    event.target.value = "Добавлен";
                    angular.element(event.target).css('background', 'green');
                    $timeout(function () {
                        event.target.value = "Добавить";
                        angular.element(event.target).css('background', 'linear-gradient(to top, rgb(175, 154, 125), rgb(208, 189, 164))');
                    }, 2000);
                    Server.SubscribeEvent('addToCart', {});
                }, function (response) {
                    growlNotifications.add(Messages.getMsg(response), 'danger', 5000);
                    $scope.notifications = growlNotifications.notifications;
                });
            }
        }, function(status) {
            console.log("someThingWentWrong", status);
        });
    };
    $scope.changeCntReserve = function(obj) {
        var controlSum, goodsId;
        goodsId = parseInt(obj.Shop_Goods_ID);
        controlSum = Server.GetData(goodsId+100);
        obj.disabledButton = false;
        if (obj.CntBasket == null || obj.CntBasket == undefined || obj.CntBasket == '' || obj.CntBasket == '0') {
            obj.disabledButton = true;
        }
        if (obj.CntBasket > controlSum) {
            obj.disabledButton = true;
            obj.presence = "нет в наличии";
        } else {
            obj.presence = "в наличии";
        }
    };
}]);

jewerlystyle.controller('CreateOrderCtrl', ['$scope', '$window', '$timeout', 'Server', 'Messages', 'growlNotifications', function($scope, $window, $timeout, Server, Messages, growlNotifications) {
    $scope.showOrderForm = true;
    $scope.createOrder = function() {
        var dataForPost = {};
        dataForPost.Address = $scope.address;
        dataForPost.Comment = $scope.comment;
        var operationResult = Server.POST("http://jewerlystyle.ru/api/orders", dataForPost);
        operationResult.then(function(response) {
            var msg = Messages.getMsg(response);
            $scope.showOrderForm = false;
            Server.SubscribeEvent('createNewOrder', {});
            Server.SubscribeEvent('showingStub', msg);
        }, function(response) {
            growlNotifications.add(Messages.getMsg(response), 'danger', 5000);
            $scope.notifications = growlNotifications.notifications;
        });
    };
}]);

jewerlystyle.controller('BasketShortCtrl', ['$scope', 'Server', function($scope, Server) {
    var result = Server.GET('http://jewerlystyle.ru/api/basket/sum');
    $scope.basketCnt = 0;
    $scope.basketSumma = 0;
    result.then(function(response) {
        $scope.basketCnt = response.Data.Cnt;
        $scope.basketSumma = response.Data.Summa;
    }, function(response) {
        console.log(response);
    });
    Server.Subscribe('addToCart',
        function () {
            var result = Server.GET('http://jewerlystyle.ru/api/basket/sum');
            result.then(function(response) {
                $scope.basketCnt = response.Data.Cnt;
                $scope.basketSumma = response.Data.Summa;
            }, function(response) {
                console.log(response);
            });
        }
    );
    Server.Subscribe('createNewOrder',
        function () {
            $scope.basketCnt = 0;
            $scope.basketSumma = 0;
        }
    );
}]);

jewerlystyle.controller('ShowStubCtrl', ['$scope', 'Server', function($scope, Server) {
    $scope.showStub = false;
    Server.Subscribe('showingStub', function(evt) {
       $scope.msg = evt;
       $scope.showStub = true;
    });
}]);

