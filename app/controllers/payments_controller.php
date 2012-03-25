<?php
class PaymentsController extends AppController {

    var $name       = 'Payments';
    var $components = array('Email', 'Custom');
    var $helpers    = array('Custom');

    function beforeFilter() {
        parent::beforeFilter(); 
        $this->Auth->allowedActions = array('cashsense_receiving_page');
    }
    
    //Search
    function admin_search() {
  		// the page we will redirect to
  		$url['action'] = 'index';

  		// build a URL will all the search elements in it
  		// the resulting URL will be 
  		// example.com/cake/posts/index/Search.keywords:mykeyword/Search.tag_id:3
  		foreach ($this->data as $k=>$v){ 
  			foreach ($v as $kk=>$vv){ 
  				$url[$k.'.'.$kk]=$vv; 
  			} 
  		}

  		// redirect the user to the url
  		$this->redirect($url, null, true);
    }

    function admin_index($id=null) {
      
      // we want to set a title containing all of the 
   		// search criteria used (not required)		
   		$title = array();

   		//
   		// filter by id
   		//
   		if(isset($this->passedArgs['Search.id'])) {
   			// set the conditions
   			$this->paginate['conditions'][]['Payment.id'] = $this->passedArgs['Search.id'];

   			// set the Search data, so the form remembers the option
   			$this->data['Search']['id'] = $this->passedArgs['Search.id'];

   			// set the Page Title (not required)
   			$title[] = __('ID',true).': '.$this->passedArgs['Search.id'];
   		}
   		
   		//
   		// filter by Case ID
   		//
   		if(isset($this->passedArgs['Search.case_id'])) {
   			// set the conditions
   			$this->paginate['conditions'][]['Legalcase.id'] = $this->passedArgs['Search.case_id'];

   			// set the Search data, so the form remembers the option
   			$this->data['Search']['case_id'] = $this->passedArgs['Search.case_id'];

   			// set the Page Title (not required)
   			$title[] = __('Case ID',true).': '.$this->passedArgs['Search.case_id'];
   		}

   		//
   		// filter by Case Detail ID
   		//
   		if(isset($this->passedArgs['Search.case_detail_id'])) {
   			// set the conditions
   			$this->paginate['conditions'][]['Legalcasedetail.id'] = $this->passedArgs['Search.case_detail_id'];

   			// set the Search data, so the form remembers the option
   			$this->data['Search']['case_detail_id'] = $this->passedArgs['Search.case_detail_id'];

   			// set the Page Title (not required)
   			$title[] = __('Case Detail ID',true).': '.$this->passedArgs['Search.case_detail_id'];
   		}   		

   		//
   		// filter by keywords
   		//
   		if(isset($this->passedArgs['Search.keywords'])) {
   			$keywords = $this->passedArgs['Search.keywords'];
   			$this->paginate['conditions'][] = array(
   				'OR' => array(
   					'User.username LIKE' => "%$keywords%",
   					'User.referred_by LIKE' => "%$keywords%",
   					'Legalcasedetail.legal_service LIKE' => "%$keywords%",
   					'Payment.option LIKE' => "%$keywords%",
   					'Payment.bank_name LIKE' => "%$keywords%",
   					'Payment.bank_branch LIKE' => "%$keywords%",
   					'Payment.bank_country LIKE' => "%$keywords%",
   					'Payment.amount LIKE' => "%$keywords%",
   					'Payment.reference_no LIKE' => "%$keywords%",
   					'Payment.cellphone_no LIKE' => "%$keywords%",
   					'Payment.gcash_type LIKE' => "%$keywords%",
   					'Payment.smartmoney_type LIKE' => "%$keywords%",
   					'Payment.cashsense_type LIKE' => "%$keywords%",
   					'Payment.check_cash_address LIKE' => "%$keywords%",
   					'Payment.check_cash_contact_person LIKE' => "%$keywords%",
   					'Payment.telephone_no LIKE' => "%$keywords%",
   				)
   			);
   			$this->data['Search']['keywords'] = $keywords;
   			$title[] = __('Keywords',true).': '.$keywords;
   		}

   		//
   		// filter by username
   		//
   		if(isset($this->passedArgs['Search.username'])) {
   			$this->paginate['conditions'][]['User.username LIKE'] = '%'.$this->passedArgs['Search.username'].'%';
   			$this->data['Search']['username'] = $this->passedArgs['Search.username'];
   			$title[] = __('Username',true).': '.$this->passedArgs['Search.username'];
   		}

   		//
   		// filter by legal service
   		//
   		if(isset($this->passedArgs['Search.legal_service'])) {
   		  
   		  if ($this->passedArgs['Search.legal_service'] == 'Case Retainer') {
   		    $this->passedArgs['Search.legal_service'] = 'Case/Project Retainer';
   		  }
   		  
   			$this->paginate['conditions'][]['Legalcasedetail.legal_service LIKE'] = $this->passedArgs['Search.legal_service'];
   			$this->data['Search']['legal_service'] = $this->passedArgs['Search.legal_service'];
   			$title[] = __('Legal Service',true).': '.$this->passedArgs['Search.legal_service'];
   		}
   		
   		//
   		// filter by option
   		//
   		if(isset($this->passedArgs['Search.option'])) {
   		  
   		  if ($this->passedArgs['Search.option'] == 'Check Cash Pick up') {
   		    $this->passedArgs['Search.option'] = 'Check/Cash Pick up';
   		  }
   		  
   			$this->paginate['conditions'][]['Payment.option LIKE'] = $this->passedArgs['Search.option'];
   			$this->data['Search']['option'] = $this->passedArgs['Search.option'];
   			$title[] = __('Option',true).': '.$this->passedArgs['Search.option'];
   		}

   		//
   		// filter by status
   		//
   		if(isset($this->passedArgs['Search.status'])) {   		  
   			$this->paginate['conditions'][]['Payment.status LIKE'] = $this->passedArgs['Search.status'];
   			$this->data['Search']['status'] = $this->passedArgs['Search.status'];
   			$title[] = __('Status',true).': '.$this->passedArgs['Search.status'];
   		}

   		//
   		// filter by Amount
   		//
   		if(isset($this->passedArgs['Search.amount'])) {
   			$this->paginate['conditions'][]['Payment.amount LIKE'] = '%'.$this->passedArgs['Search.amount'].'%';
   			$this->data['Search']['amount'] = $this->passedArgs['Search.amount'];
   			$title[] = __('Payment',true).': '.$this->passedArgs['Search.amount'];
   		}

   		//
   		// filter by created
   		//
   		if(isset($this->passedArgs['Search.created'])) {
        $this->paginate['conditions'][] = array("date(Payment.created) = '".$this->passedArgs['Search.created']."'");
   			$this->data['Search']['created'] = $this->passedArgs['Search.created'];
   			$title[] = __('Created',true).': '.$this->passedArgs['Search.created'];
   		}

   		//
   		// filter by date range
   		//
   		if(isset($this->passedArgs['Search.start_date']) && isset($this->passedArgs['Search.end_date'])) {
        $this->paginate['conditions'][] = array(
   				'OR' => array(
   					"Payment.created >= '".$this->passedArgs['Search.start_date']."'
   					AND Payment.created <= '".$this->passedArgs['Search.end_date']."'"
   				)
   			);
   			$this->data['Search']['start_date'] = $this->passedArgs['Search.start_date'];
   			$this->data['Search']['end_date'] = $this->passedArgs['Search.end_date'];
   			$title[] = __('Start Date',true).': '.$this->passedArgs['Search.start_date'];
   			$title[] = __('End Date',true).': '.$this->passedArgs['Search.end_date'];
   		}

  		$title = implode(' | ',$title);
  		$this->set(compact('title'));

      $this->Payment->recursive = 0;		
      $this->paginate['order'][] = array('Payment.id' => 'desc');
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

        if (!empty($this->data)) {

            //Check confirmed value
            if ($this->data['Payment']['status'] == 'Confirmed') {

                if ($this->data['Payment']['confirmed'] != 1) {

                    //Get Event
                    $this->loadModel('Event');
                    $Event = $this->Event->findByCaseDetailId($this->data['Payment']['case_detail_id']);

                    //Check if Video or Office
                    if ($this->data['Legalcasedetail']['legal_service'] == 'Video Conference' || $this->data['Legalcasedetail']['legal_service'] == 'Office Conference') {
                        $this->_send_on_time_payment_confirmation($this->data['Payment']['user_id'], $this->data['Payment']['case_id'], $Event['Event']['id'], $Event['Event']['conference']);
                    }
                    elseif ($this->data['Legalcasedetail']['legal_service'] == 'Per Query') { 
                        //Send Confirmation Email for Per Query
                        $this->_send_payment_confirmation($this->data['Payment']['user_id'], $this->data['Payment']['case_id']);
                        $this->data['Payment']['confirmed'] = 1;
                    }

                    $email_sent_alert = ' and payment confirmation email is sent to the user';
                }
            }

            //Monthly/Case Overdue
            if ($this->data['Payment']['status'] == 'Overdue') {
                if ($this->data['Legalcasedetail']['legal_service'] == 'Monthly Retainer' || $this->data['Legalcasedetail']['legal_service'] == 'Case/Project Retainer') {
                    //Send Overdue Email
                    // exit;
                    $this->_send_overdue_confirmation($this->data['Payment']['user_id'], $this->data['Payment']['case_detail_id']);                    
                    $email_sent_alert = ' and payment overdue confirmation email is sent to the user';
                }
            }

            unset($this->data['Legalcasedetail']);

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
            // debug($this->data);
        }

    }

    //Per Query Email Confirmation
    function _send_payment_confirmation($id, $case_id) {
        $this->loadModel('User');

        $User                  = $this->User->read(null,$id);
        $this->Email->to       = $User['User']['username'];
        $this->Email->bcc      = $this->admin_email;  
        $this->Email->subject  = 'E-Lawyers Online - Per Query Payment Confirmation';
        $this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
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
        // debug($this->data);
        // Update Payment Details
        if (!empty($this->data)) {			
            // debug($this->data);
            // exit;    
            // $this->redirect(array('action' => $this->data['Payment']['option'], $this->data['Payment']['user_id'], $this->data['Payment']['case_id'], $this->data['Payment']['deposit_id']));
            $this->redirect(array('action' => $this->data['Payment']['option'], $this->data['Payment']['user_id'], $this->data['Payment']['case_id'], $this->data['Payment']['case_detail_id']));
        }

        //Get Events
        $this->loadModel('Event');        
        $Event = $this->Event->findByCaseDetailId($case_detail_id);		

        if ($Event) {
            $no_of_hours = $this->Custom->date_difference($Event['Event']['start'], $Event['Event']['end'], 'h');
            $this->set('fee', (float)$this->_get_legal_service_fee($case_detail_id) * $no_of_hours);
        }
        else {
            $this->set('fee', $this->_get_legal_service_fee($case_detail_id));
        }

        $this->set('id', $id);
        $this->set('case_id', $case_id);
        $this->set('case_detail_id', $case_detail_id);
        // $this->set('base_url', 'http://'.$_SERVER['SERVER_NAME'].Router::url('/'));

        //Get Service Type
        $this->loadModel('Legalcasedetail');
        $Legalcasedetail = $this->Legalcasedetail->findById($case_detail_id);
        $this->set('legal_service', $Legalcasedetail['Legalcasedetail']['legal_service']);

    }

    function bank_deposit($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){
        $this->_save_payment_details($this->data, $id, $case_id, $case_detail_id, $payment_id, 'bank_deposit');	        
    }

    function gcash($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){
        $this->_save_payment_details($this->data, $id, $case_id, $case_detail_id, $payment_id, 'gcash');

        //Get Events
        $this->loadModel('Event');        
        $Event = $this->Event->findByCaseDetailId($case_detail_id);

        if ($Event) {
            $no_of_hours = $this->Custom->date_difference($Event['Event']['start'], $Event['Event']['end'], 'h');
            $this->set('fee', (float)$this->_get_legal_service_fee($case_detail_id) * $no_of_hours);
        }
        else {
            $this->set('fee', $this->_get_legal_service_fee($case_detail_id));
        }

    }

    function smartmoney($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){
        $this->_save_payment_details($this->data, $id, $case_id, $case_detail_id, $payment_id, 'smartmoney');

        //Get Events
        $this->loadModel('Event');        
        $Event = $this->Event->findByCaseDetailId($case_detail_id);		

        if ($Event) {
            $no_of_hours = $this->Custom->date_difference($Event['Event']['start'], $Event['Event']['end'], 'h');
            $this->set('fee', (float)$this->_get_legal_service_fee($case_detail_id) * $no_of_hours);
        }
        else {
            $this->set('fee', $this->_get_legal_service_fee($case_detail_id));
        }
    }

    function check_cash($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){
        $this->_save_payment_details($this->data, $id, $case_id, $case_detail_id, $payment_id, 'check_cash');	  
    }

    function _save_payment_details($data, $id=null, $case_id=null, $case_detail_id=null, $payment_id=null, $payment_option=null) {
        // debug($payment_option);
        // debug($data);
        // exit;
        // debug($this->params);

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

            if (!empty($payment_id)) {
                $this->data = $this->Payment->read(null, $payment_id);
            }

            // debug($this->data);
        }

        $upload_folder = $this->uploads_path . "$id/$case_id/$case_detail_id/bankdeposit";

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
        elseif ($payment_option == 'check_cash') {
            $payment_option_name = 'Check/Cash Pick up';
        }

        $this->set('id', $id);
        $this->set('payment_option_name', $payment_option_name);
        $this->set('payment_option', $payment_option);
    }

    function bank_deposit_summary($id=null, $case_id=null, $case_detail_id=null, $payment_id=null){

        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid user', true));
            $this->redirect(array('action' => 'index'));
        }

        $Payment = $this->Payment->find('first', array('conditions' => array('Payment.case_detail_id' => $case_detail_id)));

        // debug($Legalcase);

        $upload_folder = $this->uploads_path . "$id/$case_id/$case_detail_id/bankdeposit";

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
        elseif ($payment_option == 'check_cash') {
            $subject = 'Check/Cash Pick up Payment';
        }

        $User                          = $this->User->read(null,$id);
        $this->Email->to               = $this->admin_email;
        //$this->Email->bcc              = array('gino.carlo.cortez@gmail.com'); 
        $this->Email->subject          = 'E-Lawyers Online - ' . $subject;
        $this->Email->replyTo          = 'no-reply@e-lawyersonline.com';
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

    //Mailer
    function _send_overdue_confirmation($id, $case_detail_id) {		
        $this->loadModel('User');
        $this->loadModel('Legalcasedetail');

        $User                  = $this->User->read(null,$id);
        $Legalcasedetail       = $this->Legalcasedetail->read(null,$case_detail_id);

        if ($Legalcasedetail['Legalcasedetail']['legal_service'] == 'Monthly Retainer') {
            $subject  = 'Monthly Retainer Overdue Confirmation';
            $template = 'overdue_monthly';
        }
        elseif ($Legalcasedetail['Legalcasedetail']['legal_service'] == 'Case/Project Retainer') {
            $subject  = 'Case/Project Retainer Overdue Confirmation';
            $template = 'overdue_case';
        }

        $this->Email->to       = $User['User']['username'];
        $this->Email->bcc      = $this->admin_email;  
        $this->Email->subject  = "E-Lawyers Online - $subject";
        $this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
        $this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
        $this->Email->additionalParams = '-finfo@e-lawyersonline.com';
        $this->Email->template = $template; // note no '.ctp'
        //Send as 'html', 'text' or 'both' (default is 'text')
        $this->Email->sendAs   = 'html'; // because we like to send pretty mail
        //Set view variables as normal
        $this->set('User', $User);
        $this->set('Legalcasedetail', $Legalcasedetail);
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
            'amount' => $_POST['amount']
        );

        // Save Bank Details
        $this->Payment->create();
        $this->Payment->save($data);

        $this->autoRender=false;
    }

    function create_cashsense_payment($id, $case_id, $case_detail_id, $cashsense_type, $amount) {
        //1019/1035/1030
        //$_POST['id'] = 1019;
        //$_POST['case_id'] = 1035;
        //$_POST['case_detail_id'] = 1030-1;
        //$_POST['amount'] = '100.00';

        //Create Payment Details
        $this->Payment->validate = array();
        $this->Payment->deleteAll(array('Payment.case_detail_id' => $case_detail_id));

        $data['Payment'] = array(
            'user_id' => $id,
            'case_id' => $case_id,
            'case_detail_id' => $case_detail_id,
            'option' => 'Cashsense',
            'cashsense_type' => $cashsense_type,
            'amount' => $amount
        );

        //debug($data['Payment']);

        // Save Bank Details
        $this->Payment->create();
        $this->Payment->save($data);

        //Get User Data
        $this->loadModel('User');
        $this->loadModel('Legalcasedetail');

        $User = $this->User->findById($id);
        $Legalcasedetail = $this->Legalcasedetail->findById($case_detail_id);
        //$fxMerchantID = '1027626'; //Dev
        $fxMerchantID = '1031505'; //Live
        //$fcpassword = 'elawyer'; //Dev
        $fcusername = 'elawyers'; //Live
        $fcpassword = 'YwXzes'; //Live
        $fcCustomerName = $User['PersonalInfo']['first_name'] . '-' . $User['PersonalInfo']['last_name'] ;
        $fcEmailAddress = $User['User']['username'];
        $fcMerchantTxnID = $id . '-' . $case_id . '-' . $case_detail_id; 
        $fxProdID = $case_detail_id;
        $fcProductCode = $case_id;
        $fcDescription = 'E-Lawyers Online - ' . $Legalcasedetail['Legalcase']['legal_problem'] . ' - ' . $Legalcasedetail['Legalcasedetail']['legal_service'];

        if ($cashsense_type == 'OTC') {
            //$cashsense_post_url = 'https://merchantapidev.cashsense.com/MerchantFormPost.aspx'; //Dev
            $cashsense_post_url = 'https://merchantapi.cashsense.com/MerchantFormPost.aspx'; //Live
        }
        elseif ($cashsense_type == 'eWallet') {
            //$cashsense_post_url = 'https://merchantapidev.cashsense.com/MerchantFormPostWallet.aspx'; //Dev
            $cashsense_post_url = 'https://merchantapi.cashsense.com/MerchantFormPostWallet.aspx';
        }

        //debug($this->params);
        //debug($User);
        //debug($Legalcasedetail);
        //exit;

        //Cashsense Stuff
    /*
    $ch = curl_init($cashsense_post_url);
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_POSTFIELDS,
      'fxMerchantID='.$fxMerchantID.
      '&fcusername='.$fcusername .
      '&fcpassword='.$fcpassword.
      '&fcCustomerName='.$fcCustomerName.
      '&fcEmailAddress='.$fcEmailAddress.
      '&fnAmount='.$amount.
      '&fcMerchantTxnID='.$fcMerchantTxnID.
      '&fxProdID='.$fxProdID.
      '&fcProductCode='.$fcProductCode.
      '&fnProdQty='.'1'.
      '&fcDescription='.$fcDescription
    );
    curl_exec ($ch);
    curl_close ($ch);
     */

        $cashsense_form = '<form action="'.$cashsense_post_url.'" method="post" id="cashsense_form" name="cashsense_form">
            Merchant ID: <input id="fxMerchantID" type="hidden" name="fxMerchantID" value="'.$fxMerchantID.'" /><br>
            Username: <input id="fcusername" type="hidden" name="fcusername" value="'.$fcusername.'"/><br>
            Password: <input id="fcpassword" type="hidden" name="fcpassword" value="'.$fcpassword.'"/><br>
            Customer Name: <input id="fcCustomerName" type="hidden" name="fcCustomerName" value="'.$fcCustomerName.'" /><br>
            Email: <input id="Text1" type="hidden" name="fcEmailAddress" value="'.$fcEmailAddress.'" /><br>
            Amount: <input id="fnAmount" type="hidden" name="fnAmount" value="'.$amount.'"/><br> <br>
            Merchant Transaction ID: <input id="fcMerchantTxnID" type="hidden" name="fcMerchantTxnID" value="'.$fcMerchantTxnID.'"/><br>
            Product ID: <input id="fxProdID" type="hidden" name="fxProdID" value="'.$fxProdID.'"/><br>
            Product Code: <input id="fcProductCode" type="hidden" name="fcProductCode" value="'.$fcProductCode.'" /><br>
            Product Quantity: <input id="fnProdQty" type="hidden" name="fnProdQty" value="1" /><br>
            Product Description: <input id="fcDescription" type="hidden" name="fcDescription" value="'.$fcDescription.'"/><br>
            </form>';

        Configure::write('debug', 0);
        $this->autoRender = false;
        $this->autoLayout = false;
        echo $cashsense_form;
    }

    function cashsense_receiving_page(){
        if ($_POST) {
      /*
      echo 'sRespCode = ' . $_POST['sRespCode'];
      echo '<br>';
      echo 'sRespCode = ' .$_POST['sCSTxnID'];
      echo '<br>';
      echo 'sRespCode = ' .$_POST['sMerchantTxnID'];
      echo '<br>';
      echo 'sRespCode = ' .$_POST['isPaid'];
       */
        }

        $this->set('id', $this->Auth_user['User']['id']);
        $this->set('sRespCode', $_POST['sRespCode']);
        $this->set('sCSTxnID', $_POST['sCSTxnID']);
        $this->set('sMerchantTxnID', $_POST['sMerchantTxnID']);
        $this->set('isPaid', $_POST['isPaid']);

    }
}
?>
