<?php
/* LineMachines Test cases generated on: 2017-01-10 04:13:25 : 1484018005*/
App::import('Controller', 'LineMachines');

class TestLineMachinesController extends LineMachinesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class LineMachinesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.line_machine', 'app.department', 'app.category', 'app.kpi', 'app.subcategory', 'app.cavity', 'app.part_no');

	function startTest() {
		$this->LineMachines =& new TestLineMachinesController();
		$this->LineMachines->constructClasses();
	}

	function endTest() {
		unset($this->LineMachines);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
