angular.module('RecipeManager')
    .controller('MainController', [
        '$scope', '$location',
        function($scope, $location) {
            var ctrl = this;
            ctrl.location = $location.path();
        }
    ]);