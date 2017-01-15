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
	public function buildDetail($plan){
		$dateFrom=date_create($plan['date_from']);
		$dateTo=date_create( $plan['date_to']);
		$dateDiff=date_diff($dateFrom,$dateTo);
		$dayDiff = $dateDiff->days+1;
		$details = array();
		for($runDate = $dateFrom,$count=1;$count<=$dayDiff;$count++){
			$detail = array(
				'target_delivery' =>$runDate->format('Y-m-d'),
				'work_hour' =>$plan['work_hour'],
				'cycle_time' =>$plan['cycle_time'],
				'target_efficiency' =>$plan['target_efficiency'],
				'shift_no' =>$plan['shift_no'],
			);
			array_push($details,$detail);
			$runDate->modify('+1 day');
		}
		
		return $details;
	}
}
