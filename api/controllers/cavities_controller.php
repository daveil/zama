<?php
class CavitiesController extends AppController {

	var $name = 'Cavities';

	function index() {
		$this->Cavity->recursive = 0;
		$this->set('cavities', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid cavity', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('cavity', $this->Cavity->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Cavity->create();
			if ($this->Cavity->save($this->data)) {
				$this->Session->setFlash(__('The cavity has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cavity could not be saved. Please, try again.', true));
			}
		}
		$departments = $this->Cavity->Department->find('list');
		$this->set(compact('departments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid cavity', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cavity->save($this->data)) {
				$this->Session->setFlash(__('The cavity has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The cavity could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cavity->read(null, $id);
		}
		$departments = $this->Cavity->Department->find('list');
		$this->set(compact('departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for cavity', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cavity->delete($id)) {
			$this->Session->setFlash(__('Cavity deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Cavity was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
