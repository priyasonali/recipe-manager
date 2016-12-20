angular.module('RecipeManager')
    .controller('HomeController', [
        '$scope', '$location',
        function($scope, $location) {
            var ctrl = this;

            ctrl.login = function() {
                if(sessionStorage.getItem("authToken")) {
                    $location.path('/dashboard');
                } else {
                    $scope.mainCtrl.location = '/login';
                    $location.path('/login');
                }
            };

            ctrl.register = function() {
                if(sessionStorage.getItem("authToken")) {
                    if(ctrl.registerChk) {
                        sessionStorage.removeItem("authToken");
                        $location.path('/register');
                    }
                    ctrl.registerChk = true;
                } else {
                    $location.path('/register');
                }
                
            };
        }
    ]);