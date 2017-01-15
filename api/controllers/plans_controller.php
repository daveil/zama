<?php
class PlansController extends AppController {

	var $name = 'Plans';

	function index() {
		$this->Plan->recursive = 0;
		$this->set('plans', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid plan', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('plan', $this->Plan->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Plan->create();
			if ($this->Plan->save($this->data)) {
				$this->Session->setFlash(__('The plan has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plan could not be saved. Please, try again.', true));
			}
		}
		$lineMachines = $this->Plan->LineMachine->find('list');
		$this->set(compact('lineMachines'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid plan', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Plan->save($this->data)) {
				$this->Session->setFlash(__('The plan has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plan could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Plan->read(null, $id);
		}
		$lineMachines = $this->Plan->LineMachine->find('list');
		$this->set(compact('lineMachines'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for plan', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Plan->delete($id)) {
			$this->Session->setFlash(__('Plan deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Plan was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
