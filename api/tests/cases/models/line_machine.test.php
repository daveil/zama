<?php
/* LineMachine Test cases generated on: 2017-01-10 04:13:10 : 1484017990*/
App::import('Model', 'LineMachine');

class LineMachineTestCase extends CakeTestCase {
	var $fixtures = array('app.line_machine', 'app.department', 'app.category', 'app.kpi', 'app.subcategory', 'app.cavity', 'app.part_no');

	function startTest() {
		$this->LineMachine =& ClassRegistry::init('LineMachine');
	}

	function endTest() {
		unset($this->LineMachine);
		ClassRegistry::flush();
	}

}
