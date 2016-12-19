"use strict";
define(["model"],function($model){
	var login =  new $model(
			{
			  "meta": {
			    "title": "Login"
			  },
			  "data": [
			    {
			      "id": 0,
				 "username":"admin",
				 "password":"password",
				 "user_type":"admin"
			    },
			    {
			      "id": 1,
			     "username":"user",
				 "password":"password",
				 "user_type":"user"
			    }
			  ]
			}
		);
		login.POST = function(data){
			var __MSG = 'Invalid username/password';
			var __USER = {user:null};
			var users =  login.data;
			for(var index in users){
				var user = users[index];
				if(user.username==data.username && user.password==data.password){
					delete user.password;
					__USER.user = user;
					__MSG = 'Login successful!';
				}
			}
			return {success:{data:__USER,message:__MSG}};
		}
	return login;
});