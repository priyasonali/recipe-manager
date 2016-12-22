angular.module("RecipeManager")
    .config(function($routeProvider){
        $routeProvider.when('/login', {
            templateUrl: './templates/pages/login/index.html'
        }).when('/register', {
            templateUrl: './templates/pages/register/index.html'
        }).when('/dashboard', {
            templateUrl: './templates/pages/dashboard/index.html'
        }).when('/recipes', {
            templateUrl: './templates/pages/recipes/index.html'
        }).when('/shoplist', {
            templateUrl: './templates/pages/shoplist/index.html'
        }).when('/profile', {
            templateUrl: './templates/pages/profile/index.html'
        }).when('/settings', {
            templateUrl: './templates/pages/settings/index.html'
        }).when('/', {
            templateUrl: './templates/pages/home/index.html'
        }).otherwise({
            redirectTo: '/'
        });
    });