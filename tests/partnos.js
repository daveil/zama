"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Part No',
				},
				data:[
					{id:'pno1',deparment:'Dept 1',category:'Cat 1',subcategory:'Sub 1',linemachine:'Line 1',name:'Part No 1'},
					{id:'pno2',deparment:'Dept 1',category:'Cat 1',subcategory:'Sub 1',linemachine:'Line 1',name:'Part No 2'},
					{id:'pno3',deparment:'Dept 1',category:'Cat 1',subcategory:'Sub 1',linemachine:'Line 1',name:'Part No 3'},
				]
			}
		);
});