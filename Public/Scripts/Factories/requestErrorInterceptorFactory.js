/**
 * Created by Elin on 2014-07-16.
 */
goFish.factory('requestErrorInterceptor', function () {
    var requestErrorInterceptor = {
        requestError: function (response) {
            requestErrorInterceptor.writeError(response);
            return response;
        },
        responseError: function (response) {
            requestErrorInterceptor.writeError(response);
            return response;
        },
        writeError: function (response) {
            var errorData = response && response.data ? response.data : false;

            if (errorData) {
                for (var propertyName in errorData) {
                    if (errorData.hasOwnProperty(propertyName)) {
                        console.log(propertyName + ': ' + errorData[propertyName] + '\n');
                    }
                }
            }
        }
    };

    return requestErrorInterceptor;
});