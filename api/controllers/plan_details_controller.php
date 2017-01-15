<?php
class PlanDetailsController extends AppController {

	var $name = 'PlanDetails';

	function index() {
		$this->PlanDetail->recursive = 0;
		$this->set('planDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid plan detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('planDetail', $this->PlanDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PlanDetail->create();
			if ($this->PlanDetail->save($this->data)) {
				$this->Session->setFlash(__('The plan detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plan detail could not be saved. Please, try again.', true));
			}
		}
		$plans = $this->PlanDetail->Plan->find('list');
		$this->set(compact('plans'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid plan detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PlanDetail->save($this->data)) {
				$this->Session->setFlash(__('The plan detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The plan detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PlanDetail->read(null, $id);
		}
		$plans = $this->PlanDetail->Plan->find('list');
		$this->set(compact('plans'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for plan detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PlanDetail->delete($id)) {
			$this->Session->setFlash(__('Plan detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Plan detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
