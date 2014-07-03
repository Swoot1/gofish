/**
 * Created by Elin on 2014-06-16.
 */
goFish.controller('UserController', ['$scope', '$resource', '$routeParams', '$location', function ($scope, $resource, $routeParams, $location) {
    var UserResource = $resource('user/:id');

    if($routeParams.id){
        $scope.user = UserResource.get({id : $routeParams.id});
    }

    $scope.createUser = function () {
        var newUserResource = new UserResource($scope.user);
        newUserResource.$save({}, function () {
            alert('Lagt till användare');
        }, function () {
            alert('Något gick snett.');
        });
    };

    $scope.updateUser = function(){
      var updateUserResource = new UserResource($scope.user);
       updateUserResource.$save({}, function(){
           alert('Uppdaterat användare');
       }, function(){
           alert('Något gick snett.');
       });
    };

    $scope.returnToUserList = function(){
        $location.path('/user');
    }
}]);
