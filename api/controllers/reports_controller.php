<?php
class ReportsController extends AppController {

	var $name = 'Reports';
	var $uses = array('Report','Kpi','Subcategories');
	function index(){
		$reports = array();
		if($this->RequestHandler->isAjax()||$this->RequestHandler->ext=='json'){
			$report = array('kpi'=>null,'plans'=>array(),'paretos'=>array(),'percentages'=>array(),'totals'=>array());
			$kpi_id =$_GET['kpi_id'];
			$month = $_GET['month'];
			$kpi = $this->Kpi->findById($kpi_id)['Kpi'];
			$report['kpi'] =  array('id'=>$kpi['id'],'name'=>$kpi['name']);
			$report['totals']['plan']=0;
			$report['totals']['paretos']=array();
			$report['totals']['percentages']=array();
			$plan = $this->Report->getPlanTotal($kpi_id,$month)[0];
			$plan['plans'] = $plan['0'];
			$dayDiff = $plan['0']['days_count'];
			$runDate=date_create($plan['plans']['date_from']);
			
			
			for($count=1;$count<=$dayDiff;$count++){
				$pareto_date = $runDate->format('Y-m-d');
				$pareto_index = (int)$runDate->format('d');
				$report['paretos'][$pareto_index]=array();
				$report['plans'][$pareto_index]=$plan['0']['production_plan'];
				$report['totals']['plan'] +=$plan['0']['production_plan'];
				$paretos  = $this->Report->getParetoTotal($kpi_id,$pareto_date);
				
				foreach($paretos as $pareto){
					$subcat_id =$pareto['subcategories']['id'];
					if(!isset($report['totals']['paretos'][$subcat_id]))
						$report['totals']['paretos'][$subcat_id] = 0;
					$report['paretos'][$pareto_index][$subcat_id]= $pareto['0']['pareto_total'];
					$report['totals']['paretos'][$subcat_id]+=$pareto['0']['pareto_total'];
					$prod_plan_perc = $plan['0']['production_plan']?$pareto['0']['pareto_total']/$plan['0']['production_plan']:0;
					$report['percentages'][$pareto_index][$subcat_id]= number_format(round($prod_plan_perc,2)*100,0,'.','').'%';
				}
				
				$runDate->modify('+1 day');
			}
			$conditions = array('Subcategories.kpi_id'=>$kpi_id);
			$subcats = $this->Subcategories->find('list',compact('conditions'));
			foreach($subcats as $subcat_id=>$name){
				$percentage  = $report['totals']['plan']?$report['totals']['paretos'][$subcat_id]/$report['totals']['plan']:0;
				$report['totals']['percentages'][$subcat_id] = number_format(round($percentage,2)*100,0,'.','').'%';;
			}
			$reports = array(array('Report'=>$report));
			
		}
		$this->set(compact('reports'));
		
	}
	
}
	
	