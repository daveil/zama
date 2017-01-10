<?php
/* Subcategory Test cases generated on: 2017-01-10 04:13:11 : 1484017991*/
App::import('Model', 'Subcategory');

class SubcategoryTestCase extends CakeTestCase {
	var $fixtures = array('app.subcategory', 'app.kpi', 'app.category', 'app.department', 'app.cavity', 'app.line_machine', 'app.part_no');

	function startTest() {
		$this->Subcategory =& ClassRegistry::init('Subcategory');
	}

	function endTest() {
		unset($this->Subcategory);
		ClassRegistry::flush();
	}

}
