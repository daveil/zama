<?php
class ParetoDetail extends AppModel {
	var $name = 'ParetoDetail';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Pareto' => array(
			'className' => 'Pareto',
			'foreignKey' => 'pareto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ModelNo' => array(
			'className' => 'ModelNo',
			'foreignKey' => 'model_no_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
