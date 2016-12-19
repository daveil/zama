"use strict";
define(['app','api'], function (app) {
    app.register.controller('LoginController',['$scope','$rootScope','$window','$cookies','api', function ($scope,$rootScope,$window,$cookies,api) {
		if($rootScope.__USER){
			$window.location.href="#/";
		}
		$scope.cancel = function(){
			$scope.User = {};
		}
		$scope.cancel();
		$scope.login = function(){
			var data = {
				username:$scope.User.name,
				password:$scope.User.password,
			};
			api.POST('login',data,function(response){
				if(response.user){
					$cookies.put('__USER',JSON.stringify(response.user));
					$window.location.href="#/";
				}
			});
		}
	}]);
});
