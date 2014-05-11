/**
 * Created by Elin on 2014-04-18.
 */

function FishController($scope, $http) {

    $http.get('/fishes').success(function (result) {
        $scope.fishes = result;
    });
    $scope.addFish = function () {
        $http.post('/fishes', $scope.fish).success(function (data) {
            alert('Sparat fisk!');
            $scope.fishes.push(data);
        }).error(function () {
            alert('Något gick snett.');
        });
    }

    $scope.deleteFish = function (fish) {
        var indexOfFish;

        $http.delete('fishes/' + fish.id).success(function () {
            alert('Fisk borttagen.');
            indexOfFish = $scope.fishes.indexOf(fish);
            $scope.fishes.splice(indexOfFish, 1);

        }).error(function () {
            alert('Något gick snett.');
        });
    }
}