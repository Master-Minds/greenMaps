;(function(){
        angular.module('GreenMaps', ['ui.router'])
            .config(function($stateProvider, $urlRouterProvider){
                $urlRouterProvider.otherwise("/");


                $stateProvider.state('main', {
                    url: "/",
                    templateUrl: url + "/app/templates/main.html",
                    controller: 'MainCtrl',
                    controllerAs: 'vm',
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