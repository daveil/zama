"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Line Machines',
				},
				data:[
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',id:'lnm1',name:'Line Machine 1'},
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',id:'lnm2',name:'Line Machine 2'},
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',id:'lnm3',name:'Line Machine 3'},
				]
			}
		);
});