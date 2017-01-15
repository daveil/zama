<?php
class LineMachine extends AppModel {
	var $name = 'LineMachine';
	var $consumableFields = array('department_id','category_id','kpi_id','subcategory_id','id','name');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Subcategory' => array(
			'className' => 'Subcategory',
			'foreignKey' => 'subcategory_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
