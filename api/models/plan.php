<?php
class Plan extends AppModel {
	var $name = 'Plan';
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
		'PlanDetail' => array(
			'className' => 'PlanDetail',
			'foreignKey' => 'plan_id',
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
	function beforeSave(){
		$dateFrom=date_create($this->data['Plan']['date_from']);
		$dateTo=date_create( $this->data['Plan']['date_to']);
		$dateDiff=date_diff($dateFrom,$dateTo);
		echo $dateDiff;
	}
}
