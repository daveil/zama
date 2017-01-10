<?php
class PartNosController extends AppController {

	var $name = 'PartNos';

	function index() {
		$this->PartNo->recursive = 0;
		$this->set('partNos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid part no', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('partNo', $this->PartNo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PartNo->create();
			if ($this->PartNo->save($this->data)) {
				$this->Session->setFlash(__('The part no has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The part no could not be saved. Please, try again.', true));
			}
		}
		$departments = $this->PartNo->Department->find('list');
		$this->set(compact('departments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid part no', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PartNo->save($this->data)) {
				$this->Session->setFlash(__('The part no has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The part no could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PartNo->read(null, $id);
		}
		$departments = $this->PartNo->Department->find('list');
		$this->set(compact('departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for part no', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PartNo->delete($id)) {
			$this->Session->setFlash(__('Part no deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Part no was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
