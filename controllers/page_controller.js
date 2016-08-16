"use strict";
define(['app','api'], function (app) {
    app.register.controller('PageController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
       $scope.init = function (module_name) { 
			$rootScope.__MODULE_NAME = 'ZAMA';
			 $scope.ChartColors = ['#45b7cd', '#ff6384', '#ff8e72'];
			$scope.Deparments = [
						'Assembly',
						'Sub assembly',
						'Die Cast',
						'Body Machining',
						'Parts Machining',
						'Cover Machining'
			];
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
			$scope.setActiveDept($scope.Deparments[0]);
			function renderRandom(num){
				return Math.random()*num;
			}
	  }
    }]);
});

