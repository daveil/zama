<?php
class LineMachinesController extends AppController {

	var $name = 'LineMachines';

	function index() {
		$this->LineMachine->recursive = 0;
		$this->set('lineMachines', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid line machine', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('lineMachine', $this->LineMachine->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->LineMachine->create();
			if ($this->LineMachine->save($this->data)) {
				$this->Session->setFlash(__('The line machine has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The line machine could not be saved. Please, try again.', true));
			}
		}
		$departments = $this->LineMachine->Department->find('list');
		$this->set(compact('departments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid line machine', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->LineMachine->save($this->data)) {
				$this->Session->setFlash(__('The line machine has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The line machine could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->LineMachine->read(null, $id);
		}
		$departments = $this->LineMachine->Department->find('list');
		$this->set(compact('departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for line machine', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->LineMachine->delete($id)) {
			$this->Session->setFlash(__('Line machine deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Line machine was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
