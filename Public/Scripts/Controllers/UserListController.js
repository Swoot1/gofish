/**
 * Created by Elin on 2014-06-16.
 */
goFish.controller('UserListController', ['$scope', '$resource', '$location', 'User', function ($scope, $resource, $location, User) {
    $scope.userCollection = User.query();

    $scope.editUser = function(user){
        $location.path('/user/' + user.id);
    };
}]);