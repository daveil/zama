"use strict";
define(['app','api'], function (app) {
	const USER_API = 'users';
	//SystemUsers.Register
    app.register.controller('RegisterController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
		$scope.init = function(){
			api.GET('groups',function(response){
				$scope.Restriction = response.data;
			});
			api.GET('departments',function(response){
				$scope.Departments = response.data;	
			});	
			$scope.RecordMode ='ADD';
			$scope.User = {};
			loadData();		
		};
		$scope.confirmSearch = function(){
			loadData({keyword:$scope.SearchKeyword,fields:['employee_name','employee_no']});
		}
		$scope.submitData = function(){
			var data =  $scope.User;
			var success = function(response){
						$scope.User = {};
						$scope.RecordMode = 'ADD';
						loadData();
					};
			switch($scope.RecordMode){
				case 'ADD':case'EDIT':
					api.POST(USER_API,data,success);
				break;
				case 'DELETE':
					data =  {id:data.id};
					api.DELETE(USER_API,data,success);
				break;
			}
			
		}
		$scope.cancelData = function(){
			$scope.User = {};
			$scope.RecordMode = 'ADD';
		}
		$scope.setActiveUser = function(data){
			$scope.RecordMode = 'EDIT';
			$scope.User =  angular.copy(data);
		}
		$scope.setDeleteUser = function(data){
			$scope.RecordMode = 'DELETE';
			$scope.User =  angular.copy(data);	
		}
		function loadData(data){
			console.log(USER_API);
			api.GET(USER_API,data,function(response){
				console.log(response);
				$scope.Users =  response.data;
			});
		};
		
	}]);
	//SystemUsers.Access
	app.register.controller('AccessController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
		$scope.Access = {};
		$scope.init =function(){
			api.GET('groups',function(response){
				$scope.Groups = response.data;
			});
			var filter = {is_parent:1};
			api.GET('modules',filter,function(response){
				$scope.Modules = response.data;
			});
		}

    }]);
});
