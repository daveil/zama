<?php
/* Cavity Test cases generated on: 2017-01-10 04:13:07 : 1484017987*/
App::import('Model', 'Cavity');

class CavityTestCase extends CakeTestCase {
	var $fixtures = array('app.cavity', 'app.department');

	function startTest() {
		$this->Cavity =& ClassRegistry::init('Cavity');
	}

	function endTest() {
		unset($this->Cavity);
		ClassRegistry::flush();
	}

}
