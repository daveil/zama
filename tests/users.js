"use strict";
define(["model"],function($model){
	var user =  new $model(
			{
			  "meta": {
			    "title": "Users"
			  },
			  "data": [
			    {
			      "id": 0,
			      "employee_name":"Admin",
			      "employee_no":1234,
				 "username":"admin",
				 "password":"password",
				 "user_type":"admin",
				 "department":"all",
			    },
			    {
			      "id": 1,
			      "employee_name":"Juan",
			      "employee_no":1124,
			     "username":"user",
				 "password":"password",
				 "user_type":"user",
				 "department":"dcast",
			    }
			  ]
			}
		);
		user.POST = function(data){
			data.action = data.action||'register';
			switch(data.action){
				case 'login':
					var __MSG = 'Invalid username/password';
					var __USER = {user:null};
					var users =  user.data;
					for(var index in users){
						var u = users[index];
						if(u.username==data.username && u.password==data.password){
							__USER.user = angular.copy(u);
							__MSG = 'Login successful!';
						}
					}
					return {success:{data:__USER,message:__MSG}};
				break;
				case 'register':
					return {success:user.save(data)};
				break;
			}
			
		}
	return user;
});