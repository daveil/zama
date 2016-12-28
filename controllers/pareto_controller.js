"use strict";
define(['app','api'], function (app) {
    app.register.controller('IndividualController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
    	var dept  = $rootScope.__USER.department;
    	api.GET('departments',{id:dept},function(response){
    		$scope.Department = response.data[0];
    		api.GET('categories',{department_id:dept},function(response){
    			$scope.Categories = response.data;
    		});
    		api.GET('subcategories',{department_id:dept},function(response){
    			$scope.SubCategories = response.data;
    		});
    	});

    }]);
});
