define(function() {
	var requestCount=0;
	return {
		requestCount:0,
		run:function (settings,method,endpoint,data,success,error,$rootScope,$timeout,$q){
				
				requestCount++;
				window.DEMO_REGISTRY=window.DEMO_REGISTRY||{};
				var deferred = $q.defer();
				var promise = deferred.promise;
				promise.then(function(response){
					success(response);
				},function(response){
					error(response);
				});
				if(endpoint=='register' ||endpoint=='login'||endpoint=='logout'){
					if(endpoint=='logout')
						data = {action:endpoint};
					else
						data.action =  endpoint;
					endpoint = 'users';
				}
				$timeout(function(){
					require([settings.TEST_DIRECTORY+'/'+endpoint],function(response){
						$rootScope.$apply(function(){
							var resp = response[method](data);
							if(success&& settings.TEST_SUCCESS) {
							deferred.resolve(resp.success);
							}
							if(error && settings.TEST_ERROR) {
								deferred.reject(resp.error);
							}
						});
						requestCount--;
					});
				},settings.TEST_DELAY*requestCount);
				return promise;
				
			}
		};
});