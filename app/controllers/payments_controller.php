<?php
class PaymentsController extends AppController {

  var $name       = 'Payments';
  var $components = array('Email', 'Custom');
  var $helpers    = array('Custom');

  function beforeFilter() {
    parent::beforeFilter(); 
    // $this->Auth->allowedActions = array('index', 'view');
  }

  function admin_index($id=null) {

    $this->Payment->recursive = 0;		
    // $this->paginate['conditions'][] = $conditions;
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
    $fxMerchantID = '1027626';
    $fcusername = 'elawyer';
    $fcpassword = 'elawyer';
    $fxMerchantID = '1027626';
    $fcusername = 'elawyer';
    $fcpassword = 'elawyer';
    $fcCustomerName = $User['PersonalInfo']['first_name'] . '-' . $User['PersonalInfo']['last_name'] ;
    $fcEmailAddress = $User['User']['username'];
    $fcMerchantTxnID = $id . '-' . $case_id . '-' . $case_detail_id; 
    $fxProdID = $case_detail_id;
    $fcProductCode = $case_id;
    $fcDescription = $Legalcasedetail['Legalcasedetail']['legal_service'];

    if ($cashsense_type == 'OTC') {
      $cashsense_post_url = 'https://merchantapidev.cashsense.com/MerchantFormPost.aspx';
    }
    elseif ($cashsense_type == 'eWallet') {
      $cashsense_post_url = 'https://merchantapidev.cashsense.com/MerchantFormPostWallet.aspx';
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
    Merchant Transaction ID: <input id="fcMerchantTxnID" type="text" name="fcMerchantTxnID" value="'.$fcMerchantTxnID.'"/><br>
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
}
?>
