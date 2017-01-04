"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'KPI',
					limit:'less'
				},
				data:[
					{department_id:'dcast',category_id:'dcast',id:'mceff1',name:'Machine Efficiency'},
					{department_id:'dcast',category_id:'dcast',id:'sbody1',name:'Scrap Body'},
					{department_id:'dcast',category_id:'dcast',id:'scover1',name:'Scrap Cover'},
					{department_id:'dcast',category_id:'dcast',id:'dsbdy1',name:'Delivery SAP Body'},
					{department_id:'dcast',category_id:'bodym',id:'mceff2',name:'Machine Efficiency'},
					{department_id:'dcast',category_id:'bodym',id:'sbody2',name:'Scrap Body'},
					{department_id:'dcast',category_id:'bodym',id:'dsbdy2',name:'Delivery SAP Body'},
					{department_id:'dcast',category_id:'part1',id:'mceff3',name:'Machine Efficiency'},
					{department_id:'dcast',category_id:'part1',id:'sbody3',name:'Scrap Body'},
					{department_id:'dcast',category_id:'part1',id:'dsbdy3',name:'Delivery SAP Body'},
					{department_id:'dcast',category_id:'part2',id:'mceff4',name:'Machine Efficiency'},
					{department_id:'dcast',category_id:'part2',id:'sbody4',name:'Scrap Body'},
					{department_id:'dcast',category_id:'part2',id:'dsbdy4',name:'Delivery SAP Body'},
					{department_id:'dcast',category_id:'cover',id:'mceff5',name:'Machine Efficiency'},
					{department_id:'dcast',category_id:'cover',id:'sbody5',name:'Scrap Body'},
					{department_id:'dcast',category_id:'cover',id:'dsbdy5',name:'Delivery SAP Body'},
					{department_id:'dcast',category_id:'clean',id:'mceff6',name:'Machine Efficiency'},
					{department_id:'dcast',category_id:'clean',id:'sbody6',name:'Scrap Body'},
					{department_id:'dcast',category_id:'clean',id:'dsbdy6',name:'Delivery SAP Body'},
					{department_id:'assmb',category_id:'assmb',id:'mceff7',name:'Machine Efficiency'},
					{department_id:'assmb',category_id:'assmb',id:'rwork7',name:'Rework'},
					{department_id:'assmb',category_id:'assmb',id:'sbody7',name:'Scrap Body'},
					{department_id:'assmb',category_id:'assmb',id:'dsbdy7',name:'Delivery SAP Body'},
					{department_id:'assmb',category_id:'subas',id:'mceff8',name:'Machine Efficiency'},
					{department_id:'assmb',category_id:'subas',id:'sbody8',name:'Scrap Body'},
					{department_id:'assmb',category_id:'subas',id:'dsbdy8',name:'Delivery SAP Body'},
				]
			}
		);
});