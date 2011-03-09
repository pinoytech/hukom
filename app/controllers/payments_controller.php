<?php
class PaymentsController extends AppController {

	var $name = 'Payments';
	var $components = array('Email', 'Custom');
	
	
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
	
	function bank_deposit($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Update Payment Details
		if (!empty($this->data)) {
			//debug($this->data);
			// exit;		
			
			//Delete data when browser back button is pressed
			if (isset($this->data['Payment']['case_detail_id'])) {
				$this->Payment->deleteAll(array('Payment.case_detail_id' => $this->data['Payment']['case_detail_id']));
			}
			
			// Save Bank Details
			$this->Payment->id = $this->data['Payment']['id'];
			if ($this->Payment->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));
				$this->redirect(array('action' => $this->data['Payment']['goto'], $this->data['Payment']['user_id'], $this->data['Payment']['case_id'], $this->data['Payment']['case_detail_id'], $this->Payment->id));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}
			
			$this->data = $this->Payment->read(null, $payment_id);

		}
		if (empty($this->data)) {
			$this->data = $this->Payment->read(null, $payment_id);
		}
		
		$upload_folder = "/app/webroot/uploads/$id/$case_id/$case_detail_id/bankdeposit";
		
		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);
		$this->set('upload_folder', $upload_folder);
		$this->set('files', $this->Custom->show_files($upload_folder));
	}
	
	function bank_deposit_summary($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}

		$Payment = $this->Payment->find('first', array('conditions' => array('Payment.case_detail_id' => $case_detail_id)));

		// debug($Legalcase);
		
		$upload_folder = "/app/webroot/uploads/$id/$case_id/$case_detail_id/bankdeposit";

		$this->set('Payment', $Payment);
		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);
		$this->set('payment_id', $payment_id);
		$this->set('upload_folder', $upload_folder);
		$this->set('files', $this->Custom->show_files($upload_folder));
	}
	
	function bank_deposit_confirmation($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){
		
		//Clear Legalcase.legal_service Session
		$this->Session->write('Legalcase.legal_service', '');
        
        //Send Confirmation To Admin
        $this->_send_admin_payment_confirmation($id, 'Bank Deposit');
        
        // debug($this->admin_email);
		
		$this->set('id', $id);
	}
	
	function _send_admin_payment_confirmation($id, $option) {
		$this->loadModel('User');
		
		if ($option == 'Bank Deposit') {
            $subject = 'Bank Deposit Payment';
            $template = 'bank_deposit_confirmation';
		}
		
		$User                          = $this->User->read(null,$id);
		$this->Email->to               = $this->admin_email;
		$this->Email->bcc              = array('gino.carlo.cortez@gmail.com'); 
		$this->Email->subject          = 'E-Lawyers Online - ' . $subject;
		$this->Email->replyTo          = 'no-reply@e-laywersonline.com';
		$this->Email->from             = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template         = $template; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs           = 'html'; // because we like to send pretty mail

	    //Set view variables as normal
	    $this->set('User', $User);
	    //Do not pass any args to send()
	    $this->Email->send();
	 }
}
?>