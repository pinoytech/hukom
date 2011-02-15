<?php
class CasesController extends AppController {

	var $name = 'Cases';
	
	function beforeFilter() {
	    parent::beforeFilter(); 
	    // $this->Auth->allowedActions = array('index', 'view');
	}

	function index() {
		parent::redirect_to_admin_index(); 
		
		// debug($this->Auth_user);
		
		$this->set('id', $this->Auth_user['User']['id']);
		
		// $this->set('case', $this->Case->read(null, $id));
	}

	function admin_index() {
		// $this->Post->recursive = 0;
		// $this->set('posts', $this->paginate());
	}
	
	function add() {
		//Redirect perosnal user to profile page if no case
		// $Case = $this->Case->find('first', array('conditions' => array('Case.user_id' => $this->Auth_user['User']['id'], 'Case.type' => 'personal')));
		
		$this->loadModel('User');
		$User = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth_user['User']['id'])));

		if ($User['User']['type'] == 'personal') {
			$this->redirect(array('controller' => 'users', 'action' => 'personal_info', $this->Auth_user['User']['id']));
		}
		//Corporation Redirect here
		
		$this->set('id', $this->Auth_user['User']['id']);
		
		$this->render('form');
	}
	
	function legal_problem($id, $case_id=null){ //$id = user_id
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Update Case Details
		if (!empty($this->data)) {
			// debug($this->data);
			// exit;		
			
			$this->Case->id = $this->data['Case']['id'];
			
			if ($this->Case->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));
				$this->redirect(array('action' => 'summary_of_facts', $id, $this->Case->id));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}
			
			$this->data = $this->Case->read(null, $case_id);

		}
		if (empty($this->data)) {
			$this->data = $this->Case->read(null, $case_id);
		}

		$this->set('user_id', $id);
		
	}
	
	function summary_of_facts($id, $case_id=null){ //$id = user_id
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Update Case Details
		if (!empty($this->data)) {
			// debug($this->data);
			// exit;		
			
			$this->Case->id = $this->data['Case']['id'];
			
			if ($this->Case->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));
				$this->redirect(array('action' => 'objectives_questions', $id, $this->Case->id));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}
			
			$this->data = $this->Case->read(null, $case_id);

		}
		if (empty($this->data)) {
			$this->data = $this->Case->read(null, $case_id);
		}

		$this->set('user_id', $id);
	}
	
	function objectives_questions($id, $case_id=null){ //$id = user_id
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Update Case Details
		if (!empty($this->data)) {
			// debug($this->data);
			// exit;		
			
			$this->Case->id = $this->data['Case']['id'];
			
			if ($this->Case->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));
				$this->redirect(array('action' => 'summary_of_information', $id, $this->Case->id));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}
			
			$this->data = $this->Case->read(null, $case_id);

		}
		if (empty($this->data)) {
			$this->data = $this->Case->read(null, $case_id);
		}

		$this->set('user_id', $id);
	}
	
	function summary_of_information($id, $case_id=null){ //$id = user_id
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// $Case = $this->Case->read(null, $case_id);
		// debug($Case);
		
		$this->loadModel('User');
		$User = $this->User->find('first', array('conditions' => array('User.id' => $id)));
		// debug($User);
		
		$Case = $this->Case->find('first', array('conditions' => array('Case.id' => $case_id)));
		
		$this->set('User', $User);
		$this->set('Case', $Case);
		$this->set('user_id', $id);
		$this->set('case_id', $case_id);
	}
	
	function online_legal_consultation_agreement($id, $case_id=null){ //$id = user_id
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// $Case = $this->Case->read(null, $case_id);
		// debug($Case);
		
		$this->loadModel('User');
		$User = $this->User->find('first', array('conditions' => array('User.id' => $id)));
		
		$user_full_name = $User['PersonalInfo']['first_name'].' '.$User['PersonalInfo']['last_name'];
		
		$this->set('user_full_name', $user_full_name);
		$this->set('user_id', $id);
		$this->set('case_id', $case_id);
	}
}
?>