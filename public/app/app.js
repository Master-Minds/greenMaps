;(function(){
        angular.module('GreenMaps', ['ui.router'])
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
                    .state('new', {
                        url: "/new",
                        templateUrl: url + "/app/templates/main.html",
                        controller: 'MainCtrl',
                    })
            });
}());