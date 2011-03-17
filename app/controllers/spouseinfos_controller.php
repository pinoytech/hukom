<?php
class SpouseinfosController extends AppController {
	var $name = 'Spouseinfos';
	var $uses = 'SpouseInfo';
	var $components = array('Custom');
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$SpouseInfo = $this->SpouseInfo->read(null, $id);
		
		$this->set('SpouseInfo', $SpouseInfo);
		
		//Get Personal Info ID
        $this->loadModel('PersonalInfo');
		$PersonalInfo = $this->PersonalInfo->find('first', array('conditions' => array('PersonalInfo.user_id' => $SpouseInfo['User']['id'])));
		$this->set('personal_info_id', $PersonalInfo['PersonalInfo']['id']);
        
	}
	
	function admin_edit($id=null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Personal Info', true));
			$this->redirect(array('action' => 'index'));
		}
				
		if (!empty($this->data)) {
			
            // $this->Spouseinfo->validate = array();
			
			//Update case data
			$this->SpouseInfo->id = $this->data['SpouseInfo']['id'];
			if ($this->SpouseInfo->saveAll($this->data)) {

				$this->Session->setFlash(__('The Spouse Info has been saved', true));

				$this->redirect(array('admin' => true, 'action' => 'view', $this->data['SpouseInfo']['id']));
			} else {
				$this->Session->setFlash(__('The Spouse Info could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->SpouseInfo->read(null, $id);
		}
		
        // debug($this->data);
        // exit;
        
        //Get Personal Info ID
        $this->loadModel('PersonalInfo');
		$PersonalInfo = $this->PersonalInfo->find('first', array('conditions' => array('PersonalInfo.user_id' => $this->data['User']['id'])));
		$this->set('personal_info_id', $PersonalInfo['PersonalInfo']['id']);
		
		$this->set('list_gender', $this->Custom->list_gender());
		$this->set('list_education_attained', $this->Custom->list_education_attained());
		$this->set('list_work_status', $this->Custom->list_work_status());
		$this->set('list_civil_status', $this->Custom->list_civil_status());

	}
}
?>