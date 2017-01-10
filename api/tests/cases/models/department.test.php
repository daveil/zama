<?php
/* Department Test cases generated on: 2017-01-10 04:13:08 : 1484017988*/
App::import('Model', 'Department');

class DepartmentTestCase extends CakeTestCase {
	var $fixtures = array('app.department', 'app.category', 'app.kpi', 'app.cavity', 'app.line_machine', 'app.part_no');

	function startTest() {
		$this->Department =& ClassRegistry::init('Department');
	}

	function endTest() {
		unset($this->Department);
		ClassRegistry::flush();
	}

}
