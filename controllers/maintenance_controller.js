"use strict";
define(['app','api'], function (app) {
	const MNT_APIS = 'departments|categories|subcategories|linemachines|partnos|cavities'.split('|');
	const MNT_FIELDS = 'Department|Category|Sub Category|Line/Machine|Part No|Cavity'.split('|');
	const MNT_MAX = (MNT_FIELDS.length*2)-1;
	const MNT_STRUCT = {
		DEPARTMENT:11,
		CATEGORY:9,
		SUB_CATEGORY:7,
		LINE_MACHINE:5,
		PART_NO:3,
		CAVITY:1,
	};
    app.register.controller('MaintenanceController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
		$scope.MNT_STRUCT = angular.copy(MNT_STRUCT);
		$scope.init =  function(type){
			$scope.SearchKeyword = null;
			$scope.UI_DRPDWN = {};
			var limit = type;
			var uis = [];
			var requests = [];
			for(var i=0, ctr=MNT_MAX;i<MNT_FIELDS.length&&ctr>=limit;i++,ctr-=2){
				var field =  MNT_FIELDS[i];
				if(ctr==limit){
					if(ctr>=MNT_STRUCT.SUB_CATEGORY){
						uis.push({label:"Code",type:"text"});
						uis.push({label:"Name",type:"text"});
					}else{
						uis.push({label:field,type:"text"});
					}
				}else{
					var endpoint = MNT_APIS[i];
					requests.push(endpoint);
					uis.push({label:field,type:"dropdown",endpoint:endpoint});
				}
			}
			(function req_api($scope,requests,index){
				if(index<requests.length){
					var endpoint = requests[index];
					api.GET(MNT_APIS[index],function(response){
						$scope.UI_DRPDWN[endpoint]=response.data;
						return req_api($scope,requests,index+1);
					});
				}				
			})($scope,requests,0);
			$scope.UI_RENDER =  uis;
			$scope.DATA_ENDPOINT = MNT_APIS[i-1];
			loadData();
		}
		
		$scope.confirmSearch = function(){
			console.log($scope.SearchKeyword);
			loadData({keyword:$scope.SearchKeyword,fields:['name']});
		}
		
		function loadData(data){
			console.log(data);
			api.GET($scope.DATA_ENDPOINT,data,function(response){
				$scope.DATA_GRID =  response.data;
			});
		};
	}]);
});
