/**
 * Created by Elin on 2014-07-11.
 */
goFish.factory('Authorization', ['$resource', function($resource){
    return $resource('authorization/:action');
}]);
