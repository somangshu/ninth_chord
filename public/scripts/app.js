window.testing = true;
window.c = function(data) {
    if (testing) {
        console.log(data);
    }
};

window.greedygames = angular.module('greedygames', ['ngRoute', 'ngSanitize', 'ui.bootstrap', 'ngAnimate'])
    .config(['$routeProvider', '$locationProvider',
        function($routeProvider, $locationProvider) {
            $routeProvider
                .when('/', {
                    controller: 'TrackCtrl',
                    templateUrl: '/templates/musictracks.html',
                    reloadOnSearch: false
                })
                .when('/trackgenre', {
                    controller: 'GenreCtrl',
                    templateUrl: '/templates/editgenre.html',
                    reloadOnSearch: false
                })
                .otherwise({
                    redirectTo: '/'
                });

            // $locationProvider.html5Mode(true);
            $locationProvider.html5Mode({
                enabled: true,
                requireBase: false
            });
        }
    ]);
