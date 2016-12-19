"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Modules',
					limit:'less'
				},
				data:[
					{id:0,name:'System Login and Registration of Users'},
					{id:1,name:'Home'},
					{id:2,name:'KPI Dashboard'},
					{id:3,name:'Maintenance and Backup Module'},
					{id:4,name:'Department Plan Input'},
					{id:5,name:'Department Pareto Input'},
					{id:6,name:'Reports'}
				]
			}
		);
});