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
                zoom: 13,
                scrollwheel: false,
                styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
            });

        }

         function taskToDo(){
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': vm.location
            }, function (results, status) {
                if(status == google.maps.GeocoderStatus.OK) {
                    /*vm.adressess = results[0].formatted_address;
                    vm.la = results[0].geometry.location.lat();
                    vm.lo = results[0].geometry.location.lng();*/
                    console.log(results);
                }
            });
        }

        var inputChangedPromise;

        vm.eventOnChange = function(){
            if (inputChangedPromise) {
                $timeout.cancel(inputChangedPromise);
            }
            inputChangedPromise = $timeout(taskToDo, 300);
        };

        markers.all()
            .then(function(resposne){


                resposne.map(function(v, k){

                    setTimeout(function(){
                        var position = {
                            lat: +v.latitude,
                            lng: +v.langitude
                        };

                        markerss.push(new google.maps.Marker({
                            position: position,
                            // icon: url + '/images/' + v.image,
                            animation: google.maps.Animation.DROP,
                            map: vm.map,
                            content: v.description
                        }));
                    }, 50);

                });

            });

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