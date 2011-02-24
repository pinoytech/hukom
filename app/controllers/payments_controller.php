<?php
class PaymentsController extends AppController {

	var $name = 'Payments';
	var $uses = 'Bankdeposit';
	
	function beforeFilter() {
	    parent::beforeFilter(); 
	    // $this->Auth->allowedActions = array('index', 'view');

	}

	function index() {
		parent::redirect_to_admin_index(); 
		
		// debug($this->Auth_user);
		
		$this->set('id', $this->Auth_user['User']['id']);

	}

	function mode_of_payment($id=null, $case_id=null, $case_detail_id=null) { //$id = user_id
		
		// Update Payment Details
		if (!empty($this->data)) {			
			// debug($this->data);
			// exit;
			// $this->redirect(array('action' => $this->data['Payment']['option'], $this->data['Payment']['user_id'], $this->data['Payment']['case_id'], $this->data['Payment']['deposit_id']));
			$this->redirect(array('action' => $this->data['Payment']['option'], $this->data['Payment']['user_id'], $this->data['Payment']['case_id'], $this->data['Payment']['case_detail_id']));
		}
		
		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);

	}
	
	function bank_deposit($id=null, $case_id=null, $case_detail_id=null){
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Update Payment Details
		if (!empty($this->data)) {
			//debug($this->data);
			// exit;		
			
			// Save Bank Details
			$this->Bankdeposit->id = $this->data['Bankdeposit']['id'];
			if ($this->Bankdeposit->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));
				$this->redirect(array('action' => $this->data['Payment']['goto'], $this->data['Bankdeposit']['user_id'], $this->data['Bankdeposit']['case_id'], $this->data['Bankdeposit']['case_detail_id']));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}
			
			$this->data = $this->Bankdeposit->read(null, $case_detail_id);

		}
		if (empty($this->data)) {
			$this->data = $this->Bankdeposit->read(null, $case_detail_id);
		}
		
		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);
	}
	
	function bank_deposit_summary($id=null, $case_id=null, $case_detail_id=null){

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}

		$Bankdeposit = $this->Bankdeposit->find('first', array('conditions' => array('Bankdeposit.case_detail_id' => $case_detail_id)));

		// debug($Legalcase);

		$this->set('Bankdeposit', $Bankdeposit);
		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);
	}
	
	function bank_deposit_confirmation($id=null, $case_id=null, $deposit_id=null){

		$this->Bankdeposit->id = $deposit_id;
		$this->Bankdeposit->set('status', 'submit');
		$this->Bankdeposit->save();
	}
	
}
?>