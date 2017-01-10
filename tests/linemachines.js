"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Line Machines',
				},
				data:[
					{department_id:'dcast',id:'lnm11',name:'Line 1'},
					{department_id:'dcast',id:'lnm12',name:'Line 2'},
					{department_id:'dcast',id:'lnm13',name:'Line 3'},
				]
			}
		);
});