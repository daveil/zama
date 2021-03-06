<?php
class Kpi extends AppModel {
	var $name = 'Kpi';
	var $order = 'Kpi.index_order';
	var $consumableFields = array('department_id','category_id','id','name');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Subcategory' => array(
			'className' => 'Subcategory',
			'foreignKey' => 'kpi_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
