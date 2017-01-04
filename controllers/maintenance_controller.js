"use strict";
define(['app','api'], function (app) {
	const MNT_APIS = 'departments|categories|kpis|subcategories|linemachines|partnos|cavities'.split('|');
	const MNT_FIELDS = 'department|category|kpi|subcategory|linemachine|partno|cavity'.split('|');
	const MNT_LABELS = 'Department|Category|KPI|Sub Category|Line/Machine|Part No|Cavity'.split('|');
	const MNT_MAX = (MNT_LABELS.length*2)-1;
	const MNT_STRUCT = {
		DEPARTMENT:13,
		CATEGORY:11,
		KPI:9,
		SUB_CATEGORY:7,
		LINE_MACHINE:5,
		PART_NO:3,
		CAVITY:1,
	};
    app.register.controller('MaintenanceController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
		$scope.MNT_FIELDS = {};
		$scope.MNT_STRUCT = angular.copy(MNT_STRUCT);
		$scope.init =  function(type){
			$scope.SearchKeyword = null;
			$scope.UI_DRPDWN = {};
			$scope.UI_SHOWCODE=false;
			var limit = type;
			var uis = [];
			var requests = [];
			for(var i=0, ctr=MNT_MAX;i<MNT_LABELS.length&&ctr>=limit;i++,ctr-=2){
				var label =  MNT_LABELS[i];
				var field =  MNT_FIELDS[i];
				if(ctr==limit){
					if(ctr>=MNT_STRUCT.SUB_CATEGORY){
						$scope.UI_SHOWCODE = true;
						uis.push({label:"Code",type:"text",field:'id'});
						uis.push({label:"Name",type:"text",field:'name'});
					}else{
						uis.push({label:label,type:"text",field:'name'});
					}
				}else{
					var endpoint = MNT_APIS[i];
					requests.push(endpoint);
					var parent_id = i>0?MNT_FIELDS[i-1]+'_id':null;
					uis.push({label:label,type:"dropdown",field:field,endpoint:endpoint,parent_id:parent_id});
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
			$scope.RecordMode = 'ADD';
			loadData();
		}
		$scope.submitData = function(){
			var data =  $scope.MNT_FIELDS;
			var success = function(response){
						$scope.MNT_FIELDS={};
						$scope.RecordMode = 'ADD';
						loadData();
					};
			switch($scope.RecordMode){
				case 'ADD':case'EDIT':
					api.POST($scope.DATA_ENDPOINT,data,success);
				break;
				case 'DELETE':
					data =  {id:data.id};
					api.DELETE($scope.DATA_ENDPOINT,data,success);
				break;
			}
			
		}
		$scope.cancelData = function(){
			$scope.MNT_FIELDS={};
			$scope.RecordMode = 'ADD';
		}
		$scope.confirmSearch = function(){
			loadData({keyword:$scope.SearchKeyword,fields:['name']});
		}
		$scope.setActiveRecord = function(data){
			$scope.RecordMode = 'EDIT';
			$scope.MNT_FIELDS =  angular.copy(data);
		}
		$scope.setDeleteRecord = function(data){
			$scope.RecordMode = 'DELETE';
			$scope.MNT_FIELDS =  angular.copy(data);	
		}
		function loadData(data){
			console.log(data,$scope.DATA_ENDPOINT);
			api.GET($scope.DATA_ENDPOINT,data,function(response){
				$scope.DATA_GRID =  response.data;
			});
		};
	}]);
});
