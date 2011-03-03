<?php
class LegalcasedetailsController extends AppController {

	var $name = 'Legalcasedetails';
	var $components = array('Email');
	
	function beforeFilter() {
	    parent::beforeFilter(); 
	    // $this->Auth->allowedActions = array('index', 'view');
	}

	function index($id) {
		parent::redirect_to_admin_index(); 
		
		// debug($this->Auth_user);
		
		$this->set('id', $this->Auth_user['User']['id']);

		$Legalcasedetails = $this->Legalcasedetail->find('all', array('conditions' => array('Legalcasedetail.case_id' => $id)));

		$this->set('Legalcasedetails', $Legalcasedetails);
	}

	function admin_index($id) {

		$this->Legalcasedetail->recursive = 0;
		$this->paginate['conditions'][] = array('Legalcase.status' => 'active', 'Legalcasedetail.case_id' => $id);
		$this->paginate['order'][] = array('Legalcasedetail.id' => 'DESC');
		$this->set('Legalcasedetails', $this->paginate());
		
		$this->set('case_id', $id);
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('Legalcasedetail', $this->Legalcasedetail->read(null, $id));
		

	}
	
	function admin_edit($id) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid case', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			
			//Check confirmed value
			if ($this->data['Legalcasedetail']['status'] == 'confirmed') {

				if ($this->data['Legalcasedetail']['confirmed'] != 1) {					

					//Send Confirmation Email
					$this->_send_client_confirmation($this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id']);
					$this->data['Legalcasedetail']['confirmed'] = 1;
					$email_sent_alert = ' and confirmation email is sent to the user';
					
				}
			}
			
			//Update case data
			$this->Legalcasedetail->id = $this->data['Legalcasedetail']['id'];
			if ($this->Legalcasedetail->save($this->data)) {
				$this->Session->setFlash(__('The case details has been saved' . $email_sent_alert, true));

				$this->redirect(array('admin' => true, 'action' => 'index', $this->data['Legalcasedetail']['case_id']));
				
			} else {
				$this->Session->setFlash(__('The case could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Legalcasedetail->read(null, $id);
		}
		
		$this->loadModel('Legalservice');
		$this->set('Legalservices', $this->Legalservice->find('list', array('fields' => array('Legalservice.name', 'Legalservice.name'))));
	}

	function _send_client_confirmation($id, $case_id) {
		$this->loadModel('User');
		
		$User                  = $this->User->read(null,$id);
		$this->Email->to       = $User['User']['username'];
		$this->Email->bcc      = array('gino.carlo.cortez@gmail.com');  
		$this->Email->subject  = 'E-Lawyers Online - Final Confirmation Email';
		$this->Email->replyTo  = 'no-reply@e-laywersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = 'final_confirmation'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs   = 'html'; // because we like to send pretty mail
	    //Set view variables as normal
	    $this->set('User', $User);
	    $this->set('case_id', $case_id);
	    //Do not pass any args to send()
	    $this->Email->send();
	 }
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Legalcasedetail->delete($id)) {
			$this->Session->setFlash(__('Case Details deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Case Details was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>