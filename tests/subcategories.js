"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Sub-categories',
					limit:'less'
				},
				data:[
					{department_id:'dcast',category_id:'dcast',kpi_id:'mceff1',id:'mord1',name:'Model Related Downtime'},
					{department_id:'dcast',category_id:'dcast',kpi_id:'mceff1',id:'mard1',name:'Machine Related Downtime'},
					{department_id:'dcast',category_id:'dcast',kpi_id:'mceff1',id:'furd1',name:'Furnace Related Downtime'},
					{department_id:'dcast',category_id:'dcast',kpi_id:'mceff1',id:'dich1',name:'Die Change'},
					{department_id:'dcast',category_id:'dcast',kpi_id:'mceff1',id:'scrp1',name:'Scrap'},
					{department_id:'dcast',category_id:'dcast',kpi_id:'mceff1',id:'uncp1',name:'Unplanned Capacity'},
					{department_id:'dcast',category_id:'dcast',kpi_id:'mceff1',id:'unid1',name:'Unidentified'},
					{department_id:'dcast',category_id:'dcast',kpi_id:'mceff1',id:'pttl1',name:'Production Total'},
				]
			}
		);
});