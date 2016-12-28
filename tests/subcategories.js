"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Sub-categories',
				},
				data:[
					{department_id:'dcast',category_id:'cat1',id:'scat1',name:'Sub Category 1'},
					{department_id:'dcast',category_id:'cat2',id:'scat2',name:'Sub Category 2'},
					{department_id:'dcast',category_id:'cat3',id:'scat3',name:'Sub Category 3'},
				]
			}
		);
});