<?php
class ModelNosController extends AppController {

	var $name = 'ModelNos';

	function index() {
		$this->ModelNo->recursive = 0;
		$this->set('modelNos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid model no', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('modelNo', $this->ModelNo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ModelNo->create();
			if ($this->ModelNo->save($this->data)) {
				$this->Session->setFlash(__('The model no has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The model no could not be saved. Please, try again.', true));
			}
		}
		$demodelments = $this->ModelNo->Demodelment->find('list');
		$this->set(compact('demodelments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid model no', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ModelNo->save($this->data)) {
				$this->Session->setFlash(__('The model no has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The model no could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ModelNo->read(null, $id);
		}
		$demodelments = $this->ModelNo->Demodelment->find('list');
		$this->set(compact('demodelments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for model no', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ModelNo->delete($id)) {
			$this->Session->setFlash(__('Model no deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Model no was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
