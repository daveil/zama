"use strict";
define(['app','utilFilters','api'], function (app) {
    app.register.controller('ParetoSheetController',['$scope','$rootScope','$filter','api', function ($scope,$rootScope,$filter,api) {
		var dept  = $rootScope.__USER.department_id;
		if($rootScope.__USER.user_type=='admin'||$rootScope.__USER.user_type=='manager')
			dept='all';
		$scope.ShowDept = dept=='all';
		$scope.init = function(){
			getData('dept');
			$scope.PreventCancel = true;
			$scope.PreventSubmit = true;
			$scope.chartOptions = {
				 scales: {
						xAxes: [{
							stacked: true
						}],
						yAxes: [{
							stacked: true
						}]
					},
				legend: {display: true}
			}
					
		}
		$scope.setActiveKPI = function(kpi_id){
			$scope.ActiveKPI = kpi_id;
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
					$scope.PreventCancel = false;
					$scope.PreventSubmit = false;
                    });
                break;
				 case 'subcat':
                   api.GET('subcategories',data,function(response){
                    $scope.SubCategories = response.data;
                    });
                break;
            }
        }
       
        $scope.$watch('Category',function(){
            getData('kpi',{category_id:$scope.Category});
        });
        $scope.submitFilter =  function(){
			if(!$scope.KPI&&!$scope.MonthFilter) return alert('Required KPI/Month');
			$scope.Submitting=true;
			$scope.Plans =null;
			$scope.Paretos =null;
			$scope.SubCategories =null;
			$scope.Percentages =null;
			$scope.Totals =null;
			$scope.ReportDownloadLink = null;
			var report_filter = {};
				report_filter.type = 'pareto';
				report_filter.kpi_id = $scope.KPI;
				report_filter.month = $filter('date')($scope.MonthFilter,'yyyy-MM');
			api.GET('reports',report_filter,function(response){
				$scope.ReportDownloadLink  = 'api/reports.xml?';
				$scope.ReportDownloadLink +='type='+report_filter.type;
				$scope.ReportDownloadLink +='&kpi_id='+report_filter.kpi_id;
				$scope.ReportDownloadLink +='&month='+report_filter.month;
				$scope.Paretos = response.data;
				
				renderGraphs(angular.copy($scope.Paretos));
				$scope.ActiveKPI = $scope.Paretos[0].kpi.id;
				/* 
				var pareto = response.data[0].pareto;
				$scope.ParetoHeader = pareto.header;
				$scope.ParetoEntry = pareto.entry;
				$scope.ParetoPercentage = pareto.percentage;
				$scope.Plans = response.data[0].plans;
				$scope.Paretos = response.data[0].paretos;
				$scope.Percentages = response.data[0].percentages;
				$scope.Totals = response.data[0].totals;
				$scope.SubCategories = response.data[0].subcategories;
				*/
				
				$scope.Submitting=false;
			});
			function renderGraphs(data){
				var graphs  = [];
				for(var i in data){
					var d = data[i];
					var graph = {};
						d.pareto.header.shift();
						graph.labels = d.pareto.header;
						graph.data = [];
						graph.datasets = [];
					for(var j in d.pareto.percentage){
						if(j==0) continue;
						var p  = d.pareto.percentage[j];
						var subcat ={
							label:p.shift(),
						}
						graph.datasets.push(subcat);
						var e = [];
						for(var l in p){
							e.push(parseFloat(p[l]));
						}
						graph.data.push(e);
					}
					graphs.push(graph);
						
				}
				$scope.ParetoGraphs = graphs;
			}
		}
    }]);
	app.register.controller('PlanSheetController',['$scope','$rootScope','$filter','api', function ($scope,$rootScope,$filter,api) {
		var dept  = $rootScope.__USER.department_id;
		if($rootScope.__USER.user_type=='admin'||$rootScope.__USER.user_type=='manager')
			dept='all';
		$scope.ShowDept = dept=='all';
		$scope.init = function(){
			getData('dept');
			$scope.PreventCancel = true;
			$scope.PreventSubmit = true;
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
					$scope.PreventCancel = false;
					$scope.PreventSubmit = false;
                    });
                break;
				 case 'subcat':
                   api.GET('subcategories',data,function(response){
                    $scope.SubCategories = response.data;
                    });
                break;
            }
        }
       
        $scope.$watch('Category',function(){
            getData('kpi',{category_id:$scope.Category});
        });
        $scope.submitFilter =  function(){
			if(!$scope.KPI&&!$scope.MonthFilter) return alert('Required KPI/Month');
			$scope.Submitting=true;
			$scope.Plans =null;
			$scope.Paretos =null;
			$scope.SubCategories =null;
			$scope.Percentages =null;
			$scope.Totals =null;
			$scope.ReportDownloadLink = null;
			var report_filter = {};
				report_filter.type='plan';
				report_filter.kpi_id = $scope.KPI;
				report_filter.month = $filter('date')($scope.MonthFilter,'yyyy-MM');
			api.GET('reports',report_filter,function(response){
				$scope.ReportDownloadLink  = 'api/reports.xml?';
				$scope.ReportDownloadLink +='type='+report_filter.type;
				$scope.ReportDownloadLink +='&kpi_id='+report_filter.kpi_id;
				$scope.ReportDownloadLink +='&month='+report_filter.month;
				$scope.KPI_Name = response.data[0].kpi.name;
				var plan = response.data[0].plan;
				$scope.PlanMonthlyHeader = plan.monthly.header;
				$scope.PlanDailyHeader = plan.daily.header;
				$scope.PlanMonthlyEntry = plan.monthly.entry;
				$scope.PlanDailyEntry = plan.daily.entry;
				$scope.PlanMonthlyTotal = plan.monthly.total;
				$scope.PlanDailyTotal = plan.daily.total;
				
				$scope.Plans = response.data[0].plans;
				$scope.Paretos = response.data[0].paretos;
				$scope.Percentages = response.data[0].percentages;
				$scope.Totals = response.data[0].totals;
				$scope.SubCategories = response.data[0].subcategories;
				$scope.Submitting=false;
			});
		}
    }]);

});