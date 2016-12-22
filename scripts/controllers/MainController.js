angular.module('RecipeManager')
    .controller('MainController', [
        '$scope', '$location',
        function($scope, $location) {
            var ctrl = this;

            ctrl.chkLocation = function() {
                return Array.prototype.slice.call(arguments).some(function(path){
                    return path === $location.path();
                });
            };

            ctrl.setLocation = function(loc) {
                $location.path(loc);
            };

        }
    ]);