"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Part No',
				},
				data:[
					{department_id:'dcast',id:'pno1',name:'Part No 1'},
					{department_id:'dcast',id:'pno2',name:'Part No 2'},
					{department_id:'dcast',id:'pno3',name:'Part No 3'},
				]
			}
		);
});