<?php
class Subcategory extends AppModel {
	var $name = 'Subcategory';
	var $primaryKey = 'code';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Kpi' => array(
			'className' => 'Kpi',
			'foreignKey' => 'kpi_code',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
