/**
 * Created by Elin on 2014-05-26.
 */
angular.module('validators')
    .directive('oneToTen', function () {
        return {
            require: '?ngModel',
            link: function (scope, ele, attrs, ngModel) {
                if (!ngModel)return;

                ngModel.$parsers.unshift(
                    function (viewValue) {
                        var i = parseInt(viewValue);

                        if (i >= 0 && i <= 10) {
                            ngModel.$setValidity('oneToTen', true);
                            return viewValue;
                        } else {
                            ngModel.$setValidity('oneToTen', false);
                            return undefined;
                        }
                    }
                );
            }
        };
    });