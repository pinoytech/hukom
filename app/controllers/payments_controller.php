<?php
class PaymentsController extends AppController {

	var $name = 'Payments';
	
	function beforeFilter() {
	    parent::beforeFilter(); 
	    // $this->Auth->allowedActions = array('index', 'view');

	}

	function index() {
		parent::redirect_to_admin_index(); 
		
		// debug($this->Auth_user);
		
		$this->set('id', $this->Auth_user['User']['id']);

	}

	function select_option($id, $case_id, $payment_id=null) { //$id = user_id
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Update Payment Details
		if (!empty($this->data)) {
			debug($this->data);
			// exit;		
			
			$this->Payment->id = $this->data['Payment']['id'];
			
			if ($this->Payment->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));
				// $this->redirect(array('action' => 'summary_of_information', $id, $this->Payment->id));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}
			
			$this->data = $this->Payment->read(null, $payment_id);

		}
		if (empty($this->data)) {
			$this->data = $this->Payment->read(null, $payment_id);
		}
		
		$this->set('user_id', $id);
		$this->set('case_id', $case_id);
	}
}
?>