<?php
/* PartNos Test cases generated on: 2017-01-10 04:13:25 : 1484018005*/
App::import('Controller', 'PartNos');

class TestPartNosController extends PartNosController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PartNosControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.part_no', 'app.department', 'app.category', 'app.kpi', 'app.subcategory', 'app.cavity', 'app.line_machine');

	function startTest() {
		$this->PartNos =& new TestPartNosController();
		$this->PartNos->constructClasses();
	}

	function endTest() {
		unset($this->PartNos);
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
