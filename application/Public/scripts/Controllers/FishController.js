/**
 * Created by Elin on 2014-04-18.
 */

goFish.controller('FishController', ['$scope', '$http', '$filter', function ($scope, $http) {

    $http.get('/fish').success(function (result) {
        $scope.fishCollection = result;
    });

    $http.get('/caughtfish').success(function (result) {
        $scope.caughtFishCollection = result;
    });
    $scope.addFish = function () {
        $http.post('/fish', $scope.fish).success(function (data) {
            alert('Sparat fisk!');
            $scope.fishCollection.push(data);
        }).error(function () {
            alert('Något gick snett.');
        });
    };

    $scope.deleteFish = function (fish) {
        var indexOfFish;

        $http.delete('fish/' + fish.id).success(function () {
            alert('Fisk borttagen.');
            indexOfFish = $scope.fishCollection.indexOf(fish);
            $scope.fishCollection.splice(indexOfFish, 1);

        }).error(function () {
            alert('Något gick snett.');
        });
    };

    $scope.createCaughtFish = function () {
        $http.post('/caughtfish', $scope.caughtFish).success(function () {
            alert('Lagt till fångst.');
            $scope.caughtFishCollection.push($scope.caughtFish);
        }).error(function () {
            alert('Något gick snett.');
        });
    }
}]);