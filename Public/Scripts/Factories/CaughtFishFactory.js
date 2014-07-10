/**
 * Created by Elin on 2014-07-10.
 */
goFish.factory('CaughtFish', ['$resource', function ($resource) {
    return $resource('/caughtfish/:id');
}]);