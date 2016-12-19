"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Departments',
				},
				data:[
					{id:'dcast',name:'Die Casting'},
					{id:'machn',name:'Machining'},
					{id:'assmb',name:'Assembly'},
				]
			}
		);
});