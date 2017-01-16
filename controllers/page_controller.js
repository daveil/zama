"use strict";
define(['app','api'], function (app) {
    app.register.controller('PageController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
       $scope.init = function (module_name) { 
			$rootScope.__MODULE_NAME = 'ZAMA';
			$scope.workHour = 0;
			$scope.cycleTime = 0;
			$scope.targetEfficiency = 0;
			$scope.targetDelivery = 0;
			$scope.shiftNo = 0;
			 $scope.ChartColors = ['#45b7cd', '#ff6384', '#ff8e72'];
			 $scope.Departments = [{name:'Loading...'}];
			 var data = {};
			 if($rootScope.__USER.department_id!='all'){
				 data.id = $rootScope.__USER.department_id;
			 }
			api.GET('departments',data,function(response){
				$scope.Departments = response.data;
				$scope.setActiveDept($scope.Departments[0]);
			});
			$scope.setActiveDept = function(dept){
				$scope.ActiveDept = dept;
				$scope.PieData = [];
				$scope.PieData.push(renderRandom(100));
				$scope.PieData.push(renderRandom(100));
				$scope.PieData.push(renderRandom(100));
				$scope.BarData = [];
				for(var j=0;j<2;j++){
					$scope.BarData[j]=[];
					for(var i=1;i<=7;i++){
						$scope.BarData[j].push(renderRandom(50));
					}
					
				}
				
			}
			$scope.PieLabels = ["Download Sales", "In-Store Sales", "Mail-Order Sales"];
			$scope.BarLabels = ['2006', '2007', '2008', '2009', '2010', '2011', '2012'];
			$scope.series = ['Series A', 'Series B'];
			
			function renderRandom(num){
				return Math.random()*num;
			}
	  }
    }]);
});


