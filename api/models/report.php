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

	function getPlanTotal($kpi){
		$query = "SELECT
				   SUM( `plans`.`production_plan`) AS production_plan
					, `kpis`.`name`
					, `line_machines`.`name`
					, plans.`date_from`
					, plans.`date_to`
					, DATEDIFF(plans.`date_to`,plans.`date_from`)+1 AS days_count
				FROM
					`plans`
					INNER JOIN `line_machines` 
						ON (`plans`.`line_machine_id` = `line_machines`.`id`)
					INNER JOIN `kpis` 
						ON (`line_machines`.`kpi_id` = `kpis`.`id`)
						WHERE `kpis`.id='$kpi'";
				
		return $this->query($query);
	}

	}

	