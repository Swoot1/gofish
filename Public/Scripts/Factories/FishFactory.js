/**
 * Created by Elin on 2014-07-10.
 */
goFish.factory('Fish', ['$resource', function ($resource) {
    return $resource('/fish/:id');
}]);

