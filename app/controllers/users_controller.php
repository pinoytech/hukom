<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('Email');
	
	function beforeFilter() {
	    parent::beforeFilter(); 
	    // $this->Auth->allow(array('*'));
		$this->Auth->allowedActions = array('login',
			'logout',
			'admin_login',
			'admin_logout',
			'initDB',
			'register',
			'forgot_password',
			'verification',
			'password_reset');
	}
	
	function index() {
		parent::redirect_to_admin_index(); 
		
		// Redirect users out of here
		if (!$this->Session->read('Auth.User')) {
			$this->redirect('/', null, false);
		}
		
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}
	
	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}
	
	function register() {
		if (!empty($this->data)) {
			$this->loadModel('PersonalInfo');
			// debug($this->data);
			// exit;
			
			$this->User->create();
			
			$fieldList = array(
				'user_id',
				'group_id',
				'type',
				'first_name',
				'last_name',
				'username',
				'password',
				'password_confirm',
				'gender',
				'birth_date'
				);

			if ($this->User->saveAll($this->data, array('fieldList' => $fieldList))) {
				
				// Update Personal Info Email
				$this->PersonalInfo->user_id = $this->User->id;
				$this->PersonalInfo->saveField('email', $this->data['User']['username']);
				
				// Send Confirmation Email
				$this->_sendNewUserMail( $this->User->id );
				
				$this->redirect(array('controller' => 'pages', 'action' => 'thankyou'));
			} else {
				$this->Session->setFlash(__('Registration could not be completed. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}
	
	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Update Users and Personal Info
		if (!empty($this->data)) {
			
			$this->User->id = $this->data['User']['id'];
			if ($this->User->saveAll($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('admin' => true, 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id, true)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function login() {
	    //Auth Magic
		if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash('You are logged in!');
			$this->redirect('/', null, false);
		}
		
		// Login Validation
		if($this->data) {
			if (!$this->Session->read('Auth.User')) {
				$this->Session->setFlash('Invalid Username or Password. Please try again');
			}
		}
	}
	
	function admin_login() {
	    //Auth Magic
		if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash('You are logged in!');
			$this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
		}
		
		// Login Validation
		if($this->data) {
			if (!$this->Session->read('Auth.User')) {
				$this->Session->setFlash('Invalid Username or Password. Please try again');
			}
		}
	}

	function logout() {
	    //Leave empty for now.
		$this->Session->setFlash('You have been successfully logged out. Thank you for visiting E-Lawyers Online');
		$this->redirect($this->Auth->logout());
	}
	
	function admin_logout() {
	    //Leave empty for now.
		$this->Session->setFlash('Good-Bye');
		$this->Auth->logout();
		$this->redirect(array('action' => 'admin_login'));
	}
	
	function test_mailer($id) {
		$this->_sendNewUserMail($id);
	}
	
	function _sendNewUserMail($id) {
		$User                  = $this->User->read(null,$id);
		$this->Email->to       = $User['User']['username'];
		$this->Email->bcc      = array('gino.carlo.cortez@gmail.com');  
		$this->Email->subject  = 'E-Lawyers Online - Confirmation Email';
		$this->Email->replyTo  = 'no-reply@e-laywersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = 'user_confirmation'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs   = 'html'; // because we like to send pretty mail
	    //Set view variables as normal
	    $this->set('User', $User);
	    //Do not pass any args to send()
	    $this->Email->send();
	 }
	
	function forgot_password() {
		if($this->data) {
			$User = $this->User->findByUsername($this->data['User']['username']);
			
			if($User) {
				// $password = $this->generatePassword();
				// debug($password);
				// $this->User->id = $User['User']['id'];
				// $this->User->saveField('password', Security::hash($password, null, true));

				// Send Confirmation Email
				$this->_sendUserForgotPasswordMail( $User['User']['id']);

				$this->redirect(array('controller' => 'pages', 'action' => 'password_sent'));
			}
			else {
				$this->Session->setFlash('Invalid Username. Please try again');				
			}
		}
	}
	
	//Generate random strings
	function generatePassword ($length = 8){
	  // start with a blank password
	  $password = "";

	  // define possible characters
	  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 

	  // set up a counter
	  $i = 0; 

	  // add random characters to $password until $length is reached
	  while ($i < $length) { 	
	    // pick a random character from the possible ones
	    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);	        
	    // we don't want this character if it's already in the password
	    if (!strstr($password, $char)) { 
	      $password .= $char;
	      $i++;
	    }	
	  }	
	  // done!
	  return $password;	
	}
	
	
	function _sendUserForgotPasswordMail($id) {
		$User                  = $this->User->read(null,$id);
		$this->Email->to       = $User['User']['username'];
		$this->Email->bcc      = array('gino.carlo.cortez@gmail.com');  
		$this->Email->subject  = 'E-Lawyers Online - Password Request';
		$this->Email->replyTo  = 'no-reply@e-laywersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = 'password_request'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs   = 'html'; // because we like to send pretty mail
	    //Set view variables as normal
	    $this->set('User', $User);
		// $this->set('password', $password);
	    //Do not pass any args to send()
	    $this->Email->send();
	 }
	
	function verification($id) {
		// Verify user account
		$this->User->id = $id;
		$this->User->saveField('verified', 'yes');
		
		if ($this->Session->read('Auth.User')) {
			$this->Session->setFlash("You're account has been verified");
			$this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
		}
	
	}
	
	function password_reset($id) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {	
			$this->User->id = $this->data['User']['id'];
			if ($this->User->saveAll($this->data)) {
				$this->Session->setFlash(__('Your password has been saved. Please log in.', true));
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			} else {
				$this->Session->setFlash(__('The password could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}
	
	function personal_info($id, $case_id=null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Update Personal Info
		if (!empty($this->data)) {
			
			$this->loadModel('PersonalInfo');
			$this->loadModel('SpouseInfo');
			
			$this->PersonalInfo->id = $this->data['PersonalInfo']['id'];
			if ($this->PersonalInfo->save($this->data)) {
				
				if ($this->data['PersonalInfo']['civil_status'] == 'single') {
					$this->SpouseInfo->deleteAll(array('SpouseInfo.user_id' => $id));
				}
				
				// $this->Session->setFlash(__('Personal Information has been saved', true));
				
				//
				if ($this->data['PersonalInfo']['civil_status'] == 'single') {					
					$this->redirect(array('action' => 'children_info', $this->data['User']['id'], $this->data['User']['case_id']));
				}
				else {
					$this->redirect(array('action' => 'spouse_info', $this->data['User']['id'], $this->data['User']['case_id']));
				}
				
			} else {
				$this->Session->setFlash(__('Personal Information could not be saved. Please, try again.', true));
			}
			
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		
		$this->set('id', $id);
		$this->set('case_id', $case_id);
	}
	
	function spouse_info($id, $case_id=null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// debug($this->data);
		// exit;
		
		// Update Spouse Info
		if (!empty($this->data)) {
			
			$this->loadModel('SpouseInfo');
			$this->SpouseInfo->id = $this->data['SpouseInfo']['id'];
			
			if ($this->SpouseInfo->save($this->data)) {
				
			} else {
				$this->Session->setFlash(__('Spouse Information could not be saved. Please, try again.', true));
				unset($this->data['User']['goto']);
			}
		}
		
		//Redirect control
		if (isset($this->data['User']['goto'])) {
			$this->redirect(array('action' => $this->data['User']['goto'], $this->data['SpouseInfo']['user_id'], $this->data['User']['case_id']));
		}
		
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		
		$this->set('id', $id);
		$this->set('case_id', $case_id);
	}
	
	function children_info($id, $case_id=null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Update Children Info
		if (!empty($this->data)) {
			
			$this->loadModel('ChildrenInfo');
			$this->loadModel('ChildrenList');
			//$this->loadModel('Legalcase');
			
			$this->ChildrenInfo->id = $this->data['ChildrenInfo']['id'];
			
			// Delete ChildrenList
			$this->ChildrenList->deleteAll(array('ChildrenList.user_id' => $id));
			
			// debug($this->data);
			// exit;
			
			$goto = $this->data['User']['goto'];
			$case_id = $this->data['User']['case_id'];
			unset($this->data['User']);
						
			//Save Data	
			//Check if no_of_children is available
			if (!empty($this->data['ChildrenInfo']['no_of_children'])) {
								
				if ($this->ChildrenInfo->saveAll($this->data)) {		
				
				} else {
					$this->Session->setFlash(__('Children Information could not be saved. Please, try again.', true));
				}
			}
			
			//Redirect 
			if ($goto == 'legal_problem') {
				$this->redirect(array('controller' => 'legalcases', 'action' => $goto, $this->data['ChildrenInfo']['user_id'], $case_id));
			}
			else {	
				
				$User = $this->User->read(null, $id);
				
				if ($User['PersonalInfo']['civil_status'] == 'single') {
					$goto = 'personal_info';
				}
				else {
					$goto = 'spouse_info';
				}
				
				//Redirect to Personal or Spouse
				$this->redirect(array('action' => $goto, $this->data['ChildrenInfo']['user_id'], $case_id));
			}
			
			// $this->data = $this->User->read(null, $id);
			
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		
		$this->set('id', $id);
		$this->set('case_id', $case_id);
	}
	
	//Corporate Accounts
	function corporate_info($id) {
		
	}
	
	/*
	function letter_of_intent($id){
		
		$User = $this->User->find('first', array('conditions' => array('User.id' => $id)));
		
		$user_full_name = $User['PersonalInfo']['first_name'].' '.$User['PersonalInfo']['last_name'];
		
		if (!empty($this->data)) {
			$this->redirect(array('controller' => 'cases', 'action' => 'add'));
		}
		
		$this->set('user_full_name', $user_full_name);
		$this->set('email', $User['PersonalInfo']['email']);
		$this->set('id', $id);
	}
	*/
	
	function initDB() {
	    $group =& $this->User->Group;
	    //Allow admins to everything
	    $group->id = 1;     
	    $this->Acl->allow($group, 'controllers');

	    //allow managers to posts and widgets
	    $group->id = 2;
	    $this->Acl->deny($group, 'controllers');
	    $this->Acl->allow($group, 'controllers/Posts');
	    $this->Acl->allow($group, 'controllers/Widgets');

	    //allow users to only add and edit on posts and widgets
	    $group->id = 3;
	    $this->Acl->deny($group, 'controllers');        
	    $this->Acl->allow($group, 'controllers/Posts/add');
	    $this->Acl->allow($group, 'controllers/Posts/edit');        
	    $this->Acl->allow($group, 'controllers/Widgets/add');
	    $this->Acl->allow($group, 'controllers/Widgets/edit');
		$this->Acl->allow($group, 'controllers/Dashboard');
		$this->Acl->allow($group, 'controllers/Legalcases');
		$this->Acl->allow($group, 'controllers/Users/edit');
		$this->Acl->allow($group, 'controllers/Users/personal_info');
		$this->Acl->allow($group, 'controllers/Users/spouse_info');
		$this->Acl->allow($group, 'controllers/Users/children_info');
		$this->Acl->allow($group, 'controllers/Legalcases/legal_problem');
		$this->Acl->allow($group, 'controllers/Legalcases/summary_of_facts');
		$this->Acl->allow($group, 'controllers/Legalcases/objectives_questions');
		$this->Acl->allow($group, 'controllers/Legalcases/summary_of_information');
		$this->Acl->allow($group, 'controllers/Legalcases/online_legal_consultation_agreement');
		$this->Acl->allow($group, 'controllers/Legalcases/online_legal_consultation');
		$this->Acl->allow($group, 'controllers/Legalcases/letter_of_intent');
		$this->Acl->allow($group, 'controllers/Payments/mode_of_payment');
		$this->Acl->allow($group, 'controllers/Payments/bank_deposit');
		$this->Acl->allow($group, 'controllers/Payments/bank_deposit_summary');
		$this->Acl->allow($group, 'controllers/Payments/bank_deposit_confirmation');
	    //we add an exit to avoid an ugly "missing views" error message
	    echo "all done";
	    exit;
	}
}
?>