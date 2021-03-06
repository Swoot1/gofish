/**
 * Created by Elin on 2014-06-17.
 */
goFish.controller("AuthorizationController", ['$scope', '$location', 'Authorization', function ($scope, $location, Authorization) {
    var authorizationResource;

    $scope.attemptLogin = function () {
        authorizationResource = new Authorization($scope.login);
        authorizationResource.$save({action:'login'}, function (data) {
            if (data.isLoggedIn) {
                $location.path('/fish/new');
            } else {
                alert('Misslyckad inloggning!');
            }
        }, function () {
            alert('Det där gick inte bra!');
        });
    };

    $scope.attemptLogOut = function () {
        authorizationResource = new Authorization();
        authorizationResource.$get({action:'logout'}, function () {
            alert('Utloggad!');
        }, function () {
            alert('Det där gick inte bra!');
        });
    }
}]);