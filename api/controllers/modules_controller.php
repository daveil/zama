<?php
class ModulesController extends AppController {

	var $name = 'Modules';
	
	function index() {
		if($this->RequestHandler->isAjax()||$this->RequestHandler->ext=='json'){
			$modules = array();
			$treelist = $this->Module->generatetreelist(null, null, null, '&nbsp;&nbsp;&nbsp;');
			foreach($treelist as $id=>$name){
				$mod = $this->Module->findById($id);
				$link = $mod['Module']['link'];
				array_push($modules,array('Module'=>array('name'=>$name,'link'=>$link)));
			}
			$this->set(compact('modules'));
		}else{
			$this->Module->recursive = 0;
			$this->set('modules', $this->paginate());
		}
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid module', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('module', $this->Module->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Module->create();
			if ($this->Module->save($this->data)) {
				$this->Session->setFlash(__('The module has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The module could not be saved. Please, try again.', true));
			}
		}
		$parents = $this->Module->find('list');
		$parents[0]= 'ROOT';
		$this->set(compact('parents'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid module', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Module->save($this->data)) {
				$this->Session->setFlash(__('The module has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The module could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Module->read(null, $id);
		}
		
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for module', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Module->delete($id)) {
			$this->Session->setFlash(__('Module deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Module was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
