angular.module('RecipeManager')
    .factory('api', [
        '$resource',
        function($resource) {
            return function(authKey) {
                return $resource('./api/index.php',
                {},
                {
                    fetch: {
                        method: 'POST',
                        headers: authKey || {}
                    }
                });
            };
        }
    ]);