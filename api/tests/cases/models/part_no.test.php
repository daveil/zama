<?php
/* PartNo Test cases generated on: 2017-01-10 04:13:11 : 1484017991*/
App::import('Model', 'PartNo');

class PartNoTestCase extends CakeTestCase {
	var $fixtures = array('app.part_no', 'app.department', 'app.category', 'app.kpi', 'app.subcategory', 'app.cavity', 'app.line_machine');

	function startTest() {
		$this->PartNo =& ClassRegistry::init('PartNo');
	}

	function endTest() {
		unset($this->PartNo);
		ClassRegistry::flush();
	}

}
