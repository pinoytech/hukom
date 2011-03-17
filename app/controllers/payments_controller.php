<?php
class PaymentsController extends AppController {

	var $name = 'Payments';
	var $components = array('Email', 'Custom');
	
	
	function beforeFilter() {
	    parent::beforeFilter(); 
	    // $this->Auth->allowedActions = array('index', 'view');

	}
	
	function admin_index($id=null) {
		
		$this->Payment->recursive = 0;		
        // $this->paginate['conditions'][] = $conditions;
		$this->set('Payments', $this->paginate());
	}
	
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->set('Payment', $this->Payment->read(null, $id));
	}

    function admin_edit($id) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Payment Option', true));
			$this->redirect(array('action' => 'index'));
		}
		
        // debug($this->data);
        // exit;
		
		if (!empty($this->data)) {
		    
		    //Check confirmed value
			if ($this->data['Payment']['status'] == 'Confirmed') {

				if ($this->data['Payment']['confirmed'] != 1) {					

					//Send Confirmation Email
					$this->_send_payment_confirmation($this->data['Payment']['user_id'], $this->data['Payment']['case_id']);
					$this->data['Payment']['confirmed'] = 1;
					$email_sent_alert = ' and payment confirmation email is sent to the user';
					
				}
			}
			
			$this->Payment->validate = array();
			
			//Update case data
			$this->Payment->id = $this->data['Payment']['id'];
			if ($this->Payment->saveAll($this->data)) {

				$this->Session->setFlash(__('The Payment Option has been saved' . $email_sent_alert, true));

				$this->redirect(array('admin' => true, 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment option could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Payment->read(null, $id);
		}
		
	}
	
	function _send_payment_confirmation($id, $case_id) {
		$this->loadModel('User');
		
		$User                  = $this->User->read(null,$id);
		$this->Email->to       = $User['User']['username'];
		$this->Email->bcc      = array('gino.carlo.cortez@gmail.com');  
		$this->Email->subject  = 'E-Lawyers Online - Payment Confirmation';
		$this->Email->replyTo  = 'no-reply@e-laywersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = 'payment_confirmation'; // note no '.ctp'
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
		if ($this->Payment->delete($id)) {
			$this->Session->setFlash(__('Payment Option deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Payment Option not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function index() {
		parent::redirect_to_admin_index(); 
		
		// debug($this->Auth_user);
		
		$this->set('id', $this->Auth_user['User']['id']);

	}
    
    function _get_legal_service_fee($case_detail_id) {
        $this->loadModel('Legalcasedetail');
	    $Legalcasedetail = $this->Legalcasedetail->find('first', array('conditions' => array('Legalcasedetail.id' => $case_detail_id)));

        $this->loadModel('Legalservice');
	    $Legalservice = $this->Legalservice->find('first', array('conditions' => array('Legalservice.name' => $Legalcasedetail['Legalcasedetail']['legal_service'])));
	    
	    return $Legalservice['Legalservice']['fee'];
    }
    
	function mode_of_payment($id=null, $case_id=null, $case_detail_id=null) { //$id = user_id
		
		// Update Payment Details
		if (!empty($this->data)) {			
			// debug($this->data);
			// exit;
			// $this->redirect(array('action' => $this->data['Payment']['option'], $this->data['Payment']['user_id'], $this->data['Payment']['case_id'], $this->data['Payment']['deposit_id']));
			$this->redirect(array('action' => $this->data['Payment']['option'], $this->data['Payment']['user_id'], $this->data['Payment']['case_id'], $this->data['Payment']['case_detail_id']));
		}
		
		$this->set('fee', $this->_get_legal_service_fee($case_detail_id));
		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);
        $this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));

	}
	
	function bank_deposit($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){
	    $this->_save_payment_details($this->data, $id, $case_id, $case_detail_id, $payment_id, 'bank_deposit');	        
	}
	
	function gcash($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){
	    $this->_save_payment_details($this->data, $id, $case_id, $case_detail_id, $payment_id, 'gcash');
	    
	    $this->set('fee', $this->_get_legal_service_fee($case_detail_id));
	}
	
	function smartmoney($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){
	    $this->_save_payment_details($this->data, $id, $case_id, $case_detail_id, $payment_id, 'smartmoney');
	    
		$this->set('fee', $this->_get_legal_service_fee($case_detail_id));
	}
	
	function _save_payment_details($data, $id=null, $case_id=null, $case_detail_id=null, $payment_id=null, $payment_option=null) {
        // debug($payment_option);
        // debug($data);
        // exit;
	    
	    if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		// Update Payment Details
		if (!empty($this->data)) {
			
			$this->Payment->validate = array();
			
			//Delete data when browser back button is pressed
			if (isset($this->data['Payment']['case_detail_id'])) {
				$this->Payment->deleteAll(array('Payment.case_detail_id' => $this->data['Payment']['case_detail_id']));
			}
			
			// Save Bank Details
			$this->Payment->id = $this->data['Payment']['id'];
			if ($this->Payment->save($this->data)) {
				$this->redirect(array('action' => $this->data['Payment']['goto'], $this->data['Payment']['user_id'], $this->data['Payment']['case_id'], $this->data['Payment']['case_detail_id'], $this->Payment->id, $payment_option));
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
		
	function payment_confirmation($id=null, $case_id=null, $case_detail_id=null, $payment_id=null, $payment_option){
		
		//Clear Legalcase.legal_service Session
		$this->Session->write('Legalcase.legal_service', '');
        
        //Send Confirmation To Admin
        $this->_send_admin_payment_confirmation($id, $payment_option);
        
        if ($payment_option == 'bank_deposit') {
            $payment_option_name = 'Bank Deposit';
        }
        elseif ($payment_option == 'gcash') {
            $payment_option_name = 'Globe G-Cash';
        }
        elseif ($payment_option == 'smartmoney') {
            $payment_option_name = 'SmartMoney';
        }
        elseif ($payment_option == 'paypal') {
            $payment_option_name = 'Paypal';
        }
        		
		$this->set('id', $id);
		$this->set('payment_option_name', $payment_option_name);
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
	
	/*
	function bank_deposit_confirmation($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){
		
		//Clear Legalcase.legal_service Session
		$this->Session->write('Legalcase.legal_service', '');
        
        //Send Confirmation To Admin
        $this->_send_admin_payment_confirmation($id, 'Bank Deposit');
        
        // debug($this->admin_email);
		
		$this->set('id', $id);
	}
	*/
	
	function _send_admin_payment_confirmation($id, $payment_option) {
		$this->loadModel('User');
		
		if ($payment_option == 'bank_deposit') {
            $subject = 'Bank Deposit Payment';
		}
		elseif ($payment_option == 'gcash') {
            $subject = 'Globe G-Cash Payment';
		}
		elseif ($payment_option == 'smartmoney') {
            $subject = 'SmartMoney Payment';
		}
		elseif ($payment_option == 'paypal') {
            $subject = 'Paypal Payment';
		}
		
		$User                          = $this->User->read(null,$id);
		$this->Email->to               = $this->admin_email;
		$this->Email->bcc              = array('gino.carlo.cortez@gmail.com'); 
		$this->Email->subject          = 'E-Lawyers Online - ' . $subject;
		$this->Email->replyTo          = 'no-reply@e-laywersonline.com';
		$this->Email->from             = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template         = 'admin_payment_confirmation'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs           = 'html'; // because we like to send pretty mail

	    //Set view variables as normal
	    $this->set('User', $User);
	    $this->set('subject', $subject);
	    //Do not pass any args to send()
	    $this->Email->send();
	}
	
	function create_paypal_payment() {
	    
        //Create Payment Details
        $this->Payment->validate = array();

		$this->Payment->deleteAll(array('Payment.case_detail_id' => $_POST['case_detail_id']));
		
		$data['Payment'] = array(
			'user_id' => $_POST['id'],
			'case_id' => $_POST['case_id'],
			'case_detail_id' => $_POST['case_detail_id'],
			'option' => 'Paypal',
			'amount' => $this->_get_legal_service_fee($_POST['case_detail_id'])
			);
		
		// Save Bank Details
		$this->Payment->create();
		$this->Payment->save($data);
	    
	    $this->autoRender=false;
	}
}
?>