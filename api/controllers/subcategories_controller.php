<?php
class SubcategoriesController extends AppController {

	var $name = 'Subcategories';

	function index() {
		$this->Subcategory->recursive = 0;
		$this->set('subcategories', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid subcategory', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('subcategory', $this->Subcategory->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Subcategory->create();
			if ($this->Subcategory->save($this->data)) {
				$this->Session->setFlash(__('The subcategory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subcategory could not be saved. Please, try again.', true));
			}
		}
		$kpis = $this->Subcategory->Kpi->find('list');
		$this->set(compact('kpis'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid subcategory', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Subcategory->save($this->data)) {
				$this->Session->setFlash(__('The subcategory has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subcategory could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Subcategory->read(null, $id);
		}
		$kpis = $this->Subcategory->Kpi->find('list');
		$this->set(compact('kpis'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for subcategory', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Subcategory->delete($id)) {
			$this->Session->setFlash(__('Subcategory deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Subcategory was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
