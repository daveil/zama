"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Part No',
				},
				data:[
					{id:'pno1',name:'Part No 1'},
					{id:'pno2',name:'Part No 2'},
					{id:'pno3',name:'Part No 3'},
				]
			}
		);
});