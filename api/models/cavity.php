<?php
class Cavity extends AppModel {
	var $name = 'Cavity';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_code',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
