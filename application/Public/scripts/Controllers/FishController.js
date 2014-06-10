/**
 * Created by Elin on 2014-04-18.
 */

goFish.controller('FishController', ['$scope', '$filter', '$resource', function ($scope, $filter, $resource) {

    var FishResource = $resource('/fish/:id');
    var CaughtFishResource = $resource('/caughtfish');

    $scope.fishCollection = FishResource.query();
    $scope.caughtFishCollection = CaughtFishResource.query();

    $scope.addFish = function () {
        var newFish = new FishResource($scope.fish);

        newFish.$save({}, function (data) {
            alert('Sparat fisk!');
            $scope.fishCollection.push(data);
        }, function () {
            alert('Något gick snett.');
        });
    };

    $scope.deleteFish = function (fish) {
        var indexOfFish;
        var fishResource = new FishResource(fish);
        fishResource.$delete({id: fish.id},
            function () {
                alert('Fisk borttagen.');
                indexOfFish = $scope.fishCollection.indexOf(fish);
                $scope.fishCollection.splice(indexOfFish, 1);
            },
            function () {
                alert('Något gick snett.');
            });
    };

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