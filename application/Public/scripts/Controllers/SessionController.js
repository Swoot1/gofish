/**
 * Created by Elin on 2014-06-17.
 */
goFish.controller("SessionController", ['$scope', '$resource', '$location', function ($scope, $resource, $location) {
    var SessionResource = new $resource('session/:id');
    var sessionResource;

    $scope.attemptLogin = function () {
        sessionResource = new SessionResource($scope.login);
        sessionResource.$save({}, function (data) {
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
        sessionResource = new SessionResource(); // Change routes so that id is not necessary.
        sessionResource.$delete({id: 1});
    }
}]);