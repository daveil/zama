"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Sub-categories',
				},
				data:[
					{id:'scat1',name:'Sub Category 1'},
					{id:'scat2',name:'Sub Category 2'},
					{id:'scat3',name:'Sub Category 3'},
				]
			}
		);
});