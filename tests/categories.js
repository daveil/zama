"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Categories',
				},
				data:[
					{department_id:'dcast',id:'cat1', name:'Category 1'},
					{department_id:'dcast',id:'cat2', name:'Category 2'},
					{department_id:'dcast',id:'cat3', name:'Category 3'},
				]
			}
		);
});