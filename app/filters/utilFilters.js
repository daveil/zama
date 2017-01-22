"use strict";
define(['app'], function (app) {
	app.register.filter('isEmpty', function () {
        return function (obj) {
            for (var field in obj) {
                if (obj.hasOwnProperty(field)) {
                    return false;
                }
            }
            return true;
        };
    });
	app.register.filter('isChild', function () {
       
       return function (obj) {
		   console.log(arguments);
		   return true;
	   }
    });
});