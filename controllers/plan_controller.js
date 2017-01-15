"use strict";
define(['app','api'], function (app) {
    app.register.controller('IndividualController',['$scope','$rootScope','$filter','api', function ($scope,$rootScope,$filter,api) {
    	var dept  = $rootScope.__USER.department;
        var data  ={department_id:dept};
		$scope.init = function(){
			$scope.LineMachine = null;
			$scope.ShiftDay = null;
			$scope.DateFrom = null;
			$scope.DateTo = null;
			$scope.workHour = 0;
			$scope.cycleTime = 0;
			$scope.targetEfficiency = 0;
			$scope.targetDelivery = 0;
			$scope.shiftNo = 0;
		}
		 $scope.formatDate = function(date){
			  var dateOut = new Date(date);
			  return dateOut;
		};
		$scope.submitPlan = function(){
			var data = {};
				data.line_machine_id =  $scope.LineMachine;
				data.shift_day =  $scope.ShiftDay;
				data.shift_night =  $scope.ShiftNight;
				data.date_from =  $filter('date')($scope.DateFrom,'yyyy-MM-dd');
				data.date_to =  $filter('date')($scope.DateTo,'yyyy-MM-dd');
				
				data.work_hour =  $scope.workHour;
				data.cycle_time =  $scope.cycleTime;
				data.target_efficiency =  $scope.targetEfficiency;
				data.shift_no =  $scope.shiftNo;
				
				var production_plan = $scope.workHour*$scope.cycleTime*$scope.targetEfficiency*$scope.shiftNo;
				data.production_plan =  production_plan;
				api.POST('plans',data,function(response){
					alert(response.meta.message);
					$scope.init();
					
				});
		}
        function getData(type,data){
            switch(type){
                case 'dept':
                    api.GET('departments',{id:dept},function(response){
                        $scope.Department =  response.data[0];
                        getData('pno',data);
                        getData('cav',data);
                        getData('cat',data);
                    });
                break;
                case 'cav':
                    api.GET('cavities',data,function(response){
                        $scope.Cavities = response.data;
                    });
                break;
                case 'cat':
                    api.GET('categories',data,function(response){
                        $scope.Categories = response.data;
                    });
                break;
                case 'kpi':
                   api.GET('kpis',data,function(response){
                    $scope.KPIs = response.data;
                    });
                break;
                case 'subcat':
                   api.GET('subcategories',data,function(response){
                    $scope.SubCategories = response.data;
                    });
                break;
                case 'lnmn':
                   api.GET('line_machines',data,function(response){
                    $scope.LineMachines = response.data;
                    });
                break;
				case 'mod':
                    api.GET('model_nos',data,function(response){
                        $scope.Models = response.data;
                    });
                break;
            }
        }
        getData('dept',{department_id:dept});
        $scope.$watch('Category',function(){
            getData('kpi',{category_id:$scope.Category});
        });
        $scope.$watch('KPI',function(){
            getData('subcat',{kpi_id:$scope.KPI});
        });
		$scope.$watch('SubCategory',function(){
            getData('lnmn',{subcategory_id:$scope.SubCategory});
        });
		$scope.$watch('Line',function(){
            getData('mod',{line_machine_id:$scope.Line});
        });

    }]);
});
