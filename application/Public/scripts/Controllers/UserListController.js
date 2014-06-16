/**
 * Created by Elin on 2014-06-16.
 */
goFish.controller("UserListController", ['$scope', '$resource', '$location', function ($scope, $resource, $location) {
    var UserResource = $resource('user/:id');
    $scope.userCollection = UserResource.query();

    $scope.editUser = function(user){
        $location.path('/user/' + user.id);
    };
}]);