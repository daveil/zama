<?php
class RightsController extends AppController {

	var $name = 'Rights';

	function index() {
		$this->Right->recursive = 0;
		$this->set('rights', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid right', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('right', $this->Right->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			if($this->RequestHandler->isAjax()||$this->RequestHandler->ext=='json'){
				$right =  $this->data['Right'];
				switch($right['action']){
					case 'access':
						$group_id = $right['group_id'];
						$conditions = array('Right.group_id'=>$group_id);
						$access  = array();
						$this->Right->deleteAll($conditions);
						if(count($right['access'])){
							foreach($right['access'] as $module_id){
								array_push($access,array('group_id'=>$group_id,'module_id'=>$module_id));
							}
							$this->Right->saveAll($access);
						}
					break;
					default:
						return $this->cakeError('invalidEndpoint');
					break;
				}
			}else{
				$this->Right->create();
				if ($this->Right->save($this->data)) {
					$this->Session->setFlash(__('The right has been saved', true));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The right could not be saved. Please, try again.', true));
				}
			}
		}
		$conditions = array('Module.is_parent'=>true);
		$groups = $this->Right->Group->find('list');
		$modules = $this->Right->Module->find('list',compact('conditions'));
		$this->set(compact('groups', 'modules'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid right', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Right->save($this->data)) {
				$this->Session->setFlash(__('The right has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The right could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Right->read(null, $id);
		}
		$groups = $this->Right->Group->find('list');
		$modules = $this->Right->Module->find('list');
		$this->set(compact('groups', 'modules'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for right', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Right->delete($id)) {
			$this->Session->setFlash(__('Right deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Right was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
