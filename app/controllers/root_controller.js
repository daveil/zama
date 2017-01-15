"use strict";
define(['settings'], function(settings){
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
				$rootScope.__MENUS =  JSON.parse($cookies.get('__MENUS'));
				$rootScope.__MENU_PARENT = $rootScope.__MENU_PARENT || {};
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
	};
	RootController.$inject = ['$scope', '$rootScope','$timeout','$cookies','$http','$q','$window'];
	return RootController;
});