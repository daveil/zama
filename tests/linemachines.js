"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Line Machines',
				},
				data:[
					{department_id:'dcast',id:'lnm11',name:'Line Machine 1.1'},
					{department_id:'dcast',id:'lnm12',name:'Line Machine 1.2'},
					{department_id:'dcast',id:'lnm13',name:'Line Machine 1.3'},
				]
			}
		);
});