angular.module("RecipeManager")
    .config(function($routeProvider){
        $routeProvider.when('/login', {
            templateUrl: './templates/pages/login/index.html'
        }).when('/', {
            templateUrl: './templates/pages/login/index.html'
        }).otherwise({
            redirectTo: '/'
        });
    });