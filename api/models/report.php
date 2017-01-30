<?php
class Report extends AppModel {
	var $name = 'Report';
	var $useTable = false;
	
	function getParetoTotal($kpi,$filter_date){
		$query = "SELECT 
				  CASE 
					WHEN `paretos`.`pareto_date`  IS NULL 
					THEN '$filter_date'
					ELSE  `paretos`.`pareto_date` 
				  END AS target_delivery,
				  `subcategories`.`id`,
				  `subcategories`.`name`,
				CASE WHEN `pareto_details`.`quantity` IS NULL THEN 0 ELSE SUM(`pareto_details`.`quantity`) END  
				   AS pareto_total
				FROM
				  `subcategories` 
				  LEFT JOIN `line_machines` 
					ON (
					  `line_machines`.`subcategory_id` = `subcategories`.`id`
					  AND 
					  `line_machines`.`kpi_id` = '$kpi'
					) 
				  LEFT JOIN `paretos` 
					ON (
					  `line_machines`.`id` = `paretos`.`line_machine_id`
					) 
				  LEFT JOIN `pareto_details` 
					ON (
					  `paretos`.`id` = `pareto_details`.`pareto_id`
					) 
				WHERE (
					`paretos`.`pareto_date` = '$filter_date'
					OR `paretos`.`pareto_date` IS NULL
				  ) 
				GROUP BY `subcategories`.`id` 
				ORDER BY subcategories.`index_order`";
		return $this->query($query);
	}

	function getPlanTotal($kpi,$month_filter){
			$time = strtotime($month_filter);
			$year =(int)date('Y',$time);
			$month =(int)date('m',$time);
			$first_dom =date('Y-m-01',$time);
			$last_dom =date('Y-m-t',$time);
			$dateFrom=date_create($first_dom);
			$dateTo=date_create( $last_dom);
			$dateDiff=date_diff($dateFrom,$dateTo);
			$dayDiff = $dateDiff->days+1;
		$query = "SELECT
				   CASE WHEN  `plans`.`production_plan` IS NULL THEN 0 ELSE
				   SUM( `plans`.`production_plan`) END AS production_plan
					, `kpis`.`name`
					, `line_machines`.`name`
					,CASE WHEN  `plans`.`production_plan` IS NULL THEN '$first_dom' ELSE 
					plans.`date_from` END as `date_from`
					,CASE WHEN  `plans`.`production_plan` IS NULL THEN '$last_dom' ELSE 
					plans.`date_to` END as `date_to`
					, CASE WHEN  `plans`.`production_plan` IS NULL THEN '$dayDiff' ELSE
					DATEDIFF(plans.`date_to`,plans.`date_from`)+1 END AS days_count
				FROM
					`line_machines`
					LEFT JOIN `kpis` 
						ON (`line_machines`.`kpi_id` = `kpis`.`id`)
					LEFT JOIN `plans`
						ON (`plans`.`line_machine_id` = `line_machines`.`id`)
					
						WHERE `kpis`.id='$kpi'
						AND ( YEAR(plans.`date_from`) = $year 
						AND MONTH(plans.`date_from`) = $month ) OR plans.`date_from` IS NULL
						";
		return $this->query($query);
	}
	
	function generateFile($format,$data){
		switch($format){
			case 'xml':
			$xml_str = '';
				$rows = array();
				foreach($data as $i=>$cells){
					$style = $i==0?'ss:StyleID="MonthRow"':'';
					$xml_str .= '<ss:Row '.$style.'>';
					foreach($cells as $j=>$data){
						$xml_str .= '<ss:Cell>';
						$type = is_numeric($data)?'Number':'String';
						$xml_str .= '<ss:Data ss:Type="'.$type.'">'.$data.'</ss:Data>';
						$xml_str .='</ss:Cell>';
					}
					$xml_str .= '</ss:Row>';
				}
			return $xml_str;
			break;
		}
	}
	
	function planMonthly($kpi,$month_filter){
		$time = strtotime($month_filter);
		$year =(int)date('Y',$time);
		$month =(int)date('m',$time);
		$query = "SELECT 
			  `line_machines`.`name`,
			  `model_nos`.`name`,
			  `plan_details`.`work_hour`,
			  `plan_details`.`cycle_time`,
			  `plan_details`.`target_efficiency`,
			  `plan_details`.`shift_no`,
			  CONCAT(
				CASE
				  WHEN NOT `plans`.`shift_day` IS NULL 
				  THEN 'D' 
				  ELSE '' 
				END,
				CASE
				  WHEN NOT `plans`.`shift_night` IS NULL 
				  THEN 'N' 
				  ELSE '' 
				END
			  ) AS shift_type,
			  plans.production_plan AS total_daily,
			  COUNT(plan_details.id) AS total_days,
			  plans.production_plan * COUNT(plan_details.id) AS total_monthly 
			FROM
			  `line_machines` 
			  INNER JOIN `plans` 
				ON (
				  `line_machines`.`id` = `plans`.`line_machine_id`
				) 
			  INNER JOIN `model_nos` 
				ON (
				  `model_nos`.`id` = `plans`.`model_id`
				) 
			  INNER JOIN `plan_details` 
				ON (
				  `plans`.`id` = `plan_details`.`plan_id`
				) 
				WHERE 
				 model_nos.kpi_id = '$kpi'
				 AND YEAR(plan_details.`target_delivery`) = $year 
				 AND MONTH(plan_details.`target_delivery`) = $month 
			GROUP BY `model_nos`.`id` 
			ORDER BY `model_nos`.id ";
			$monthly =$this->query($query);
			$planMonthly = array();
			$header = explode('|',"Line|Models|Work Hour|Cycle Time|Target Eff|ShiftNo|Shift Type|Total Daily|Total Days |Total Monthly");
			array_push($planMonthly,$header);
			
			foreach($monthly as $item){
				$model =  array();
				$model[] = $item['line_machines']['name'];
				$model[] = $item['model_nos']['name'];
				$model[] = $item['plan_details']['work_hour'];
				$model[] = $item['plan_details']['cycle_time'];
				$model[] = $item['plan_details']['target_efficiency'];
				$model[] = $item['plan_details']['shift_no'];
				$model[] = $item['0']['shift_type'];
				$model[] = $item['0']['total_days'];
				$model[] = $item['plans']['total_daily'];
				$model[] = $item['0']['total_monthly'];
				array_push($planMonthly,$model);
				
			}
			return $planMonthly;
	}
	function planDaily($kpi,$month_filter){
		$time = strtotime($month_filter);
		$year =(int)date('Y',$time);
		$month =(int)date('m',$time);
		$first_dom =date('Y-m-01',$time);
		$calendar_query = "(
				SELECT LAST_DAY('$first_dom') - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS `date`
				FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
				CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
				CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
			) as calendar 
			WHERE calendar.Date BETWEEN '$first_dom' AND LAST_DAY('$first_dom') ORDER BY calendar.date";
			
		$daily ="SELECT `date`, line_name, line_id,date_line_model.model_id, `name`, plans.`production_plan` FROM (SELECT `date`,line_machines.name AS line_name ,  model_nos.`line_machine_id` AS line_id, model_nos.id AS model_id, model_nos.name FROM (SELECT calendar.date  AS `date`
			FROM 
				$calendar_query )
			AS dates, 
			model_nos INNER JOIN line_machines ON (model_nos.`line_machine_id` =  line_machines.id)
			WHERE  model_nos.kpi_id = '$kpi'
			 ) AS date_line_model 
			 LEFT JOIN plans  ON (date_line_model.model_id = plans.`model_id` AND `date` BETWEEN date_from AND date_to)
			 ORDER BY date_line_model.`date`, date_line_model.line_id, date_line_model.model_id";
		
		$calendar = $this->query("SELECT * FROM $calendar_query ");
		$dailies = $this->query($daily);
		$days = array();
		$lines = array();
		$models = array();
		
		foreach($calendar as $day){
			$days[$day['calendar']['date']] =array();
		}
		foreach($dailies as $entry){
			$date= $entry['date_line_model']['date'];
			array_push($days[$date],$entry);
		}
		foreach($days[$first_dom] as $col){
			array_push($lines,$col['date_line_model']['line_name']);
			array_push($models,$col['date_line_model']['name']);
		}
		$planDaily = array();
		$header = explode('|',"Line|Model");
		foreach($days as $date=>$day){
			array_push($header,date('d-M',strtotime($date)));
		}
		array_push($planDaily,$header);
		foreach($models as $index=>$model){
			$row = array($lines[$index],$model);
			foreach($days as $day){
				array_push($row,$day[$index]['plans']['production_plan']);
				
			}
			array_push($planDaily,$row);
		}
		
		return $planDaily;
	}
	function planMonthlyTotal($kpi,$month_filter){
		$time = strtotime($month_filter);
		$year =(int)date('Y',$time);
		$month =(int)date('m',$time);
		$query = "
			SELECT SUM(total_monthly) AS total_production_plan FROM (
			SELECT 
			  plans.production_plan * COUNT(plan_details.id) AS total_monthly 
			FROM
			 `plans` 
			  LEFT JOIN `model_nos` 
				ON (
				  `model_nos`.`id` = `plans`.`model_id`
				) 
			  LEFT JOIN `plan_details` 
				ON (
				  `plans`.`id` = `plan_details`.`plan_id`
				) 
				WHERE 
				 (model_nos.kpi_id = '$kpi' OR model_nos.kpi_id IS NULL)
				 AND YEAR(plan_details.`target_delivery`) = $year 
				 AND MONTH(plan_details.`target_delivery`) = $month 
			GROUP BY `model_nos`.`id` 
			ORDER BY `model_nos`.id ) AS production_plan";
			$monthly =$this->query($query);
			$planMonthlyTotal = $monthly[0]['0']['total_production_plan'];
			return $planMonthlyTotal;
	}
	
	function planDailyTotal($kpi,$month_filter){
		$time = strtotime($month_filter);
		$year =(int)date('Y',$time);
		$month =(int)date('m',$time);
		$first_dom =date('Y-m-01',$time);
		$query = "SELECT month_date,
				CASE WHEN production_plan IS NULL THEN 0 ELSE
				 SUM(production_plan) END AS total_daily_plan
					FROM (SELECT 
				  month_date,
				  line_machines.name AS line_name,
				  model_nos.name AS model_name,
				  model_nos.id,
				  plans.production_plan 
				FROM
				  (SELECT 
					a.Date AS month_date 
				  FROM
					(SELECT 
					  LAST_DAY('$first_dom') - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS DATE 
					FROM
					  (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
					CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
					CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c) a 
				 WHERE a.Date BETWEEN '$first_dom' AND LAST_DAY('$first_dom') 
				  ORDER BY a.Date) AS month_days 
				  LEFT JOIN plan_details 
					ON (
					  plan_details.`target_delivery` = month_days.month_date
					) 
				   
				  LEFT JOIN plans 
					ON (plans.id = plan_details.plan_id) 
					LEFT JOIN  model_nos
					ON (model_nos.id = plans.`model_id`)
				  LEFT JOIN line_machines 
					ON (
					  line_machines.id = plans.`line_machine_id`
					) 
					WHERE (model_nos.kpi_id = '$kpi' OR model_nos.kpi_id IS NULL)
				ORDER BY month_date, line_machines.id, model_nos.id) AS daily_plan GROUP BY month_date";
		$totals=   $this->query($query);
		$planDailyTotal = array();
		foreach($totals as $total){
			array_push($planDailyTotal, $total['0']['total_daily_plan']);
		}
		return $planDailyTotal;
	}
	
	function paretoDaily($kpi,$month_filter){
		$time = strtotime($month_filter);
		$year =(int)date('Y',$time);
		$month =(int)date('m',$time);
		$first_dom =date('Y-m-01',$time);
		$query = "SELECT `date`,name, subcategory_id, CASE WHEN quantity IS NULL THEN  0 ELSE  SUM(quantity) END AS total_pareto FROM 
					(
					SELECT`date`,name,subcategory_id,model_id, quantity FROM 
					(SELECT `date`,subcategories.name AS name, subcategories.id AS subcategory_id, model_nos.`line_machine_id` AS line_id, model_nos.id AS model_id, subcategories.index_order
					FROM 
					subcategories  LEFT JOIN model_nos ON (
					`subcategories`.`kpi_id` = '$kpi'  AND 
					model_nos.subcategory_id = subcategories.id
					),
					(
						SELECT LAST_DAY('$first_dom') - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS `date`
						FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
						CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
						CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
					  ) calendar WHERE DATE BETWEEN '$first_dom'  AND LAST_DAY('$first_dom') ORDER BY DATE, index_order
					  ) AS daily_models 
					LEFT JOIN paretos
					ON (paretos.`pareto_date` =  `date` AND paretos.`line_machine_id` = line_id)
					LEFT JOIN pareto_details
					ON (pareto_details.`model_no_id` =  model_id AND pareto_details.`pareto_id` =  paretos.id)

					  ORDER BY `date`,index_order, model_id
					   ) AS dtl GROUP BY `date`, `subcategory_id`";
		$calendar_query = "(
				SELECT LAST_DAY('$first_dom') - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS `date`
				FROM (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
				CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
				CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
			) as calendar 
			WHERE calendar.Date BETWEEN '$first_dom' AND LAST_DAY('$first_dom') ORDER BY calendar.date";
		$calendar = $this->query("SELECT * FROM $calendar_query ");
		$dailies =  $this->query($query);
		$paretoDaily = array();
		
		$days = array();
		$subcats = array();
		$header = explode('|',"KPI");
		
		foreach($calendar as $day){
			$days[$day['calendar']['date']] =array();
		}
		
		foreach($days as $date=>$day){
			array_push($header,date('d',strtotime($date)));
		}
		array_push($header,'Total');
		array_push($paretoDaily,$header);
		
		$production_plan = $this->planDailyTotal($kpi,$month_filter);
		$total_production_plan = 0;
		foreach($production_plan as  $pp){
			$total_production_plan+=$pp;
		}
		array_push($production_plan,$total_production_plan);
		
		$plan = array_merge(array('Production Plan (100%)'),$production_plan);
		array_push($paretoDaily,$plan);
		
		foreach($dailies as $entry){
			$date= $entry['dtl']['date'];
			array_push($days[$date],$entry);
		}
		foreach($days[$first_dom] as $col){
			array_push($subcats,$col['dtl']['name']);
		}
		
		foreach($subcats as $index=>$subcat){
			$row = array($subcat);
			$line_total = 0;
			foreach($days as $day){
				$total_pareto = $day[$index]['0']['total_pareto'];
				$line_total+=$total_pareto;
				array_push($row,$total_pareto);
			}
			array_push($row,$line_total);
			array_push($paretoDaily,$row);
		}
		
		foreach($paretoDaily as $line=>$pareto){
			
			if($line>0){
				$row=array();
				foreach($pareto as $index=>$item){
					if($index==0){
						array_push($row,$item);
					}else if($index==count($pareto)-1){
						$percentage = $item/$total_production_plan;
						$percentage = round($percentage*100,0);
						array_push($row,$percentage.'%');
					}else{
						$plan = $production_plan[$index-1];
						$percentage=$plan?($item/$plan):0;
						$percentage = round($percentage*100,0);
						array_push($row,$percentage.'%');
					}
				}
				array_push($paretoDaily,$row);
			}
		}
		return $paretoDaily;
	}
}

	