"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Sub-categories',
				},
				data:[
					{id:'scat1',deparment:'Dept 1',category:'Cat 1',name:'Sub Category 1'},
					{id:'scat2',deparment:'Dept 1',category:'Cat 1',name:'Sub Category 2'},
					{id:'scat3',deparment:'Dept 1',category:'Cat 1',name:'Sub Category 3'},
				]
			}
		);
});