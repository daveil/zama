<?php
class User extends AppModel {
	var $name = 'User';
	var $consumableFields = array('id','name');
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
