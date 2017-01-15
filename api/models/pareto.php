<?php
class Pareto extends AppModel {
	var $name = 'Pareto';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'LineMachine' => array(
			'className' => 'LineMachine',
			'foreignKey' => 'line_machine_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ParetoDetail' => array(
			'className' => 'ParetoDetail',
			'foreignKey' => 'pareto_id',
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
