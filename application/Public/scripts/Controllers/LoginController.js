/**
 * Created by Elin on 2014-06-17.
 */
goFish.controller("LoginController", ['$scope', '$resource', '$location', function ($scope, $resource, $location) {
    var LoginResource = new $resource('login');

    $scope.attemptLogin = function () {
        var loginResource = new LoginResource($scope.login);
        loginResource.$save({}, function (data) {
            if (data.isLoggedIn) {
                $location.path('/fish/new');
            } else {
                alert('Misslyckad inloggning!');
            }
        }, function () {
            alert('Det där gick inte bra!');
        });
    };
}]);