<?php
class Kpi extends AppModel {
	var $name = 'Kpi';
	var $primaryKey = 'code';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_code',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Subcategory' => array(
			'className' => 'Subcategory',
			'foreignKey' => 'kpi_code',
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
