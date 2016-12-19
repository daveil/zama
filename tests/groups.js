"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Modules',
				},
				data:[
					{id:'admin',name:'Admin'},
					{id:'manager',name:'Manager'},
					{id:'dept-user',name:'Dept User'},
					{id:'sub-user',name:'Sub User'},
				]
			}
		);
});