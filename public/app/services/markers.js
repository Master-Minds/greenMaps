;(function(){
    angular.module('GreenMaps')
        .factory('markers', markers);

    markers.$inject = ['$http'];
    function markers($http){
        var service = {
            all: getAllMarkers
        };

        function getAllMarkers(){
            return $http({
                url: url + '/api/get-all-markers'
            }).then(function(response){
                return response.data;
            });
        }

        return service;
    }
}());