;(function(){
        angular.module('GreenMaps', ['ui.router', 'uiGmapgoogle-maps', 'ngMap'])
            .config(function($stateProvider, $urlRouterProvider){
                $urlRouterProvider.otherwise("/");

                $stateProvider.state('main', {
                    url: "/",
                    templateUrl: url + "/app/templates/main.html",
                    controller: 'MainCtrl',
                    params: {
                        obj: null
                    },
                })
                    .state('about', {
                        url: "/about",
                        templateUrl: url + "/app/templates/about.html",
                        controller: 'AboutCtrl',
                        controllerAs: 'vm',
                    })
            });
}());