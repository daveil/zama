"use strict";
define(['app','api'], function (app) {
    app.register.controller('IndividualController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
    	var dept  = $rootScope.__USER.department;
        var data  ={department_id:dept};
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
                case 'pno':
                    api.GET('partnos',data,function(response){
                        $scope.PartNos = response.data;
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
                   api.GET('linemachines',data,function(response){
                    $scope.LineMachines = response.data;
                    });
                break;
            }
        }
        getData('dept',{department_id:dept});
        getData('lnmn',{department_id:dept});
        $scope.$watch('Category',function(){
            getData('kpi',{category_id:$scope.Category});
        });
        $scope.$watch('KPI',function(){
            getData('subcat',{kpi_id:$scope.KPI});
        });

    }]);
});
