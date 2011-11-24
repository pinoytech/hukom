<?php
class ChildrenlistsController extends AppController {
	var $name       = 'Childrenlists';
	var $uses       = 'ChildrenList';
	var $components = array('Custom');
	var $helpers    = array('Custom');
	
	function admin_index($id = null) {
        // $ChildrenList = $this->ChildrenList->find('all', array('conditions' => array('ChildrenList.user_id' => $id)));
        // $this->set('ChildrenLists', $ChildrenList);
		
		$this->ChildrenList->recursive = 0;
        $this->paginate['conditions'][] = array('ChildrenList.user_id' => $id);
		$this->set('ChildrenLists', $this->paginate());
	}
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$ChildrenList = $this->ChildrenList->read(null, $id);
		
		$this->set('ChildrenList', $ChildrenList);
		
		//Get Spouse Info ID
        // $this->loadModel('SpouseInfo');
        // $SpouseInfo = $this->SpouseInfo->find('first', array('conditions' => array('SpouseInfo.user_id' => $PersonalInfo['User']['id'])));
        // $this->set('spouse_info_id', $SpouseInfo['SpouseInfo']['id']);
	}
	
	function admin_edit($id=null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Child Info', true));
			$this->redirect(array('action' => 'index'));
		}
		
		//debug($this->data);
        // exit;
		
		if (!empty($this->data)) {
			
            // $this->PersonalInfo->validate = array();
			
			//Update case data
			$this->ChildrenList->id = $this->data['ChildrenList']['id'];
			if ($this->ChildrenList->saveAll($this->data)) {

				$this->Session->setFlash(__('The Child Info has been saved', true));

				$this->redirect(array('admin' => true, 'action' => 'view', $this->data['ChildrenList']['id']));
			} else {
				$this->Session->setFlash(__('The Child Info could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->ChildrenList->read(null, $id);
            // debug($this->data);
		}
		
		//Get Spouse Info ID
        // $this->loadModel('SpouseInfo');
        // $SpouseInfo = $this->SpouseInfo->find('first', array('conditions' => array('SpouseInfo.user_id' => $this->data['User']['id'])));
        // $this->set('spouse_info_id', $SpouseInfo['SpouseInfo']['id']);
	}
}
?>
