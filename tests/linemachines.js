"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Line Machines',
				},
				data:[
					{id:'lnm1',deparment:'Dept 1',category:'Cat 1',subcategory:'Sub 1',name:'Line Machine 1'},
					{id:'lnm2',deparment:'Dept 1',category:'Cat 1',subcategory:'Sub 1',name:'Line Machine 2'},
					{id:'lnm3',deparment:'Dept 1',category:'Cat 1',subcategory:'Sub 1',name:'Line Machine 3'},
				]
			}
		);
});