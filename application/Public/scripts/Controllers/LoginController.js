/**
 * Created by Elin on 2014-06-17.
 */
goFish.controller("LoginController", ['$scope', '$resource', function ($scope, $resource) {
    var LoginResource = new $resource('login');

    $scope.attemptLogin = function(){
        var loginResource = new LoginResource($scope.login);
        loginResource.$save({}, function(){
            alert('Du är inloggad!');
        }, function(){
            alert('Det där gick inte bra!');
        });
    };
}]);