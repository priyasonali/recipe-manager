angular.module('RecipeManager')
    .controller('RegistrationController', [
        '$scope', '$interval', 'api', '$log',
        function($scope, $interval, api, $log) {
            var ctrl = this;

            ctrl.actStatus = "";
            ctrl.actDesc = "Activate Email";

            ctrl.uNameRegX = /^[a-z]+$/;
            ctrl.uPassRegX = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!=@#$%^&-])[A-Za-z\d!=@#$%^&-]+$/;
            ctrl.errorChk = function(element, error){
                var form = $scope.registerForm;
                var formElement = $scope.registerForm[element];
                if(Array.prototype.slice.call(arguments).length === 1) {
                    return (formElement.$touched || form.$submitted) && formElement.$invalid;
                } else {
                    return (formElement.$touched || form.$submitted) && formElement.$error[error];
                }
            };

            ctrl.activate = function() {
                if($scope.registerForm.uEmail.$valid) {
                    ctrl.actStatus = "pending";
                    ctrl.actDesc = "Waiting for activation...";
                    ctrl.sendEmail();
                } else {
                    $scope.registerForm.uEmail.$touched = true;
                }
            };

            ctrl.sendEmail = function() {
                if(arguments[0]) ctrl.check = true;
                var model = {
                    'action':'validate',
                    'user_email':ctrl.credentials.user_email
                };
                if(ctrl.check) {
                    model.user_check = true;
                }
                api().fetch(model).$promise.then(function(response){
                    $log.log(response.error.err_code);
                    if(response.error.err_code == 8) {
                        if(ctrl.check) {
                            $interval.cancel(ctrl.waitInterval);
                        }
                        ctrl.actStatus = "activated";
                        ctrl.actDesc = "Activated!";
                        $log.log("Activated!");
                    } else if(response.error.err_code === 0) {
                        ctrl.actStatus = "";
                        ctrl.actDesc = "Activate Email";
                        ctrl.response = response;
                    } else {
                        if(!ctrl.check) {
                            ctrl.waitActivation();
                        }
                    }
                },
                function(response){
                    $log.log(response.status);
                    if(!ctrl.check) {
                        ctrl.actStatus = "";
                        ctrl.actDesc = "Activate Email";
                        ctrl.response = {
                            status: 'failure',
                            error: {
                                err_code: response.status,
                                err_desc: response.statusText
                            }
                        };
                    }
                });
            };

            ctrl.waitActivation = function() {
                ctrl.waitInterval = $interval(function(){
                    $log.log("checking...");
                    ctrl.sendEmail(true);
                },5000);
            };

            ctrl.register = function(credentials) {
                credentials.action = 'registration';
                api().fetch(credentials).$promise.then(function(response){
                    ctrl.response = response;
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