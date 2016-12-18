angular.module('RecipeManager')
    .controller('LoginController', [
        'api',
        function(api) {
            var ctrl = this;
            ctrl.login = function() {
                    api().fetch({"action":"signin","user_name":"shan","user_pass":"12345"}).$promise.then(function(response){
                    ctrl.response = response;
                },function(response){
                    ctrl.response = {
                        status: 'Failed',
                        error: {
                            err_code: response.status,
                            err_desc: response.statusText
                        }
                    };
                });
            };
        }
    ]);