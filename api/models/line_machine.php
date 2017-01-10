<?php
class LineMachine extends AppModel {
	var $name = 'LineMachine';
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
