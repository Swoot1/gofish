/**
 * Created by Elin on 2014-05-26.
 */
angular.module('filters', []).filter(
    'capitalize', function () {
        return function (input) {
            if (input) {
                return input[0].toUpperCase() + input.slice(1);
            }
        }
    }
);