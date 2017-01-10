<?php
class KpisController extends AppController {

	var $name = 'Kpis';

	function index() {
		$this->Kpi->recursive = 0;
		$this->set('kpis', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid kpi', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('kpi', $this->Kpi->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Kpi->create();
			if ($this->Kpi->save($this->data)) {
				$this->Session->setFlash(__('The kpi has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The kpi could not be saved. Please, try again.', true));
			}
		}
		$categories = $this->Kpi->Category->find('list');
		$this->set(compact('categories'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid kpi', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Kpi->save($this->data)) {
				$this->Session->setFlash(__('The kpi has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The kpi could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Kpi->read(null, $id);
		}
		$categories = $this->Kpi->Category->find('list');
		$this->set(compact('categories'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for kpi', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Kpi->delete($id)) {
			$this->Session->setFlash(__('Kpi deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Kpi was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
