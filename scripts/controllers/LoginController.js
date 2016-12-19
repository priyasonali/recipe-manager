angular.module('RecipeManager')
    .controller('LoginController', [
        '$scope', 'api',
        function($scope, api) {
            var ctrl = this;

            ctrl.uNameRegX = /^[a-z]+$/;
            ctrl.uPassRegX = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!=@#$%^&*_.-])[A-Za-z\d!=@#$%^&*_.-]+$/;
            ctrl.errorChk = function(element, error){
                var form = $scope.loginForm;
                var formElement = $scope.loginForm[element];
                if(arguments.length === 1) {
                    return (formElement.$touched || form.$submitted) && formElement.$invalid;
                } else {
                    return (formElement.$touched || form.$submitted) && formElement.$error[error];
                }
            };

            ctrl.login = function(credentials) {
                credentials.action = 'signin';
                api().fetch(credentials).$promise.then(function(response){
                ctrl.response = response;
                if(response.token) sessionStorage.setItem("authToken", response.token);
                else if(sessionStorage.getItem("authToken")) sessionStorage.removeItem("authToken");
                },
                function(response){
                    ctrl.response = {
                        status: 'failure',
                        error: {
                            err_code: response.status,
                            err_desc: response.statusText
                        }
                    };
                });
            };
        }
    ]);