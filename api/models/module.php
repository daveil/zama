<?php
class Module extends AppModel {
	var $name = 'Module';
	var $actsAs = array('Tree');
	var $hasMany = array(
		'Right' => array(
			'className' => 'Right',
			'foreignKey' => 'module_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
