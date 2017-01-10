"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Cavities',
				},
				data:[
					{department_id:'dcast',id:'cav1',name:'Cavity 1'},
					{department_id:'dcast',id:'cav2',name:'Cavity 2'},
					{department_id:'dcast',id:'cav3',name:'Cavity 3'},
				]
			}
		);
});