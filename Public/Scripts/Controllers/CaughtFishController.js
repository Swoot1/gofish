/**
 * Created by Elin on 2014-06-12.
 */
goFish.controller('CaughtFishController', ['$scope', '$resource', function ($scope, $resource) {
    var CaughtFishResource = $resource('/caughtfish');
    $scope.caughtFishCollection = CaughtFishResource.query();

    var FishResource = $resource('/fish/:id');
    $scope.fishCollection = FishResource.query();

    $scope.createCaughtFish = function () {
        var newCaughtFishResource = new CaughtFishResource($scope.caughtFish);
        newCaughtFishResource.$save({}, function () {
            alert('Lagt till fångst.');
            $scope.caughtFishCollection.push($scope.caughtFish);
        }, function () {
            alert('Något gick snett.');
        });
    };
}]);