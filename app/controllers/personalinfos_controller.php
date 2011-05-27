<?php
class PersonalinfosController extends AppController {
	var $name       = 'Personalinfos';
	var $uses       = 'PersonalInfo';
	var $components = array('Custom');
	var $helpers    = array('Custom');
	
	/*
	function admin_index($id = null) {
        $this->PersonalInfo->recursive = 0;
        $this->paginate['conditions'][] = array('PersonalInfo.user_id' => $id);
		$this->set('PersonalInfos', $this->paginate());
	}
	*/
			
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$PersonalInfo = $this->PersonalInfo->read(null, $id);
		$this->set('PersonalInfo', $PersonalInfo);
	}
	
	function admin_edit($id=null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Personal Info', true));
			$this->redirect(array('action' => 'index'));
		}
		
		//debug($this->data);
        // exit;
		
		if (!empty($this->data)) {
			
            // $this->PersonalInfo->validate = array();
			
			//Update case data
			$this->PersonalInfo->id = $this->data['PersonalInfo']['id'];
			if ($this->PersonalInfo->saveAll($this->data)) {

				$this->Session->setFlash(__('The Personal Info has been saved', true));

				$this->redirect(array('admin' => true, 'action' => 'view', $this->data['PersonalInfo']['id']));
			} else {
				$this->Session->setFlash(__('The Personal Info could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->PersonalInfo->read(null, $id);
		}
        		
	}
}
?>