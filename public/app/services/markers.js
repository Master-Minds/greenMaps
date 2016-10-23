;(function(){
    angular.module('GreenMaps')
        .factory('markers', markers);

    markers.$inject = ['$http'];
    function markers($http){
        var service = {
            all: getAllMarkers,
            findSpec: findSpecific,
        };

        function getAllMarkers(){
            return $http({
                url: url + '/api/get-all-markers'
            }).then(function(response){
                return response.data;
            });
        }

        function findSpecific(posision) {
            return $http({
                url: url + '/api/find-marker',
                params: {
                    la: posision.la,
                    lo: posision.lo
                }
            }).then(function(response){
                return response.data[0];
            });
        }

        return service;
    }
}());