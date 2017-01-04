"use strict";
define(['model'],function($model){
	return new $model(
			{
				meta:{
					title: 'Categories',
					limit:'less',
				},
				data:[
					{department_id:'dcast',id:'dcast', name:'Die Casting'},
					{department_id:'machn',id:'bodym', name:'Body Machining'},
					{department_id:'machn',id:'part1', name:'Parts 1 (CNC)'},
					{department_id:'machn',id:'part2', name:'Parts 2 (Secondary Processing)'},
					{department_id:'machn',id:'cover', name:'Cover'},
					{department_id:'assmb',id:'assmb', name:'Assembly'},
					{department_id:'assmb',id:'subas', name:'Sub-Assembly'},
					{department_id:'assmb',id:'eol', name:'EOL'}
				]
			}
		);
});