"use strict";
define(['settings','demo'], function(settings,demo){
	var RootController =  function ($scope, $rootScope,$timeout,$cookies,$http,$q,$window) {
		$rootScope.__toggleSideBar = function(){
			$rootScope.__SIDEBAR_OPEN = !$rootScope.__SIDEBAR_OPEN;
		}
		$rootScope.$on('$routeChangeStart', function (scope, current, next) {
			$rootScope.__APP_READY = false;
			$rootScope.__FAB_READY = false;
		});
		$rootScope.$on('$routeChangeSuccess', function (scope, current, next) {
			try{
				$rootScope.__USER =  JSON.parse($cookies.get('__USER'));
			}catch(e){
				$rootScope.__USER = null;
			}
			
			if(!$rootScope.__USER&&current.originalPath!='/login'){
				$window.location.href="#/login";
			}
			$timeout(function(){
				$rootScope.__APP_READY = true;
				$timeout(function(){
					$rootScope.__FAB_READY = true;
				},settings.FAB_TRANSITION_DELAY);
			},settings.APP_TRANSITION_DELAY);
			
        });
		$rootScope.isEmpty =function(obj){
			 for(var key in obj) {
				if(obj.hasOwnProperty(key))
					return false;
			}
			return true;
		}
		demo.run(settings,'GET','system_defaults',null,
					function success(response){
						$rootScope._APP = response.data;
					},function error(response){
						console.log('ERROR:'+response.meta.message);
					},$rootScope,$http,$timeout,$q);
	};
	RootController.$inject = ['$scope', '$rootScope','$timeout','$cookies','$http','$q','$window'];
	return RootController;
});