<?php
class LegalcasedetailsController extends AppController {

	var $name = 'Legalcasedetails';
	var $components = array('Email', 'Custom');
	
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
	
	//List Incomplete Cases
	function admin_incomplete() {
		$this->Legalcasedetail->recursive = 0;
		$this->paginate['conditions'][] = array('Legalcase.status' => 'active', 'Legalcasedetail.status' => 'Incomplete');
		$this->paginate['order'][] = array('Legalcasedetail.id' => 'DESC');
		$this->set('Legalcasedetails', $this->paginate());
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
		
		$Legalcasedetail = $this->Legalcasedetail->read(null, $id);
		
		$this->set('Legalcasedetail', $Legalcasedetail);
		
        // debug($Legalcasedetail);
		
        $upload_folder = $this->uploads_path . $Legalcasedetail['User']['id'] . "/" . $Legalcasedetail['Legalcasedetail']['case_id'] . "/" . $Legalcasedetail['Legalcasedetail']['id'];
        $this->set('files', $this->Custom->show_files($upload_folder));
        $this->set('upload_folder', $upload_folder);
	}
	
	function admin_edit($id) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid case', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {

            //Check confirmed value
			if ($this->data['Legalcasedetail']['status'] == 'Closed') {

				if ($this->data['Legalcasedetail']['closed'] != 1) {					

					//Send Thank You Email
					$this->_send_closed_confirmation($this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id']);
					$this->data['Legalcasedetail']['closed'] = 1;
					$email_sent_alert = ' and closed confirmation email is sent to the user';
					
				}
			}
			
			// Incomplete Status
			if ($this->data['Legalcasedetail']['status'] == 'Incomplete') {
				//Send Thank You Email
				$this->_send_incomplete_confirmation($this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id']);
				$email_sent_alert = ' and incomplete confirmation email is sent to the user';
			}

			//Update case data
			$this->Legalcasedetail->id = $this->data['Legalcasedetail']['id'];
			if ($this->Legalcasedetail->save($this->data)) {
				$this->Session->setFlash(__('The Case Details has been saved'. $email_sent_alert, true));

				$this->redirect(array('admin' => true, 'action' => 'index', $this->data['Legalcasedetail']['case_id']));
				
			} else {
				$this->Session->setFlash(__('The Case Details could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Legalcasedetail->read(null, $id);
		}
		
		$this->loadModel('Legalservice');
		$this->set('Legalservices', $this->Legalservice->find('list', array('fields' => array('Legalservice.name', 'Legalservice.name'))));
	}
    
	function _send_closed_confirmation($id, $case_id) {
		$this->loadModel('User');
		
		$User                  = $this->User->read(null,$id);
		$this->Email->to       = $User['User']['username'];
		$this->Email->bcc      = $this->admin_email;  
		$this->Email->subject  = 'E-Lawyers Online - Closed Confirmation';
		$this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = 'closed_confirmation'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs   = 'html'; // because we like to send pretty mail
	    //Set view variables as normal
	    $this->set('User', $User);
	    $this->set('case_id', $case_id);
	    //Do not pass any args to send()
	    $this->Email->send();
	 }
	 
	 function _send_incomplete_confirmation($id, $case_id) {
 		$this->loadModel('User');

 		$User                  = $this->User->read(null,$id);
 		$this->Email->to       = $User['User']['username'];
 		$this->Email->bcc      = $this->admin_email;  
 		$this->Email->subject  = 'E-Lawyers Online - Incomplete Confirmation';
 		$this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
 		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
 		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
 		$this->Email->template = 'incomplete_confirmation'; // note no '.ctp'
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
	
	function admin_payment_reminder() {
	    if (!empty($_POST)) {
            $Legalcasedetail = $this->Legalcasedetail->findById($_POST['id']);
            
            // $this->Email->delivery = 'debug';
            //Send Email
            $this->_send_payment_reminder_confirmation($Legalcasedetail['Legalcasedetail']['user_id'], $Legalcasedetail['Legalcasedetail']['id'], $Legalcasedetail['Legalcasedetail']['legal_service']);
            // debug($this->Session->read('Message.email'));

            //Trigger Payment Reminder

            $this->Legalcasedetail->updateAll(
                array('Legalcasedetail.payment_reminder' => $Legalcasedetail['Legalcasedetail']['payment_reminder'] + 1),
                array('Legalcasedetail.id' => $Legalcasedetail['Legalcasedetail']['id'])
            );

            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
            echo 'reminder_sent';
	    }
	}
	
	 function _send_payment_reminder_confirmation($id, $case_detail_id, $legal_service) {
		$this->loadModel('User');
		
		if ($legal_service == 'Monthly Retainer') {
           $subject = "$legal_service Payment Reminder";
		}
		elseif ($legal_service == 'Case/Project Retainer') {
           $subject = "$legal_service Payment Reminder";
		}

		$User                  = $this->User->read(null,$id);
		$Legalcasedetail       = $this->Legalcasedetail->read(null,$case_detail_id);
		$this->Email->to       = $User['User']['username'];
		$this->Email->bcc      = $this->admin_email;  
		$this->Email->subject  = "E-Lawyers Online - $subject";
		$this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = 'payment_reminder_confirmation'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs   = 'html'; // because we like to send pretty mail
	    //Set view variables as normal
	    $this->set('User', $User);
	    $this->set('Legalcasedetail', $Legalcasedetail);
	    $this->set('legal_service', $legal_service);
	    //Do not pass any args to send()
	    $this->Email->send();
	 }
}
?>