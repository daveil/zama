"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Part No',
				},
				data:[
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',linemachine_id:'lnm3',id:'pno1',name:'Part No 1'},
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',linemachine_id:'lnm3',id:'pno2',name:'Part No 2'},
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',linemachine_id:'lnm3',id:'pno3',name:'Part No 3'},
				]
			}
		);
});