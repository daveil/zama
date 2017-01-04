"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Line Machines',
				},
				data:[
					{department_id:'dcast',category_id:'cat1',subcategory_id:'scat1',id:'lnm11',name:'Line Machine 1.1'},
					{department_id:'dcast',category_id:'cat1',subcategory_id:'scat1',id:'lnm12',name:'Line Machine 1.2'},
					{department_id:'dcast',category_id:'cat1',subcategory_id:'scat1',id:'lnm13',name:'Line Machine 1.3'},
					{department_id:'dcast',category_id:'cat2',subcategory_id:'scat2',id:'lnm21',name:'Line Machine 2.1'},
					{department_id:'dcast',category_id:'cat2',subcategory_id:'scat2',id:'lnm21',name:'Line Machine 2.2'},
					{department_id:'dcast',category_id:'cat2',subcategory_id:'scat2',id:'lnm21',name:'Line Machine 2.3'},
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',id:'lnm31',name:'Line Machine 3.1'},
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',id:'lnm32',name:'Line Machine 3.2'},
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',id:'lnm33',name:'Line Machine 3.3'},
				]
			}
		);
});