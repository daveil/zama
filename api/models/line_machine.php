<?php
class LineMachine extends AppModel {
	var $name = 'LineMachine';
	var $consumableFields = array('department_id','id','name');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
