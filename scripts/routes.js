angular.module("RecipeManager")
    .config(function($routeProvider){
        $routeProvider.when('/login', {
            templateUrl: './templates/pages/login/index.html'
        }).when('/register', {
            templateUrl: './templates/pages/register/index.html'
        }).when('/dashboard', {
            templateUrl: './templates/pages/dashboard/index.html'
        }).when('/', {
            templateUrl: './templates/pages/home/index.html'
        }).otherwise({
            redirectTo: '/'
        });
    });