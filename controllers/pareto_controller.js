"use strict";
define(['app','api'], function (app) {
    app.register.controller('IndividualController',['$scope','$rootScope','$filter','api', function ($scope,$rootScope,$filter,api) {
    	var dept  = $rootScope.__USER.department_id;
		$scope.init = function(){
			$scope.Models = [];
			$scope.ParetoDetail = [];
			$scope.LineMachine = null;
			$scope.ParetoDate = null;
			$scope.Submitting=false;
			$scope.PreventCancel = true;
			$scope.PreventSubmit = true;
			getData('dept');
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
		$scope.$watch('LineMachine',function(){
			$scope.Models = [];
			$scope.ParetoDetail = [];
			if($scope.LineMachine){
				getData('mod',{line_machine_id:$scope.LineMachine});
			}
		});
		
		$scope.submitPareto = function(){
			var data  =  {};
				data.line_machine_id = $scope.LineMachine;
				data.pareto_date  = $filter('date')($scope.ParetoDate,'yyyy-MM-dd');
				data.pareto_details =  $scope.ParetoDetail;
			$scope.Submitting=true;
			api.POST('paretos',data,function(response){
				alert(response.meta.message);
				$scope.init();
			});
		}

    }]);
});
