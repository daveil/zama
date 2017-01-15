"use strict";
define(['app','api'], function (app) {
    app.register.controller('IndividualController',['$scope','$rootScope','$filter','api', function ($scope,$rootScope,$filter,api) {
    	var dept  = $rootScope.__USER.department;
        var data  ={department_id:dept};
		$scope.init = function(){
			$scope.ParetoDetail = [];
			$scope.LineMachine = null;
			$scope.ParetoDate = null;
		}
         function getData(type,data){
            switch(type){
                case 'dept':
                    api.GET('departments',{id:dept},function(response){
                        $scope.Department =  response.data[0];
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
						for(var i in $scope.Models ){
							var model =  $scope.Models[i];
							$scope.ParetoDetail[i] = {};
							$scope.ParetoDetail[i].model_no_id =  model.id;
						}
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
		$scope.$watch('LineMachine',function(){
			if($scope.LineMachine){
				$scope.ParetoDetail = [];
				getData('mod',{line_machine_id:$scope.LineMachine});
			}
        });
		
		$scope.submitPareto = function(){
			var data  =  {};
				data.line_machine_id = $scope.LineMachine;
				data.pareto_date  = $filter('date')($scope.ParetoDate,'yyyy-MM-dd');
				data.pareto_details =  $scope.ParetoDetail;
			api.POST('paretos',data,function(response){
				alert(response.meta.message);
				$scope.init();
			});
		}

    }]);
});
