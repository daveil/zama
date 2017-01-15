<?php
class ParetosController extends AppController {

	var $name = 'Paretos';

	function index() {
		$this->Pareto->recursive = 0;
		$this->set('paretos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid pareto', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pareto', $this->Pareto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Pareto->create();
			if ($this->Pareto->saveAll($this->data)) {
				$this->Session->setFlash(__('The pareto has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pareto could not be saved. Please, try again.', true));
			}
		}
		$lineMachines = $this->Pareto->LineMachine->find('list');
		$this->set(compact('lineMachines'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid pareto', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pareto->save($this->data)) {
				$this->Session->setFlash(__('The pareto has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pareto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pareto->read(null, $id);
		}
		$lineMachines = $this->Pareto->LineMachine->find('list');
		$this->set(compact('lineMachines'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pareto', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pareto->delete($id)) {
			$this->Session->setFlash(__('Pareto deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Pareto was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
