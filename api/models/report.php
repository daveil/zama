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

}

	