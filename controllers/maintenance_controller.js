"use strict";
define(['app','api'], function (app) {
	const MNT_APIS = 'departments|categories|kpis|subcategories|line_machines|model_nos|cavities'.split('|');
	const MNT_FIELDS = 'department|category|kpi|subcategory|line_machine|model|cavity'.split('|');
	const MNT_LABELS = 'Department|Category|KPI|Sub Category|Line/Machine|Model|Cavity'.split('|');
	const MNT_MAX = (MNT_LABELS.length*2)-1;
	const MNT_STRUCT = {
		DEPARTMENT:13,
		CATEGORY:11,
		KPI:9,
		SUB_CATEGORY:7,
		LINE_MACHINE:5,
		MODEL:3,
		CAVITY:1,
	};
    app.register.controller('MaintenanceController',['$scope','$rootScope','api', function ($scope,$rootScope,api) {
		const DEPT  = $rootScope.__USER.department_id;
		$scope.MNT_FIELDS = {};
		$scope.MNT_STRUCT = angular.copy(MNT_STRUCT);
		$scope.init =  function(type){
			$scope.SearchKeyword = null;
			$scope.UI_DRPDWN = {};
			$scope.UI_SHOWCODE=false;
			var limit = type;
			var uis = [];
			var requests = [];
			if(limit>=MNT_STRUCT.CAVITY && limit<=MNT_STRUCT.LINE_MACHINE && false){
				var max = MNT_MAX;
				var base = MNT_STRUCT.LINE_MACHINE;
				var i =  (max-base)/2 + (base - limit )  / 2;
				var label =  MNT_LABELS[i];
				var field =  MNT_FIELDS[i];
				var endpoint = 'departments';
				requests.push(endpoint);
				uis.push({label:'Department',type:"dropdown",field:'department',endpoint:endpoint});	
				uis.push({label:label,type:"text",field:'name'});
				$scope.DATA_ENDPOINT = MNT_APIS[i];
			}else{
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
				$scope.DATA_ENDPOINT = MNT_APIS[i-1];
			}
			(function req_api($scope,requests,index){
				if(index<requests.length){
					var endpoint = requests[index];
					api.GET(MNT_APIS[index],function(response){
						if(endpoint=='departments'){
							if(DEPT!='all')
								$scope.MNT_FIELDS.department_id = DEPT;
							else
								$scope.MNT_FIELDS.department_id = null;
						}
						$scope.UI_DRPDWN[endpoint]=response.data;
						return req_api($scope,requests,index+1);
					});
				}				
			})($scope,requests,0);
			$scope.UI_RENDER =  uis;
			$scope.RecordMode = 'ADD';
			loadData();
		}
		$scope.byParentObj = function(field,id){
			return function(item){
				return item[field]==id;
			}
		}
		$scope.submitData = function(){
			var data =  $scope.MNT_FIELDS;
			var success = function(response){
						$scope.MNT_FIELDS={};
						if(DEPT!='all')
							$scope.MNT_FIELDS.department_id = DEPT;
						else
							$scope.MNT_FIELDS.department_id = null;
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
			$scope.MNT_FIELDS.old_id = $scope.MNT_FIELDS.id;
		}
		$scope.setDeleteRecord = function(data){
			$scope.RecordMode = 'DELETE';
			$scope.MNT_FIELDS =  angular.copy(data);	
		}
		function loadData(data){
			api.GET($scope.DATA_ENDPOINT,data,function(response){
				$scope.DATA_GRID =  response.data;
			});
		};
	}]);
});
