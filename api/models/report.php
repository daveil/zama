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
			$xml_str = '<?xml version="1.0"?><ss:Workbook xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet">';
			$xml_str .='<ss:Worksheet ss:Name="Sheet1">';
			$xml_str .= '<ss:Table>';
				$rows = array();
				foreach($data as $i=>$cells){
					$xml_str .= '<ss:Row>';
					foreach($cells as $j=>$data){
						$xml_str .= '<ss:Cell>';
						$type = is_numeric($data)?'Number':'String';
						$xml_str .= '<ss:Data ss:Type="'.$type.'">'.$data.'</ss:Data>';
						$xml_str .='</ss:Cell>';
					}
					$xml_str .= '</ss:Row>';
				}
				
			
			$xml_str .= '</ss:Table>';
			$xml_str .= '</ss:Worksheet>';
			$xml_str .= '</ss:Workbook>';
			$xml_data = new SimpleXMLElement($xml_str);
			return $xml_data->asXML();
			break;
		}
	}
}

	