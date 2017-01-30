<?php
class ReportsController extends AppController {

	var $name = 'Reports';
	var $uses = array('Report','Kpi','Subcategories');
	function index(){
		$reports = array();
		if($this->RequestHandler->isAjax()||$this->RequestHandler->ext=='json'||$this->RequestHandler->ext=='xml'){
			
			$type =$_GET['type'];
			$kpi_id =$_GET['kpi_id'];
			$month = $_GET['month'];
			$kpi = $this->Kpi->findById($kpi_id)['Kpi'];
			$KPI =  $kpi['name'];
			$MONTH=date_create($month);
			$MONTH = $MONTH->format('F Y');
			$filename = Inflector::classify($type)." Report $KPI - $MONTH ";
			$this->set(compact('MONTH','type','filename'));
			$this->set('title_for_layout',$filename);
			
			$report = array();
			$report['kpi'] =  array('id'=>$kpi['id'],'name'=>$kpi['name']);
			switch($type){
				case 'pareto':
					$paretoDaily = $pareto =   $this->Report->paretoDaily($kpi_id,$month);
					$report['pareto']=array();
					$report['pareto']['header'] = array_shift($pareto);
					$pareto_parts = array_chunk($pareto,count($pareto)/2);
					$report['pareto']['entry'] =$pareto_parts[0];
					$report['pareto']['percentage'] = $pareto_parts[1];
					$this->set(compact('paretoDaily'));
				break;
				case 'plan':
					$planDaily   = $daily = $this->Report->planDaily($kpi_id,$month);
					$planMonthly = $monthly = $this->Report->planMonthly($kpi_id,$month);
					$dailyTotal = $this->Report->planDailyTotal($kpi_id,$month);
					$monthlyTotal = $this->Report->planMonthlyTotal($kpi_id,$month);
					$report['plan']=array('daily'=>array(),'monthly'=>array());
					$report['plan']['daily']['header'] = array_shift($planDaily);
					$report['plan']['daily']['entry'] = $planDaily;
					$report['plan']['daily']['total'] = $dailyTotal;
					$report['plan']['monthly']['header'] = array_shift($planMonthly);
					$report['plan']['monthly']['entry'] = $planMonthly;
					$report['plan']['monthly']['total'] = $monthlyTotal;
					$this->set(compact('daily','monthly','dailyTotal','monthlyTotal'));
				break;
			}
			
			$reports = array(array('Report'=>$report));
			
		}
		$this->set(compact('reports'));
		
		
		
	}
	function export($kpi_id,$month){
		$daily = $this->Report->planDaily($kpi_id,$month);
		$monthly = $this->Report->planMonthly($kpi_id,$month);
		$dailyTotal = $this->Report->planDailyTotal($kpi_id,$month);
		$monthlyTotal = $this->Report->planMonthlyTotal($kpi_id,$month);
		$paretoDaily = $this->Report->paretoDaily($kpi_id,$month);
		$kpi = $this->Kpi->findById($kpi_id)['Kpi'];
		$KPI =  $kpi['name'];
		$MONTH=date_create($month);
		$MONTH = $MONTH->format('F Y');
		$filename = "Plan Report $KPI - $MONTH ";
		$this->set(compact('MONTH','filename','daily','monthly','dailyTotal','monthlyTotal'));
	}
	function oldCode(){
		$conditions = array('Subcategories.kpi_id'=>$kpi_id);
			$order = array('Subcategories.index_order');
			$subcats =  $this->Subcategories->find('all',compact('conditions','order'));
			$report['kpi'] =  array('id'=>$kpi['id'],'name'=>$kpi['name']);
			$report['subcategories'] =  array();
			foreach($subcats as $subcat){
				array_push($report['subcategories'],$subcat['Subcategories']);
			}
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
			if($this->RequestHandler->ext=='xml'){
				$columns = array_keys($report['plans']);
				array_push($columns,'Total');
				$buffer = array();
				foreach($columns as $col)
					array_push($buffer,0);
				array_push($buffer,0);
				$buffer[0]=null;
				$rows = array();
				$rows[0] = array_merge(array($report['kpi']['name']),$columns);
				$columns = $rows[0];
				$rows[1] = array_merge(array('Production Plan (100%)'),$report['plans'],array($report['totals']['plan']));
				$subcategories =array(
					'pareto'=>array(),
					'percentage'=>array(),
				);
				
				foreach($report['subcategories'] as $subcat){
					$subcat_id = $subcat['id'];
					$subcat_name = $subcat['name'];
					$subcategories['pareto'][$subcat_id] = $buffer;
					$subcategories['percentage'][$subcat_id] = $buffer;
					
					$subcategories['pareto'][$subcat_id][0] = $subcat_name;
					$subcategories['percentage'][$subcat_id][0] = $subcat_name;
					
					$index = array_search('Total',$columns);
					$pareto_total =  $report['totals']['paretos'][$subcat_id];
					$subcategories['pareto'][$subcat_id][$index] = $pareto_total;
					$percentage_total =  $report['totals']['percentages'][$subcat_id];
					$subcategories['percentage'][$subcat_id][$index] = $percentage_total;
					
				}
				foreach($report['paretos'] as $date=>$pareto){
					foreach($pareto as $subcat_id=>$total){
						$index = array_search($date,$columns);
						$subcategories['pareto'][$subcat_id][$index] = $total;
					}
				}
				foreach($report['percentages'] as $date=>$percentage){
					foreach($percentage as $subcat_id=>$percent){
						$index = array_search($date,$columns);
						$subcategories['percentage'][$subcat_id][$index] = $percent;
					}
				}
				$pareto_rows = array();
				$percent_rows = array();
				foreach($report['subcategories'] as $subcat){
					$subcat_id = $subcat['id'];
					array_push($pareto_rows,$subcategories['pareto'][$subcat_id]);
					array_push($percent_rows,$subcategories['percentage'][$subcat_id]);
				}
				$rows = array_merge($rows,$pareto_rows,$percent_rows);
				$KPI =  $report['kpi']['name'];
				$MONTH=date_create($month);
				$MONTH = $MONTH->format('F Y');
				$this->set('title_for_layout',"Pareto Report $KPI - $MONTH ");
				$reports = $this->Report->generateFile('xml',$rows);
			}
	}
}
	
	