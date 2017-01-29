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
			  `plans`.`shift_night`,
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
			GROUP BY `model_nos`.`name` 
			ORDER BY `model_nos`.id ";
			return $this->query($query);
	}
}

	