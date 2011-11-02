<?php
App::import('Sanitize');
class EventsController extends AppController {
  var $name       = 'Events';
  var $components = array('Email', 'Custom');
  var $helpers    = array('Custom');

  function beforeFilter() {
    parent::beforeFilter(); 
    // $this->Auth->allowedActions = array('index', 'view');
  }

  function test_index() {

  }

  function index() {
    parent::redirect_to_admin_index(); 

    // debug($this->Auth_user);

    $this->set('id', $this->Auth_user['User']['id']);
    $this->set('username', $this->Auth_user['User']['username']);
    $this->set('dialog', false);
    $this->set('case_id', 1);
  }

  function admin_index() {

    // debug($this->Auth_user);

    $this->set('id', $this->Auth_user['User']['id']);
    $this->set('dialog', false);
    $this->set('case_id', 1);
  }

  function admin_request_reschedule_conference() {
    $this->loadModel('RequestReschedule');
    $this->RequestReschedule->recursive = 0;
    $this->paginate['limit'] = 10;
    $this->set('RequestReschedules', $this->paginate('RequestReschedule'));
  }

  function admin_delete_request_reschedule_conference($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for user', true));
      $this->redirect(array('action'=>'index'));
    }

    $this->loadModel('RequestReschedule');

    if ($this->RequestReschedule->delete($id)) {
      $this->Session->setFlash(__('Request deleted', true));
    }
    else {
      $this->Session->setFlash(__('Request was not deleted', true));
    }

    $this->redirect(array('action' => 'admin_request_reschedule_conference'));
  }

  //List for Late Payment - 3 days after the reserving the date (date of LOI creation) (ex: if crated today (plus 3 days))
  function admin_late_payments() {

    $this->paginate = array('joins' => array(
      array('table' => 'legal_case_details',
      'type' => 'LEFT',
      'conditions' => array(
        'legal_case_details.id = Event.case_detail_id',
      )),
      array('table' => 'payments',
      'alias' => 'Payment',
      'type' => 'LEFT',
      'conditions' => array(
        'Payment.case_detail_id = Event.case_detail_id',
      ))
    ),
    'conditions' => array(
      // 'DATE_ADD(Legalcasedetail.created, INTERVAL 4 DAY) <= NOW()',
      'DATE_ADD(legal_case_details.created, INTERVAL 4 DAY) <= NOW()',
      'Event.case_detail_id !=' => null,
      'Payment.case_detail_id ' => null,
      array(
        'OR' => array(
          array('Event.conference LIKE' => 'video'),
          array('Event.conference LIKE' => 'office')
        ),
      )),
    'limit' => 10
  );

    $Events = $this->paginate();

    $this->set('Events', $Events);
  }

  //List On Time Payments with Payment Status of Pending or Confirmed
  function admin_on_time_payments_list() {

    $this->paginate = array('joins' => array(
      array('table' => 'payments',
      'alias' => 'Payment',
      'type' => 'LEFT',
      'conditions' => array(
        'Payment.case_detail_id = Event.case_detail_id',
      )
    )),
    'conditions' => array(
      'OR' => array(
        array('Payment.status' => 'Pending'),
        array('Payment.status' => 'Confirmed'),
      ),
    ),
    'limit' => 10
  );

    $Events = $this->paginate('Event');

    $this->set('Events', $Events);
  }

  //Delete function via List
  function admin_delete_event() {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for user', true));
      $this->redirect(array('action'=>'index'));
    }
    if ($this->Event->delete($id)) {
      $this->Session->setFlash(__('Conference deleted', true));
      $this->redirect(array('action'=>'late_payments'));
    }
    $this->Session->setFlash(__('Conference not deleted', true));
    $this->redirect(array('action' => 'late_payments'));
  }

  function calendar_dialog($id, $case_id) {
    $this->set('dialog', true);
    $this->set('id', $id);
    $this->set('case_id', $case_id);
    $this->layout = 'calendar';
    $this->render('index');
  }

  function _create_json_array($events) {

    // debug($events);

    $rows = array();
    for ($a=0; count($events)> $a; $a++) {
      //Is it an all day event?
      $all = ($events[$a]['Event']['allDay'] == 1);

      //Assign Event Title
      if ($this->Auth_user['User']['group_id'] == 1) {

        $title = $events[$a]['Event']['title'] .' ('. ucfirst($events[$a]['PersonalInfo']['first_name'] . ' ' . $events[$a]['PersonalInfo']['last_name'] .')');
      }
      else {
        $title = $events[$a]['Event']['title'];
      }

      //Create an event entry
      $rows[] = array(
        'id'     => $events[$a]['Event']['id'],
        'title'  => $title,
        'start'  => date('Y-m-d H:i', strtotime($events[$a]['Event']['start'])),
        'end'    => date('Y-m-d H:i',strtotime($events[$a]['Event']['end'])),
        'allDay' => $all,
        'color'  => $events[$a]['Event']['color'],
        'case_detail_id'  => $events[$a]['Event']['case_detail_id'],
      );
    }

    return $rows;
  }

  function feed() {

    $options['fields'] = array(
      'Event.id',
      'Event.title',
      'Event.start',
      'Event.end',
      'Event.allDay',
      'Event.color',
      'Event.case_detail_id',
      'PersonalInfo.first_name',      
      'PersonalInfo.last_name',      
    );

    $options['joins'] = array(
      array('table' => 'personal_infos',
      'alias' => 'PersonalInfo',
      'type' => 'LEFT',
      'conditions' => array(
        'PersonalInfo.user_id = Event.user_id',
      )
    ),
  );

    //1. Transform request parameters to MySQL datetime format.
    $mysqlstart = date( 'Y-m-d H:i:s', $this->params['url']['start']);
    $mysqlend   = date('Y-m-d H:i:s', $this->params['url']['end']);

    //2. Get the events corresponding to the time range
    // $conditions = array('Event.start BETWEEN ? AND ?' => array($mysqlstart,$mysqlend), 
    $options['conditions'] = array('Event.start BETWEEN ? AND ?' => array($mysqlstart,$mysqlend));

    $events = $this->Event->find('all', $options);

    // debug($events);

    //3. Create the json array
    $rows = $this->_create_json_array($events);

    //4. Return as a json array
    Configure::write('debug', 0);
    $this->autoRender = false;
    $this->autoLayout = false;
    $this->header('Content-Type: application/json');
    echo json_encode($rows);
  }

  function pending_payment_feed() {

    $options['joins'] = array(
      array('table' => 'payments',
      'alias' => 'Payment',
      'type' => 'LEFT',
      'conditions' => array(
        'Payment.case_detail_id = Event.case_detail_id',
      )
    )
  );

    //1. Transform request parameters to MySQL datetime format.
    $mysqlstart = date( 'Y-m-d H:i:s', $this->params['url']['start']);
    $mysqlend   = date('Y-m-d H:i:s', $this->params['url']['end']);

    //2. Get the events corresponding to the time range
    $options['conditions'] = array('Event.start BETWEEN ? AND ?' => array($mysqlstart,$mysqlend),
      'Payment.status' => 'Pending'
    );

    $events = $this->Event->find('all', $options);

    // debug($events);

    //3. Create the json array
    $rows = $this->_create_json_array($events);

    //4. Return as a json array
    Configure::write('debug', 0);
    $this->autoRender = false;
    $this->autoLayout = false;
    $this->header('Content-Type: application/json');
    echo json_encode($rows);
  }

  function confirmed_payment_feed() {

    $options['joins'] = array(
      array('table' => 'payments',
      'alias' => 'Payment',
      'type' => 'LEFT',
      'conditions' => array(
        'Payment.case_detail_id = Event.case_detail_id',
      )
    )
  );

    //1. Transform request parameters to MySQL datetime format.
    $mysqlstart = date( 'Y-m-d H:i:s', $this->params['url']['start']);
    $mysqlend   = date('Y-m-d H:i:s', $this->params['url']['end']);

    //2. Get the events corresponding to the time range
    $options['conditions'] = array('Event.start BETWEEN ? AND ?' => array($mysqlstart,$mysqlend),
      'Payment.status' => 'Confirmed'
    );

    $events = $this->Event->find('all', $options);

    // debug($events);

    //3. Create the json array
    $rows = $this->_create_json_array($events);

    //4. Return as a json array
    Configure::write('debug', 0);
    $this->autoRender = false;
    $this->autoLayout = false;
    $this->header('Content-Type: application/json');
    echo json_encode($rows);
  }

  function not_active_feed() {

    //1. Transform request parameters to MySQL datetime format.
    $mysqlstart = date( 'Y-m-d H:i:s', $this->params['url']['start']);
    $mysqlend   = date('Y-m-d H:i:s', $this->params['url']['end']);

    //2. Get the events corresponding to the time range
    $options['conditions'] = array('Event.start BETWEEN ? AND ?' => array($mysqlstart,$mysqlend),
      'Event.case_detail_id' => null,
      array(
        'OR' => array(
          array('Event.conference LIKE' => 'video'),
          array('Event.conference LIKE' => 'office')
        ),
      ),
    );

    $events = $this->Event->find('all', $options);

    // debug($events);

    //3. Create the json array
    $rows = $this->_create_json_array($events);

    // 4. Return as a json array
    Configure::write('debug', 0);
    $this->autoRender = false;
    $this->autoLayout = false;
    $this->header('Content-Type: application/json');
    echo json_encode($rows);
  }

  function no_payment_status_feed() {

    $options['joins'] = array(
      array('table' => 'payments',
      'alias' => 'Payment',
      'type' => 'LEFT',
      'conditions' => array(
        'Payment.case_detail_id = Event.case_detail_id',
      )
    )
  );

    //1. Transform request parameters to MySQL datetime format.
    $mysqlstart = date( 'Y-m-d H:i:s', $this->params['url']['start']);
    $mysqlend   = date('Y-m-d H:i:s', $this->params['url']['end']);

    //2. Get the events corresponding to the time range
    $options['conditions'] = array('Event.start BETWEEN ? AND ?' => array($mysqlstart,$mysqlend),
      'Event.case_detail_id !=' => null,
      'Payment.case_detail_id ' => null,
      array(
        'OR' => array(
          array('Event.conference LIKE' => 'video'),
          array('Event.conference LIKE' => 'office')
        ),
      ),
    );

    $events = $this->Event->find('all', $options);

    // debug($events);

    //3. Create the json array
    $rows = $this->_create_json_array($events);

    // 4. Return as a json array
    Configure::write('debug', 0);
    $this->autoRender = false;
    $this->autoLayout = false;
    $this->header('Content-Type: application/json');
    echo json_encode($rows);
  }

  /*
  function add_event() {

        if (!empty($_POST)) {

      //check if resched conference
      if (isset($_POST['reschedule'])) {
        //Delete event
        $this->Event->delete($_POST['event_id']);
      }

            $this->Event->create();
      $this->data['Event']['title']              = Sanitize::paranoid($_POST['EventTitle'], array('!','\'','?','_','.',' ','-'));
      $this->data['Event']['allday']             = $_POST['EventAllday'];
      $this->data['Event']['start']              = $_POST['EventStart'];
      $this->data['Event']['end']                = $_POST['EventEnd'];
      $this->data['Event']['user_id']            = $_POST['EventUserId'];
      $this->data['Event']['case_id']            = $_POST['EventCaseId'];
      $this->data['Event']['case_detail_id']     = ($_POST['EventCaseDetailId']) ? $_POST['EventCaseDetailId'] : null;
      $this->data['Event']['editable']           = '1';
      $this->data['Event']['is_locked']          = '1';
      $this->data['Event']['calendar_id']        = $_POST['EventCalendarId'];
      $this->data['Event']['conference']         = $_POST['EventConference'];
      $this->data['Event']['color']              = $_POST['EventColor'];
      $this->data['Event']['messenger_type']     = $_POST['messenger_type'];
      $this->data['Event']['messenger_username'] = $_POST['messenger_username'];

            $this->Event->save($this->data);

      //Delete unused events


      Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
      echo $this->Event->id;
        }
    }
   */

  //Leter Of Intent: Save to temp_event
  function add_event() {

    if (!empty($_POST)) {

      $this->loadModel('TempEvent');

      $this->TempEvent->create();
      $this->data['TempEvent']['title']              = Sanitize::paranoid($_POST['EventTitle'], array('!','\'','?','_','.',' ','-'));
      $this->data['TempEvent']['allday']             = $_POST['EventAllday'];
      $this->data['TempEvent']['start']              = $_POST['EventStart'];
      $this->data['TempEvent']['end']                = $_POST['EventEnd'];
      $this->data['TempEvent']['user_id']            = $_POST['EventUserId'];
      $this->data['TempEvent']['case_id']            = $_POST['EventCaseId'];
      $this->data['TempEvent']['case_detail_id']     = ($_POST['EventCaseDetailId']) ? $_POST['EventCaseDetailId'] : null;
      $this->data['TempEvent']['editable']           = '1';
      $this->data['TempEvent']['is_locked']          = '1';
      $this->data['TempEvent']['calendar_id']        = $_POST['EventCalendarId'];
      $this->data['TempEvent']['conference']         = $_POST['EventConference'];
      $this->data['TempEvent']['color']              = $_POST['EventColor'];
      $this->data['TempEvent']['messenger_type']     = $_POST['messenger_type'];
      $this->data['TempEvent']['messenger_username'] = $_POST['messenger_username'];

      $this->TempEvent->save($this->data);

      $this->Session->write('TempEvent.id', $this->TempEvent->id);

      Configure::write('debug', 0);
      $this->autoRender = false;
      $this->autoLayout = false;
      echo $this->TempEvent->id;
    }
  }

  function reschedule_event() {

    if (!empty($_POST)) {

      $this->Event->delete($_POST['event_id']);

      $this->Event->create();
      $this->data['Event']['title']              = Sanitize::paranoid($_POST['EventTitle'], array('!','\'','?','_','.',' ','-'));
      $this->data['Event']['allday']             = $_POST['EventAllday'];
      $this->data['Event']['start']              = $_POST['EventStart'];
      $this->data['Event']['end']                = $_POST['EventEnd'];
      $this->data['Event']['user_id']            = $_POST['EventUserId'];
      $this->data['Event']['case_id']            = $_POST['EventCaseId'];
      $this->data['Event']['case_detail_id']     = ($_POST['EventCaseDetailId']) ? $_POST['EventCaseDetailId'] : null;
      $this->data['Event']['editable']           = '1';
      $this->data['Event']['is_locked']          = '1';
      $this->data['Event']['calendar_id']        = $_POST['EventCalendarId'];
      $this->data['Event']['conference']         = $_POST['EventConference'];
      $this->data['Event']['color']              = $_POST['EventColor'];
      $this->data['Event']['messenger_type']     = $_POST['messenger_type'];
      $this->data['Event']['messenger_username'] = $_POST['messenger_username'];

      if ($_POST['old_event_id']) {
        $this->loadModel('RequestReschedule');
        $this->RequestReschedule->deleteAll(array('RequestReschedule.event_id' => $_POST['old_event_id']));
      }

      $this->Event->save($this->data);

      Configure::write('debug', 0);
      $this->autoRender = false;
      $this->autoLayout = false;
      echo $this->Event->id;
    }
  }

  function verify_event($allday=null,$day=null,$month=null,$year=null,$hour=null,$min=null) {
    if (!empty($_POST)) {            

      //Check if Time is Available
      $mysqlstart = $_POST['EventStart'];
      $mysqlend   = $_POST['EventEnd'];

      // $conditions = array('Event.start BETWEEN ? AND ?' => array($mysqlstart,$mysqlend));            
      // $conditions = array("date_add('$mysqlstart', interval 1 minute) between Event.start and Event.end OR date_sub('$mysqlend', interval 1 minute) between Event.start and Event.end ");

      $conditions = array("
        (date_add('$mysqlstart', interval 1 minute) BETWEEN Event.start AND Event.end OR
        date_sub('$mysqlend', interval 1 minute) BETWEEN Event.start AND Event.end OR
        (date_add('$mysqlstart', interval 1 minute) <= Event.start AND
        date_sub('$mysqlend', interval 1 minute) >= Event.end))
        ");

      $events = $this->Event->find('all',array('conditions' => $conditions, 'limit' => 1));

      Configure::write('debug', 0);
      $this->autoRender = false;
      $this->autoLayout = false;

      if ($events) {
        echo 'not available';
        exit;
      }
      else {
        if ($_POST['reschedule_event_no_of_hours']) {
          //Get the no. of hours
          $no_of_hours = $this->Custom->date_difference($mysqlstart, $mysqlend, 'h');
          // debug($no_of_hours);

          if ($_POST['reschedule_event_no_of_hours'] != $no_of_hours) {
            echo 'no hours not equal';
          }					
        }
      }

    }
  }

  function check_lock() {
    $msg = 'ok';

    if ($this->Custom->date_difference(date('y-m-d'), $_POST['date_clicked'], 'd') > 3) { //if

      //check if resched conference
      if (!isset($_POST['reschedule'])) {
        //Check if case_id on events is is_locked. (is_locked must be removed if user is already paid) - questionable
        // $events = $this->Event->find('count', array('conditions' => array('Event.case_id' => $_POST['case_id'], 'Event.is_locked' => 1), 'limit' => 1));
        $events = 0;
        if ($events > 0) {
          $msg = 'locked';
        }
      }
    }
    else {
      $msg = 'after3days';
    }

    Configure::write('debug', 0);
    $this->autoRender = false;
    $this->autoLayout = false;
    echo $msg;
  }

  function admin_delete() {

    if ($_POST) {
      $this->Event->delete($_POST['event_id']);
    }

    Configure::write('debug', 0);
    $this->autoRender = false;
    $this->autoLayout = false;
    echo 'schedule deleted';
  }

  function admin_on_time_payment() {
    if (!empty($_POST)) {

      $this->loadModel('Payment');

      $Event = $this->Event->findById($_POST['event_id']);

      if ($Event) {
        $this->Event->id = $Event['Event']['id'];
        $this->Event->saveField('is_locked', '0');

        $Payment = $this->Payment->findByCaseDetailId($Event['Event']['case_detail_id']);

        $this->Payment->id = $Payment['Payment']['id'];
        $this->Payment->saveField('status', 'Confirmed');

        //Send Confirmation Email

        // debug(date('F d, Y', strtotime($Event['Event']['start'])));

        $this->_send_on_time_payment_confirmation($Payment['Payment']['user_id'], $Payment['Payment']['case_id'], $Event['Event']['id'], $Event['Event']['conference']);
      }

      Configure::write('debug', 0);
      $this->autoRender = false;
      $this->autoLayout = false;
      echo 'test';
    }
  }

  // function _send_on_time_payment_confirmation($id, $case_id, $event_id, $conference) {
  // 		
  // 		if ($conference == 'video') {
  // 			$subject = "Video Conference Payment Confirmation";
  // 			$template = 'on_time_payment_confirmation';
  // 		}
  // 		elseif ($conference == 'office') {
  // 			$subject = "Office Conference Payment Confirmation";
  // 			$template = 'office_on_time_payment_confirmation';
  // 		}
  // 		
  // 		$this->loadModel('User');
  // 
  // 		$User                  = $this->User->read(null,$id);
  // 		$Event                 = $this->Event->read(null,$event_id);
  // 		$this->Email->to       = $User['User']['username'];
  // 		$this->Email->bcc      = $this->admin_email;  
  // 		$this->Email->subject  = "E-Lawyers Online - $subject";
  // 		$this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
  // 		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
  // 		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
  // 		$this->Email->template = $template; // note no '.ctp'
  // 		//Send as 'html', 'text' or 'both' (default is 'text')
  // 		$this->Email->sendAs   = 'html'; // because we like to send pretty mail
  // 	    //Set view variables as normal
  // 	    $this->set('User', $User);
  // 	    $this->set('Event', $Event);
  // 	    $this->set('case_id', $case_id);
  // 	    //Do not pass any args to send()
  // 	    $this->Email->send();
  // 	}

  function admin_late_payment() {
    // debug('here');
    // exit;
    if (!empty($_POST)) {
      // $this->loadModel('Payment');

      $Event = $this->Event->findById($_POST['event_id']);

      // if ($this->Event->delete($Event['Event']['id'])) {
      // $this->_send_late_payment_confirmation($Event['Event']['user_id'], $Event['Event']['id']);
      // }

      $this->_send_late_payment_confirmation($Event['Event']['user_id'], $Event['Event']['id'], $Event['Event']['conference']);

      Configure::write('debug', 0);
      $this->autoRender = false;
      $this->autoLayout = false;
      echo 'late payment';
    }
  }

  function _send_late_payment_confirmation($id, $event_id, $conference) {

    if ($conference == 'video') {
      $subject = "Video Conference Late Payment Confirmation";
      $template = 'late_payment_confirmation';
    }
    elseif ($conference == 'office') {
      $subject = "Office Conference Late Payment Confirmation";
      $template = 'office_late_payment_confirmation';
    }

    $this->loadModel('User');

    $User                  = $this->User->read(null,$id);
    $Event                 = $this->Event->read(null,$event_id);
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
    $this->set('Event', $Event);
    //Do not pass any args to send()
    $this->Email->send();

  }

  function admin_available() {
    if (!empty($_POST)) {

      $Event = $this->Event->findById($_POST['event_id']);

      $this->_send_available_confirmation($Event['Event']['user_id'], $Event['Event']['id'], $Event['Event']['conference']);

      Configure::write('debug', 0);
      $this->autoRender = false;
      $this->autoLayout = false;
      echo 'available';
    }
  }

  function _send_available_confirmation($id, $event_id, $conference) {

    if ($conference == 'video') {
      $subject = "Video Conference Schedule Reset Request Confirmation";
      $template = 'available_confirmation';
    }
    elseif ($conference == 'office') {
      $subject = "Office Conference Schedule Reset Request Confirmation";
      $template = 'office_available_confirmation';
    }

    $this->loadModel('User');

    $User                  = $this->User->read(null,$id);
    $Event                 = $this->Event->read(null,$event_id);
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
    $this->set('Event', $Event);
    //Do not pass any args to send()
    $this->Email->send();
  }

  function admin_not_available() {
    if (!empty($_POST)) {

      $Event = $this->Event->findById($_POST['event_id']);

      $this->_send_not_available_confirmation($Event['Event']['user_id'], $Event['Event']['id'], $Event['Event']['conference']);

      Configure::write('debug', 0);
      $this->autoRender = false;
      $this->autoLayout = false;
      echo 'available';
    }
  }

  function admin_not_available_request_reschedule_conference() {
    if (!empty($_POST)) {

      $this->loadModel('RequestReschedule');

      $RequestReschedule = $this->RequestReschedule->findById($_POST['id']);

      // debug($RequestReschedule);
      // exit;

      // $this->Email->delivery = 'debug';

      $this->_send_request_reschedule_not_available_confirmation($RequestReschedule['RequestReschedule']['user_id'], $RequestReschedule['RequestReschedule']['id'], $RequestReschedule['RequestReschedule']['conference']);

      // debug($this->Session->read('Message.email'));

      Configure::write('debug', 0);
      $this->autoRender = false;
      $this->autoLayout = false;
      echo 'request_sent';
    }
  }

  function _send_request_reschedule_not_available_confirmation($id, $request_reschudule_id, $conference) {

    if ($conference == 'video') {
      $subject = "Video Conference Reschedule Not Available Confirmation";
    }
    elseif ($conference == 'office') {
      $subject = "Office Conference Reschedule Not Available Confirmation";
    }

    $this->loadModel('User');
    $this->loadModel('RequestReschedule');

    $User                  = $this->User->read(null,$id);
    $RequestReschedule     = $this->RequestReschedule->read(null,$request_reschudule_id);
    $this->Email->to       = $User['User']['username'];
    $this->Email->bcc      = $this->admin_email;  
    $this->Email->subject  = "E-Lawyers Online - $subject";
    $this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
    $this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
    $this->Email->additionalParams = '-finfo@e-lawyersonline.com';
    $this->Email->template = 'request_reschedule_not_available_confirmation'; // note no '.ctp'
    //Send as 'html', 'text' or 'both' (default is 'text')
    $this->Email->sendAs   = 'html'; // because we like to send pretty mail
    //Set view variables as normal
    $this->set('User', $User);
    $this->set('RequestReschedule', $RequestReschedule);
    $this->set('conference', $conference);
    //Do not pass any args to send()
    $this->Email->send();
  }

  function _send_not_available_confirmation($id, $event_id, $conference) {

    if ($conference == 'video') {
      $subject = "Video Conference Schedule Not Available Confirmation";
      $template = 'not_available_confirmation';
    }
    elseif ($conference == 'office') {
      $subject = "Office Conference Schedule Not Available Confirmation";
      $template = 'office_not_available_confirmation';
    }

    $this->loadModel('User');

    $User                  = $this->User->read(null,$id);
    $Event                 = $this->Event->read(null,$event_id);
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
    $this->set('Event', $Event);
    //Do not pass any args to send()
    $this->Email->send();
  }

  /* Fetch feed info - not in use currently
  function get_feed($id) {
        $events = $this->Event->findById($id);

        //3. Create the json array
        $rows = array();
        //Create an event entry
        $rows[] = array(
            'id'     => $events['Event']['id'],
            'title'  => $events['Event']['title'],
            'start'  => date('Y-m-d H:i', strtotime($events['Event']['start'])),
            'end'    => date('Y-m-d H:i',strtotime($events['Event']['end'])),
            'allDay' => $events['Event']['allday'],
        );

        //4. Return as a json array
        Configure::write('debug', 0);
        $this->autoRender = false;
        $this->autoLayout = false;
        $this->header('Content-Type: application/json');
        echo json_encode($rows);
    }
   */

  /* Fetch events info - not in use currently
    function get_info() {
        $Event = $this->Event->findByCalendarId($this->Session->read('Event.calendar_id'));

        // $datetime1 = new DateTime($Event['Event']['start']);
        // $datetime2 = new DateTime($Event['Event']['end']);
        // $interval = $datetime1->diff($datetime2);

        $rows[] = array(
            'id'          => $Event['Event']['id'],
            'title'       => $Event['Event']['title'],
            'start'       => date('h:i a', strtotime($Event['Event']['start'])),
            'end'         => date('h:i a', strtotime($Event['Event']['end'])),
            'date'        => date('F d, Y', strtotime($Event['Event']['start'])),
            'no_of_hours' => $this->Custom->date_difference($Event['Event']['start'], $Event['Event']['end'], 'h')
        );

        Configure::write('debug', 0);
        $this->autoRender = false;
        $this->autoLayout = false;
        $this->header('Content-Type: application/json');
        echo json_encode($rows);
    }
   */

  //Not in use. This is only for reference
  function add($allday=null,$day=null,$month=null,$year=null,$hour=null,$min=null) {

    if (empty($_POST)) {

        /*

        // if (empty($this->data)) {
            //Set default duration: 1hr and format to a leading zero.
            $hourPlus=intval($hour)+1;
            if (strlen($hourPlus)==1) {
                $hourPlus = '0'.$hourPlus;
            }

            //Create a time string to display in view. The time string
            //is either  "Fri 26 / Mar, 09 : 00 â€” 10 : 00" or
            //"All day event: (Fri 26 / Mar)"
            if ($allday=='true') {
                $event['Event']['allday'] = 1;
                $displayTime = 'All day event: ('
                    . date('D',strtotime($day.'/'.$month.'/'.$year)).' '.
                    $day.' / '. date("M", mktime(0, 0, 0, $month, 10)).')';
            } else {
                $event['Event']['allday'] = 0;
                $displayTime = date('D',strtotime($day.'/'.$month.'/'.$year)).' '
                    .$day.' / '.date("M", mktime(0, 0, 0, $month, 10)).
                    ', '.$hour.' : '.$min.' &mdash; '.$hourPlus.' : '.$min;
            }

            //Populate the event fields for the add form
            $event['Event']['start'] = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
            $event['Event']['end'] = $year.'-'.$month.'-'.$day.' '.$hourPlus.':'.$min.':00';            
            $event['Event']['date'] = $year.'-'.$month.'-'.$day;

            $this->set('current_time', $hour.':'.$min.':00');
            $this->set('event', $event);
            $this->set('event', $event);
            $this->set('user_id', $this->Auth_user['User']['id']);

            //Do not use a view template.
            // $this->layout="empty";

            $this->autoLayout = false;

         */    

    } else {

            /*
            //Original Code
            //Create and save the new event in the table.
            //Event type is set to editable - because this is a user event.
            $this->Event->create();
            $this->data['Event']['title'] = Sanitize::paranoid($this->data["Event"]["title"], array('!','\'','?','_','.',' ','-'));
            $this->data['Event']['editable']='1';
            $this->Event->save($this->data);
            // $this->redirect(array('controller' => "events", 'action' => "index"));
             */

      //Check if Time is Available
      $mysqlstart = $_POST['EventStart'];
      $mysqlend = $_POST['EventEnd'];

      // $conditions = array('Event.start BETWEEN ? AND ?' => array($mysqlstart,$mysqlend));            
      // $conditions = array("date_add('$mysqlstart', interval 1 minute) between Event.start and Event.end OR date_sub('$mysqlend', interval 1 minute) between Event.start and Event.end ");

      $conditions = array("
        date_add('$mysqlstart', interval 1 minute) BETWEEN Event.start AND Event.end OR
        date_sub('$mysqlend', interval 1 minute) BETWEEN Event.start AND Event.end OR
        (date_add('$mysqlstart', interval 1 minute) <= Event.start AND
        date_sub('$mysqlend', interval 1 minute) >= Event.end)
        ");

      $events = $this->Event->find('all',array('conditions' => $conditions, 'limit' => 1));

      if ($events) {
        Configure::write('debug', 0);
        $this->autoRender = false;
        $this->autoLayout = false;
        echo 'not available';
      }

      /* 
      //commented out because event won't be saved from the calendar
      if (!$events) { //Save Event
                //GCC Code
                $this->Event->create();

                $this->data['Event']['title']       = Sanitize::paranoid($_POST['EventTitle'], array('!','\'','?','_','.',' ','-'));
                $this->data['Event']['allday']      = $_POST['EventAllday'];
                $this->data['Event']['start']       = $_POST['EventStart'];
                $this->data['Event']['end']         = $_POST['EventEnd'];
                $this->data['Event']['user_id']     = $_POST['EventUserId'];
                $this->data['Event']['case_id']     = $_POST['EventCaseId'];
                $this->data['Event']['editable']    = '1';
                $this->data['Event']['is_locked']   = '1';
                $this->data['Event']['calendar_id'] = $_POST['EventCalendarId'];
                $this->data['Event']['className'] = $_POST['EventClassName'];

                $this->Event->save($this->data);
            }
            else {
                Configure::write('debug', 0);
                $this->autoRender = false;
                $this->autoLayout = false;
                echo 'not available';
            }
       */

            /* - part of the original code
            //renderEvent stuff here
            //Create an event entry
            $Event = $this->Event->findById($this->Event->id);

            // debug($Event);

            $rows[] = array(
                'id'       => $Event['Event']['id'],
                'title'    => $Event['Event']['title'],
                'start'    => date('Y-m-d H:i', strtotime($Event['Event']['start'])),
                'end'      => date('Y-m-d H:i', strtotime($Event['Event']['end'])),
                'allday'   => $Event['Event']['allday'],
                'editable' => $Event['Event']['editable'],
            );

            // 'start' => date('Y-m-d H:i', strtotime($events[$a]['Event']['start'])),
            // 'end' => date('Y-m-d H:i',strtotime($events[$a]['Event']['end'])),

            //4. Return as a json array
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
            $this->header('Content-Type: application/json');
            echo json_encode($rows);
             */

      // $this->autoRender = false;
      // $this->autoLayout = false;
      // echo $this->Event->id;
    }
  }
}
?>
