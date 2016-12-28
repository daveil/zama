"use strict";
define(['app','api'], function (app) {
    app.register.controller('IndividualController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
    	var dept  = $rootScope.__USER.department;
        var data  ={department_id:dept};
        function getData(type){
            switch(type){
                case 'dept':
                    api.GET('departments',{id:dept},function(response){
                        $scope.Department =  response.data[0];
                        getData('cat');
                        getData('subcat');
                    });
                break;
                case 'cat':
                    api.GET('categories',data,function(response){
                        $scope.Categories = response.data;
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
        getData('dept');
        $scope.$watch('Category',function(){
            data.category_id =  $scope.Category;
            getData('subcat');
        });
        $scope.$watch('SubCategory',function(){
            data.subcategory_id =  $scope.SubCategory;
            getData('lnmn');
        });

    }]);
});
