"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Cavities',
				},
				data:[
					{id:'cav1',name:'Cavity 1'},
					{id:'cav2',name:'Cavity 2'},
					{id:'cav3',name:'Cavity 3'},
				]
			}
		);
});