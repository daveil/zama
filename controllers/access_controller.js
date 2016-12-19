"use strict";
define(['app','api'], function (app) {
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
