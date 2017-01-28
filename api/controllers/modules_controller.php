<?php
class ModulesController extends AppController {

	var $name = 'Modules';
	
	function index() {
		if($this->RequestHandler->isAjax()||$this->RequestHandler->ext=='json'){
			$modules = array();
			$user_type = $this->Auth->user()['User']['user_type'];
			$this->Module->Right->recursive=-1;
			$rights = array();
			foreach($this->Module->Right->findAllByGroupId($user_type) as $right){
				array_push($rights,$right['Right']['module_id']);
			}
			if(count($rights)){
				$this->conditions['OR'] = array(
							'Module.id'=>$rights,
							'Module.parent_id'=>$rights,
				);
				$treelist = $this->Module->generatetreelist($this->conditions,null,null,' ');
				$parents = array();
				
				foreach($treelist as $id=>$name){
					if($user_type!='admin' && trim($name)=='Department'){
						continue;
					}
						
					$mod = $this->Module->findById($id);
					$link = $mod['Module']['link'];
					$parent_id = $mod['Module']['parent_id'];
					$is_parent = $mod['Module']['is_parent'];
					$mod['nonce'] = rand();
					$token = '_'.substr(md5(json_encode($mod)),0,5);
					$module =  array('Module'=>array('id'=>$id,'token'=>$token,'name'=>$name,'link'=>$link,'is_parent'=>$is_parent));
					
					$parents[$id] =  $token;
					if(isset($parents[$parent_id])){
						$module['Module']['parent_token'] = $parents[$parent_id];
					}
					array_push($modules,$module);
				}
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
				if(isset($this->data['Module']['parent_id'])){
					$parent_id = $this->data['Module']['parent_id'];
					if($parent_id){
						$this->Module->id = $parent_id;
						$this->Module->save(array('is_parent'=>true));
					}
				}
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
			$module =  $this->Module->findById($id);
			if ($this->Module->save($this->data)) {
				$prev_parent = $module['Module']['parent_id'];
				$curr_parent = $this->data['Module']['parent_id'];
				$this->_updateIsParent($prev_parent);
				$this->_updateIsParent($curr_parent);
				$this->Session->setFlash(__('The module has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The module could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Module->read(null, $id);
		}
		$conditions = array('NOT'=>array('Module.id'=>$id));
			$parents = $this->Module->find('list',compact('conditions'));
			$parents[0]= 'ROOT';
			$this->set(compact('parents'));
		
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for module', true));
			$this->redirect(array('action'=>'index'));
		}
		$module =  $this->Module->findById($id);
		if ($this->Module->delete($id)){
			$parent_id = $module['Module']['parent_id'];
			$this->_updateIsParent($parent_id);	
			$this->Session->setFlash(__('Module deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Module was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	protected function _updateIsParent($parent_id){
		return;
		$conditions = array('Module.parent_id'=>$parent_id);
		$count = $this->Module->find('count',compact('conditions'));
		$module = array('Module'=>array('id'=>$parent_id,'is_parent'=>$count));
		$this->Module->save($module);
		
		
	}
}
