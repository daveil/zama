<?php
class Subcategory extends AppModel {
	var $name = 'Subcategory';
	var $order = 'Subcategory.index_order';
	var $consumableFields = array('department_id','category_id','kpi_id','id','name');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Kpi' => array(
			'className' => 'Kpi',
			'foreignKey' => 'kpi_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
