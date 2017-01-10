<?php
/* Subcategories Test cases generated on: 2017-01-10 04:13:25 : 1484018005*/
App::import('Controller', 'Subcategories');

class TestSubcategoriesController extends SubcategoriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SubcategoriesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.subcategory', 'app.kpi', 'app.category', 'app.department', 'app.cavity', 'app.line_machine', 'app.part_no');

	function startTest() {
		$this->Subcategories =& new TestSubcategoriesController();
		$this->Subcategories->constructClasses();
	}

	function endTest() {
		unset($this->Subcategories);
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
