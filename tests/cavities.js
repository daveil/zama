"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Cavities',
				},
				data:[
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',linemachine_id:'lnm3',partno_id:'pno3',id:'cav1',name:'Cavity 1'},
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',linemachine_id:'lnm3',partno_id:'pno3',id:'cav2',name:'Cavity 2'},
					{department_id:'dcast',category_id:'cat3',subcategory_id:'scat3',linemachine_id:'lnm3',partno_id:'pno3',id:'cav3',name:'Cavity 3'},
				]
			}
		);
});