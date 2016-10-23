;(function(){
	angular.module('DashboardGreenApp',  ['ui.router'])
	.config(function($stateProvider, $urlRouterProvider){
                $urlRouterProvider.otherwise("/");


                $stateProvider.state('dashboard', {
                    url: "/",
                    templateUrl: url + "/app/templates/dashboard.html",
                    controller: 'DashboardCtrl',
                    controllerAs: 'vm',
                    params: {
                        obj: null
                    },
                })
            });
}());