"use strict";
define(['app','api'], function (app) {
    app.register.controller('LoginController',['$scope','$rootScope','$window','$cookies','api', function ($scope,$rootScope,$window,$cookies,api) {
		if($window.location.hash=='#/logout'){
			$rootScope.__SIDEBAR_OPEN = false;
			$cookies.remove('__USER');
			$window.location.href="#/";
		}
		if($rootScope.__USER){
			$window.location.href="#/";
		}
		$scope.cancel = function(){
			$scope.loginMessage = null;
			$scope.User = {};
		}
		$scope.cancel();
		$scope.login = function(){
			var data = {
				username:$scope.User.name,
				password:$scope.User.password,
			};
			$scope.LoggingIn = true;
			api.POST('login',data,function(response){
				$scope.LoggingIn = false;
				if(response.data.user){
					$cookies.put('__USER',JSON.stringify(response.data.user));
					$window.location.href="#/";
				}else{
					$scope.loginMessage = response.message;
				}
			});
		}
	}]);
});
