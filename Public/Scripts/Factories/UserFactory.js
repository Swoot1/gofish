/**
 * Created by Elin on 2014-07-10.
 */
goFish.factory('User', ['$resource', function ($resource) {
    return $resource('user/:id', {id: '@id'}, {update: {method: 'PUT'}});
}]);