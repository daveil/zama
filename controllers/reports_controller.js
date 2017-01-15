"use strict";
define(['app','api'], function (app) {
    app.register.controller('ParetoSheetController',['$scope','$rootScope','$filter','api', function ($scope,$rootScope,$filter,api) {
		var dept  = $rootScope.__USER.department_id;
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
            }
        }
        getData('dept');
        $scope.$watch('Category',function(){
            getData('kpi',{category_id:$scope.Category});
        });
        $scope.submitFilter =  function(){
			var data = {};
				data.kpi_id = $scope.KPI;
				getData('subcat',data);
			api.GET('reports',data,function(response){
				$scope.KPI_Name = response.data[0].kpi.name;
				$scope.Plans = response.data[0].plans;
				$scope.Paretos = response.data[0].paretos;
				$scope.Percentages = response.data[0].percentages;
				$scope.Totals = response.data[0].totals;
			});
		}
    }]);
});