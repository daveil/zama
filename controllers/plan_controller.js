"use strict";
define(['app','api'], function (app) {
    app.register.controller('IndividualController',['$scope','$rootScope','$filter','api', function ($scope,$rootScope,$filter,api) {
    	var dept  = $rootScope.__USER.department_id;
		$scope.init = function(){
			$scope.LineMachine = null;
			$scope.ShiftDay = null;
			$scope.ShiftNight = null;
			$scope.DateFrom = null;
			$scope.DateTo = null;
			$scope.workHour = 0;
			$scope.cycleTime = 0;
			$scope.targetEfficiency = 0;
			$scope.targetDelivery = 0;
			$scope.shiftNo = 0;
			$scope.Submitting=false;
			getData('dept');
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
				$scope.Submitting=true;
				api.POST('plans',data,function(response){
					alert(response.meta.message);
					$scope.init();
					
				});
		}
        function getData(type,data){
            switch(type){
                case 'dept':
					var data = {};
					if(dept!='all')
						data.id = dept;
                    api.GET('departments',data,function(response){
						$scope.Departments = response.data;
						$scope.Department = {};
						if(dept!='all')
							$scope.Department =  response.data[0].id;
						else
							$scope.Department = null;
                    });
                break;
                case 'cav':
                    return api.GET('cavities',data,function(response){
                        $scope.Cavities = response.data;
                    });
                break;
                case 'cat':
                    return api.GET('categories',data,function(response){
                        $scope.Categories = response.data;
                    });
                break;
                case 'kpi':
                   return api.GET('kpis',data,function(response){
                    $scope.KPIs = response.data;
                    });
                break;
                case 'subcat':
                   return api.GET('subcategories',data,function(response){
                    $scope.SubCategories = response.data;
                    });
                break;
                case 'lnmn':
                   return api.GET('line_machines',data,function(response){
                    $scope.LineMachines = response.data;
                    });
                break;
				case 'mod':
                    return api.GET('model_nos',data,function(response){
                        $scope.Models = response.data;
                    });
                break;
            }
        }
		$scope.$watch('Department',function(value){
			$scope.Category = null;
			$scope.Categories = [];
			$scope.KPIs = [];
			$scope.SubCategories = [];
			$scope.LineMachines = [];
			if($scope.Department){
				var data = {department_id:$scope.Department};
				var models = 'Categories|KPIs|SubCategories|LineMachines';
					models = models.split('|');
				var list = 'cat|kpi|subcat|lnmn';
					list = list.split('|');
				(function requestList(index,data){
					console.log(index);
					if(index<list.length)
						getData(list[index],data).then(
						function success(){
							return requestList(index+1,data)
							},
						function error(){
							$scope[models[index]] = [{}];
							return requestList(index+1,data)
							}
						);
				})(0,data);
			}
		});
		$scope.$watchGroup(['Category','KPI','SubCategory','LineMachine'],function(){
			if(!$scope.Category)
				$scope.KPI = null;
			if(!$scope.KPI)
				$scope.SubCategory = null;
			if(!$scope.SubCategory)
				$scope.LineMachine = null;
		});
		
    }]);
});
