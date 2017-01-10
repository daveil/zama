<?php
/* Kpis Test cases generated on: 2017-01-10 04:13:25 : 1484018005*/
App::import('Controller', 'Kpis');

class TestKpisController extends KpisController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class KpisControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.kpi', 'app.category', 'app.department', 'app.cavity', 'app.line_machine', 'app.part_no', 'app.subcategory');

	function startTest() {
		$this->Kpis =& new TestKpisController();
		$this->Kpis->constructClasses();
	}

	function endTest() {
		unset($this->Kpis);
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
