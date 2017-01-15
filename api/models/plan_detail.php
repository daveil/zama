<?php
class PlanDetail extends AppModel {
	var $name = 'PlanDetail';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Plan' => array(
			'className' => 'Plan',
			'foreignKey' => 'plan_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
