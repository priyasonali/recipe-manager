angular.module('RecipeManager')
    .controller('LoginController', [
        '$scope', '$timeout', '$location', 'api',
        function($scope, $timeout, $location, api) {
            var ctrl = this;

            ctrl.credentials = {};
            ctrl.forgotten = false;
            ctrl.fgtpass = {};

            ctrl.uNameRegX = /^[a-z]+$/;
            ctrl.uPassRegX = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!=@#$%^&-])[A-Za-z\d!=@#$%^&-]+$/;
            ctrl.errorChk = function(element, error){
                var form = $scope.loginForm;
                var formElement = $scope.loginForm[element];
                if(Array.prototype.slice.call(arguments).length === 1) {
                    return (formElement.$touched || form.$submitted) && formElement.$invalid;
                } else {
                    return (formElement.$touched || form.$submitted) && formElement.$error[error];
                }
            };

            ctrl.emailChk = function(element, error){
                var form = $scope.forgotForm;
                var formElement = $scope.forgotForm[element];
                if(Array.prototype.slice.call(arguments).length == 1) {
                    return (formElement.$touched || form.$submitted) && formElement.$invalid;
                } else {
                    return (formElement.$touched || form.$submitted) && formElement.$error[error];
                }
            };

            ctrl.login = function(credentials) {
                credentials.action = 'signin';
                api().fetch(credentials).$promise.then(function(response){
                    ctrl.response = response;
                    if(response.status == "success") {
                        ctrl.successMsg = "Authentication Successful! Redirecting to Dashboard..."; 
                    }
                    
                    if(response.token) {
                        sessionStorage.setItem("authToken", response.token);
                        $timeout(function(){
                            $location.path('/dashboard');
                        },2000);
                    }
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

            ctrl.forgotPass = function() {
                ctrl.forgotten = !ctrl.forgotten;
                ctrl.response = {};
            };

            ctrl.fetchPass = function() {
                ctrl.fgtpass.action = "forgotpass";
                api().fetch(ctrl.fgtpass).$promise.then(function(response){
                    ctrl.response = response;
                    if(response.status == "success") {
                        ctrl.forgotten = !ctrl.forgotten;
                        ctrl.fgtpass = {};
                        ctrl.successMsg = "Your username and a temporary password has been sent to your email address. Remember to change your password after logging in.";
                    }
                },function(response){
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