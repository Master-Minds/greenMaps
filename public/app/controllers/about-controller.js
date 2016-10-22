;(function(){
    angular.module('GreenMaps')
        .controller('AboutCtrl', AboutCtrl);
    AboutCtrl.$inject = ['NgMap'];
    function AboutCtrl(NgMap){
        var vm = this;
        vm.options = {
            scrollwheel: false,
            styles: [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
        };
        vm.map = {
            center: { latitude: 42.733883, longitude: 25.485830 }, zoom: 6,
        };
        vm.marker = {
            id: 50,
            test: "My test",
            coords: {
                latitude: 43.210237,
                longitude: 23.552880
            },
            options: {
                draggable: false,
                icon: url + 'images/skini-marker.png'
            },

            // events: {
            //     click: function (marker, eventName, args) {
            //
            //     }
            // }
        };

        vm.title = "Green Maps";
        vm.windowOptions = {
            visible: true
        };

        NgMap.getMap().then(function(map) {
            console.log(map.getCenter());
            console.log('markers', map.markers);
            console.log('shapes', map.shapes);
        });
    }
}());