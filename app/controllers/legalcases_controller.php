<?php
class LegalcasesController extends AppController {

	var $name = 'Legalcases';
	var $components = array('Email');
	
	function beforeFilter() {
	    parent::beforeFilter(); 
	    // $this->Auth->allowedActions = array('index', 'view');
	}

	function index() {
		parent::redirect_to_admin_index(); 
		
		// debug($this->Auth_user);
		
		$this->set('id', $this->Auth_user['User']['id']);
		
		$Legalcase = $this->Legalcase->find('all', array('conditions' => array('Legalcase.user_id' => $this->Auth_user['User']['id'])));
		// debug($Legalcase);
		$this->set('Legalcase', $Legalcase);
	}

	function admin_index() {
		// $this->Post->recursive = 0;
		// $this->set('posts', $this->paginate());
		
		// $Legalcase = $this->Legalcase->find('all', array('conditions' => array('Legalcase.user_id' => $this->Auth_user['User']['id'])));
		// debug($Legalcase);
		// $this->set('Legalcase', $Legalcase);
		
		$this->Legalcase->recursive = 0;
		$this->set('Legalcase', $this->paginate());
	}
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('Legalcase', $this->Legalcase->read(null, $id));
	}
	
	function admin_edit($id) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid case', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			
			//Update case data
			$this->Legalcase->id = $id;
			if ($this->Legalcase->saveAll($this->data)) {
				$this->Session->setFlash(__('The case has been saved', true));

				if ($this->data['Legalcase']['status'] == 'pending') {
					
					if (!$this->data['Legalcase']['confirmed']) {
						//Send Confirmation Email
						$this->_send_client_confirmation($this->data['Legalcase']['user_id']);
						
						//Set confirmed to 1
						$this->Legalcase->read(null, $id);
						$this->Legalcase->set(array(
							'confirmed' => 1,
							'status' => 'confirmed'
							));
						$this->Legalcase->save();
					}
				}

				$this->redirect(array('admin' => true, 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The case could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Legalcase->read(null, $id);
		}
	}
	
	function _send_client_confirmation($id) {
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
	    //Do not pass any args to send()
	    $this->Email->send();
	 }
	
	/*
	function add() {
		//Redirect perosnal user to profile page if no case
		// $Case = $this->Legalcase->find('first', array('conditions' => array('Case.user_id' => $this->Auth_user['User']['id'], 'Case.type' => 'personal')));
		
		$this->loadModel('User');
		$User = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth_user['User']['id'])));

		if ($User['User']['type'] == 'personal') {
			$this->redirect(array('controller' => 'users', 'action' => 'personal_info', $this->Auth_user['User']['id']));
		}
		//Corporation Redirect here
		
		$this->set('id', $this->Auth_user['User']['id']);
		
		$this->render('form');
	}
	*/
	
	function online_legal_consultation($id=null){
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			$this->Legalcase->id = $this->data['Legalcase']['id'];
			if ($this->Legalcase->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));
				$this->redirect(array('action' => 'letter_of_intent', $this->data['Legalcase']['user_id'], $this->Legalcase->id));
				
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}
		}
	
		$this->set('user_id', $id);
		$this->set('id', $id);
	}
	
	function letter_of_intent($id, $case_id){
		$this->loadModel('PersonalInfo');
		
		$PersonalInfo = $this->PersonalInfo->find('first', array('conditions' => array('PersonalInfo.user_id' => $id)));
		
		$user_full_name = $PersonalInfo['PersonalInfo']['first_name'].' '.$PersonalInfo['PersonalInfo']['last_name'];

		if (!empty($this->data)) {
			$this->redirect(array('controller' => 'LegalCases', 'action' => 'add'));
		}

		$this->set('user_full_name', $user_full_name);
		$this->set('email', $PersonalInfo['PersonalInfo']['email']);
		$this->set('id', $id);
		$this->set('case_id', $case_id);
	}
	
	function legal_problem($id, $case_id=null){ //$id = user_id
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// debug($this->data);
		// exit;
						
		// Update Case Details
		if (!empty($this->data)) {
			
			$this->Legalcase->id = $this->data['Legalcase']['id'];
			
			if ($this->Legalcase->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));
				$this->redirect(array('action' => 'summary_of_facts', $this->data['Legalcase']['user_id'], $this->Legalcase->id));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}
			
			$this->data = $this->Legalcase->read(null, $this->Legalcase->id);

		}
		
		if (empty($this->data)) {
			$this->data = $this->Legalcase->read(null, $case_id);
			// debug($this->data);
		}

		$this->set('id', $id);
		$this->set('case_id', $case_id);
	}
	
	function summary_of_facts($id, $case_id=null, $case_detail_id=null){ //$id = user_id
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->loadModel('Legalcasedetail');

		// debug($this->data);
		// exit;		
				
		// Update Case Details
		if (!empty($this->data)) {
			
			$this->Legalcasedetail->id = $this->data['Legalcasedetail']['id'];
			
			if ($this->Legalcasedetail->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));				
				$this->redirect(array('action' => $this->data['Legalcase']['goto'], $this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id'], $this->Legalcasedetail->id));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}
			
			$this->data = $this->Legalcasedetail->read(null, $this->data['Legalcasedetail']['case_id']);

		}
		
		if (empty($this->data)) {
			$this->data = $this->Legalcasedetail->read(null, $case_detail_id);
		}

		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);
	}
	
	function objectives_questions($id, $case_id=null, $case_detail_id=null){
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// debug($this->data);
		// exit;
		
		$this->loadModel('Legalcasedetail');
		
		// Update Case Details
		if (!empty($this->data)) {

			$this->Legalcasedetail->id = $this->data['Legalcasedetail']['id'];

			if ($this->Legalcasedetail->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));
				$this->redirect(array('action' => $this->data['Legalcase']['goto'], $this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id'], $this->Legalcasedetail->id));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}

			$this->data = $this->Legalcasedetail->read(null, $this->data['Legalcasedetail']['case_id']);
		}
		
		if (empty($this->data)) {
			$this->data = $this->Legalcasedetail->read(null, $case_detail_id);
		}

		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);
	}

	function summary_of_information($id, $case_id=null, $case_detail_id=null){

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Will get all legal_case_details data
		$Legalcase = $this->Legalcase->find('first', array('conditions' => array('Legalcase.id' => $case_id)));

		// debug($Legalcase);

		$this->set('Legalcase', $Legalcase);
		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);

	}
	
	function online_legal_consultation_agreement($id, $case_id=null, $case_detail_id=null){ //$id = user_id
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// $Case = $this->Legalcase->read(null, $case_id);
		// debug($Case);
		
		$this->loadModel('User');
		$User = $this->User->find('first', array('conditions' => array('User.id' => $id)));
		
		$user_full_name = $User['PersonalInfo']['first_name'].' '.$User['PersonalInfo']['last_name'];
		
		$this->set('user_full_name', $user_full_name);
		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);
	}
	
	function review_case($id) {
		
	}
}
?>