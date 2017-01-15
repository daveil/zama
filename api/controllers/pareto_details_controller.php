<?php
class ParetoDetailsController extends AppController {

	var $name = 'ParetoDetails';

	function index() {
		$this->ParetoDetail->recursive = 0;
		$this->set('paretoDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid pareto detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('paretoDetail', $this->ParetoDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ParetoDetail->create();
			if ($this->ParetoDetail->save($this->data)) {
				$this->Session->setFlash(__('The pareto detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pareto detail could not be saved. Please, try again.', true));
			}
		}
		$paretos = $this->ParetoDetail->Pareto->find('list');
		$modelNos = $this->ParetoDetail->ModelNo->find('list');
		$this->set(compact('paretos', 'modelNos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid pareto detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ParetoDetail->save($this->data)) {
				$this->Session->setFlash(__('The pareto detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pareto detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ParetoDetail->read(null, $id);
		}
		$paretos = $this->ParetoDetail->Pareto->find('list');
		$modelNos = $this->ParetoDetail->ModelNo->find('list');
		$this->set(compact('paretos', 'modelNos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pareto detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ParetoDetail->delete($id)) {
			$this->Session->setFlash(__('Pareto detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Pareto detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
