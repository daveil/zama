<?php
/* Kpi Test cases generated on: 2017-01-10 04:13:09 : 1484017989*/
App::import('Model', 'Kpi');

class KpiTestCase extends CakeTestCase {
	var $fixtures = array('app.kpi', 'app.category', 'app.department', 'app.cavity', 'app.line_machine', 'app.part_no', 'app.subcategory');

	function startTest() {
		$this->Kpi =& ClassRegistry::init('Kpi');
	}

	function endTest() {
		unset($this->Kpi);
		ClassRegistry::flush();
	}

}
