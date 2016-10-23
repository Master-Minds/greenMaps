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
            console.log(window.innerHeight);
            document.getElementById('map').style.height = window.innerHeight;
            vm.map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 43.210237, lng: 23.552880},
                zoom: 10,
                scrollwheel: false,
                styles: [{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]}]
            });

        }

        jQuery('body').on('focus', '.search-main-input input', function(){
            jQuery('.search-main-input').animate({
                    top: 105,
                    opacity: 1,
                    left: '200px',
                    width: '560px'
                }, 500, function(){

                });
        })
        

         function taskToDo(){
            jQuery('.search-main-input').animate({
                    top: 105,
                    opacity: 1,
                    left: '200px',
                    width: '560px'
                }, 500, function(){

                });
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'address': vm.location
            }, function (results, status) {
                
                if(status == google.maps.GeocoderStatus.OK) {
                    setMapOnAll(null);
                    var position = {
                        la: results[0].geometry.location.lat(),
                        lo: +results[0].geometry.location.lng()
                    }
                    vm.map.panTo({
                        lat: results[0].geometry.location.lat(),
                        lng: results[0].geometry.location.lng()
                    });
                    markers.findSpec(position)
                        .then(function(markers){
                           if(markers.success){
                               if(markers.success.constructor == Array){
                                   jQuery('.search-main-input').animate({
                                        top: -115,
                                        opacity: 0.5,
                                        left: '230px',
                                        width: '405px'
                                    }, 500, function(){

                                    }); 
                                   markers.success.map(function(v, k){

                                       addMarker({
                                           lat: +v.latitude,
                                           lng: +v.langitude
                                       }, v.description, v.title);
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

        function addMarker(location, description, title) {
            var marker = new google.maps.Marker({
                position: location,
                animation: google.maps.Animation.DROP,
                map: vm.map,
                content: "sdds"
            });

            var infowindow = new google.maps.InfoWindow({
                content: '<div id="iw-container">' +
                    '<div class="iw-title">'+ title +'</div>' +
                    '<div class="iw-content">' +
                      '<div class="iw-subTitle"></div>' +
                      '<div class="iw-subTitle"></div>' +
                      '<p>'+ description +'<br>'+
                    '</div>' +
                    '<div class="iw-bottom-gradient"></div>' +
                  '</div>',

                // Assign a maximum value for the width of the infowindow allows
                // greater control over the various content elements
                maxWidth: window.innerWidth
              });
            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(vm.map, marker);

                jQuery('.search-main-input').animate({
                    top: -115,
                    opacity: 0.5,
                    left: '230px',
                    width: '405px'
                }, 500, function(){

                }); 
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