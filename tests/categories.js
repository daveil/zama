"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Categories',
				},
				data:[
					{id:'cat1',deparment:'Dept 1', name:'Category 1'},
					{id:'cat2',deparment:'Dept 2', name:'Category 2'},
					{id:'cat3',deparment:'Dept 2', name:'Category 3'},
				]
			}
		);
});