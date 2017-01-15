<?php
class ModelNo extends AppModel {
	var $name = 'ModelNo';
	var $consumableFields = array('department_id','category_id','kpi_id','subcategory_id','line_machine_id','id','name');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'LineMachine' => array(
			'className' => 'LineMachine',
			'foreignKey' => 'line_machine_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
