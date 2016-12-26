"use strict";
define(['app','api'], function (app) {
	//SystemUsers.Register
    app.register.controller('RegisterController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
		$scope.init = function(){
			api.GET('groups',function(response){
				$scope.Restriction = response.data;
			});
			api.GET('departments',function(response){
				$scope.Departments = response.data;	
			});			
		};
		
	}]);
	//SystemUsers.Access
	app.register.controller('AccessController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
		$scope.Access = {};
		api.GET('groups',function(response){
			$scope.Groups = response.data;
		});
		api.GET('modules',function(response){
			$scope.Modules = response.data;
		});
    }]);
});
