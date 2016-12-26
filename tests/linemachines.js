"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Line Machines',
				},
				data:[
					{id:'lnm1',name:'Line Machine 1'},
					{id:'lnm2',name:'Line Machine 2'},
					{id:'lnm3',name:'Line Machine 3'},
				]
			}
		);
});