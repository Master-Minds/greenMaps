;(function(){
        angular.module('GreenMaps')
            .controller('MainCtrl', MainCtrl)
 MainCtrl.$inject = ['markers', '$timeout'];
        function MainCtrl(markers, $timeout){

            var vm = this;

        vm.map;
        var markerss = [];
        var infowindow;

        initMap();
        function initMap() {
            vm.map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 43.210237, lng: 23.552880},
                zoom: 10,
                scrollwheel: false,
                styles: [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]
            });

        }

         function taskToDo(){

            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': vm.location
            }, function (results, status) {
                console.log(results[0].geometry.location.lat());
                console.log( results[0].geometry.location.lng());

                if(status == google.maps.GeocoderStatus.OK) {
                    setMapOnAll(null);
                    var position = {
                        la: results[0].geometry.location.lat(),
                        lo: results[0].geometry.location.lng()
                    }
                    markers.findSpec(position)
                        .then(function(markers){
                           if(markers.success){
                               if(markers.success.constructor == Array){

                                   markers.success.map(function(v, k){

                                       addMarker({
                                           lat: +v.latitude,
                                           lng: +v.langitude
                                       });
                                   });


                               }

                           }
                        });

                }
            });
        }

        var inputChangedPromise;

        vm.eventOnChange = function(){
            setMapOnAll(null);
            if (inputChangedPromise) {
                $timeout.cancel(inputChangedPromise);
            }
            inputChangedPromise = $timeout(taskToDo, 300);
        };

            function setMapOnAll(map) {
                for (var i = 0; i < markerss.length; i++) {
                    markerss[i].setMap(map);
                }
            }

        function resetMarkers(){

        }

        function addMarker(location) {
            var marker = new google.maps.Marker({
                position: location,
                animation: google.maps.Animation.DROP,
                map: vm.map,
                content: "sdds"
            });
            marker.addListener('click', function() {
                infowindow.open(vm.map, marker);
            });
            markerss.push(marker);
        }

        vm.newClick = function(){
            // markerss = [];


            setTimeout(function(){
                addMarker({lat: 42.3102,lng: 22.65});
            }, 50);


        }
        };
}());