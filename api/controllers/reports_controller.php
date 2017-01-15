<?php
class ReportsController extends AppController {

	var $name = 'Reports';
	
	function index(){
		$kpi_id ='meff';
		$plan = $this->Report->getPlanTotal($kpi_id)[0];
		$dayDiff = 4;//$plans['0']['days_count'];
		$runDate=date_create($plan['plans']['date_from']);
		$report = array('plans'=>array(),'paretos'=>array());
		
		for($count=1;$count<=$dayDiff;$count++){
			$pareto_date = $runDate->format('Y-m-d');
			$report['paretos'][$pareto_date]=array();
			$report['plans'][$pareto_date]=$plan['0']['production_plan'];
			$paretos  = $this->Report->getParetoTotal($kpi_id,$pareto_date);
			
			foreach($paretos as $pareto){
				$item = array($pareto['subcategories']['id']=>$pareto['0']['pareto_total']);
				array_push($report['paretos'][$pareto_date],$item);
			}
			
			$runDate->modify('+1 day');
		}
		$reports = array(array('Report'=>$report));
		
		$this->set(compact('reports'));
		
	}
	
}
	
	