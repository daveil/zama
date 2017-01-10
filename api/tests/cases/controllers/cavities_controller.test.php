<?php
/* Cavities Test cases generated on: 2017-01-10 04:13:24 : 1484018004*/
App::import('Controller', 'Cavities');

class TestCavitiesController extends CavitiesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class CavitiesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.cavity', 'app.department', 'app.category', 'app.kpi', 'app.subcategory', 'app.line_machine', 'app.part_no');

	function startTest() {
		$this->Cavities =& new TestCavitiesController();
		$this->Cavities->constructClasses();
	}

	function endTest() {
		unset($this->Cavities);
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
