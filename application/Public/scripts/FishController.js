/**
 * Created by Elin on 2014-04-18.
 */

function FishController($scope){
    $scope.fishes = [{name: 'gadda'}];
    $scope.addFish = function(){
        $scope.fishes.push({name: $scope.fish.name});
    }
}