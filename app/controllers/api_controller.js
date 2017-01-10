"use strict";
define(['app','demo'], function(app,demo){
	 app.register.factory('api',function($http,$timeout,$rootScope,$q){
		var settings = app.settings;
		return{
			POST:function(){
				return this.HTTP('POST',arguments);
			},
			GET:function(){
				return this.HTTP('GET',arguments);
			},
			DELETE:function(){
				return this.HTTP('DELETE',arguments);
			},
			PUT:function(){
				return this.HTTP('PUT',arguments);
			},
			HTTP:function(method,__args){
				var self = this;
				var endpoint,data,success,error;
				if(__args.length){
					if(typeof __args[0] =='string') endpoint = __args[0];
					if(typeof __args[1] =='object') data = __args[1];
					if(typeof __args[1] =='function') success = __args[1];
					else if(typeof __args[2] =='function') success = __args[2];
					if(__args.length>3||!data) error = __args[__args.length-1];
					else error = function(){};
				}else{
					throw new Error("Incomplete arguments");
				}
				if(settings.DEMO_MODE){
					return demo.run(settings,method,endpoint,data,success,error,$rootScope,$timeout,$q);
				}else{
					var ext = '.'+settings.API_EXT;
					if(endpoint=='register' ||endpoint=='login'||endpoint=='logout') ext='';
					var url = settings.API_URL + endpoint + ext;
					var request ={
						  method: method,
						  url: url,
						  dataType: settings.API_EXT,
						  headers: {
						   'X-Requested-With': 'XMLHttpRequest',
						   'Content-Type': 'application'+settings.API_EXT,
						   'Accepts': 'application/'+settings.API_EXT
							}
						};
					
					if(method=='GET') {
						for(var key in data){
							if(typeof data[key] == "object")
								data[key] = data[key].join(',');
						}
						request.params = data;
					}
					else request.data = data;
					return $http(request).success(success).error(error);
				}
			},
			runTasks:function(tasks){
				if(tasks.length){
					runTask(tasks);
					function runTask(tasks,index){
						index = index || 0;
						var task;
						if(index<tasks.length){
							task = tasks[index]();
							task.then(runTask(tasks,index+1));
						}
						return task;
					}
				}
			}
		}
	});
	
});