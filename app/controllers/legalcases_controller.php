<?php
class LegalcasesController extends AppController {

  var $name       = 'Legalcases';
  var $components = array('Email', 'Custom');
  var $helpers    = array('Custom');

  function beforeFilter() {
    parent::beforeFilter(); 
    $this->Auth->allowedActions = array('initial_assessment');
  }

  function index() {
    parent::redirect_to_admin_index();

    // debug($this->Auth_user);

    $this->set('id', $this->Auth_user['User']['id']);

    // $Legalcase = $this->Legalcase->find('all', array('conditions' => array('Legalcase.status' => 'active', 'Legalcase.user_id' => $this->Auth_user['User']['id'])));
    // debug($Legalcase);
    // $this->set('Legalcase', $Legalcase);

    $conditions = array('Legalcase.status' => 'active', 'Legalcase.user_id' => $this->Auth_user['User']['id']);

    $this->Legalcase->recursive = 1;		
    $this->paginate['conditions'][] = $conditions;
    // $this->paginate['sort'][] = array('Legalcase.id' => 'desc');
    $this->paginate['limit'] = 5;
    $this->set('Legalcase', $this->paginate());

    // $this->paginate = array('conditions' => array('Legalcase.status' => 'active', 'Legalcase.user_id' => $this->Auth_user['User']['id']),
    //     'sort' => array('Legalcase.id' => 'desc'),
    //     'limit' => 5
    // );
    // $this->set('Legalcase', $this->paginate());
  }

  function admin_index($id=null) {
    // $this->Post->recursive = 0;
    // $this->set('posts', $this->paginate());

    // $Legalcase = $this->Legalcase->find('all', array('conditions' => array('Legalcase.user_id' => $this->Auth_user['User']['id'])));
    // debug($Legalcase);
    // $this->set('Legalcase', $Legalcase);

    // $this->Legalcase->conditions = array('Legalcase.status' => 'active');
    // $Legalcase = $this->Legalcase->find('all', array('conditions' => array('Legalcase.user_id' => $this->Auth_user['User']['id'])));

    if ($id) {
      $conditions = array('Legalcase.status' => 'active', 'Legalcase.user_id' => $id);
    }
    else {
      $conditions = array('Legalcase.status' => 'active');
    }

    $this->Legalcase->recursive = 0;		
    $this->paginate['conditions'][] = $conditions;
    // $this->paginate['sort'][] = array('Legalcase.id' => 'desc');
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

        $this->redirect(array('admin' => true, 'action' => 'index'));
      } else {
        $this->Session->setFlash(__('The case could not be saved. Please, try again.', true));
      }
    }

    if (empty($this->data)) {
      $this->data = $this->Legalcase->read(null, $id);
    }
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for user', true));
      $this->redirect(array('action'=>'index'));
    }

    //Get User_id
    $Legalcase = $this->Legalcase->find('first', array('condtions' => array('Legalcase.id' => $id)));

    $file = $_SERVER{'DOCUMENT_ROOT'} . $this->uploads_path . $Legalcase['Legalcase']['user_id'] . '/' . $id;

    if ($this->Legalcase->delete($id)) {
      $this->Session->setFlash(__('Case deleted', true));

      //Delete Files
      $this->Custom->rrmdir($file);

      $this->redirect(array('action'=>'index'));
    }

    $this->Session->setFlash(__('Case was not deleted', true));
    $this->redirect(array('action' => 'index'));
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

    //if (!$id && empty($this->data)) {
      //$this->Session->setFlash(__('Invalid user', true));
      //$this->redirect(array('action' => 'index'));
    //}

    //From Home Links - Shortcut links from home
    if (isset($this->params['named']['from'])) {
      if ($this->params['named']['from'] == 'home') {

        if ($this->params['named']['legal_service'] == 'Case or Project Retainer') {
          $this->params['named']['legal_service'] = 'Case/Project Retainer';
        }

        $this->data = array(
          'Legalcase' => array(
            'id' => null,
            'user_id' => $id,
            'legal_service' => $this->params['named']['legal_service'] 
          ),
        );

        $from = 'home';
      }
    }
    else {
      $from = null;
    }

    if (!empty($this->data)) {
      //Assign Sessions
      $this->Session->write('Legalcase.legal_service', $this->data['Legalcase']['legal_service']);

      // debug($this->Session->read('Legalcase.legal_service'));
      // exit;

      $this->Legalcase->id = $this->data['Legalcase']['id'];
      if ($this->Legalcase->save($this->data)) {

        //Create Legalcase_id Folder
        $file = $_SERVER{'DOCUMENT_ROOT'} . $this->uploads_path . $this->data['Legalcase']['user_id'] . '/' . $this->Legalcase->id; 
        $this->Custom->create_folder($file);

        // $this->Session->setFlash(__('Case Information has been saved', true));

        if ($this->data['Legalcase']['legal_service'] == 'Video Conference' OR $this->data['Legalcase']['legal_service'] == 'Office Conference' ) {

          switch ($this->data['Legalcase']['legal_service']){
          case "Video Conference":
            $legal_service = 'video';
            break;
          case "Office Conference":
            $legal_service = 'office';
            break;
          }

          //$this->Session->write('Event.calendar_id', time());
        }
        elseif ($this->data['Legalcase']['legal_service'] == 'Monthly Retainer') {
          $legal_service = 'monthly';
        }
        elseif ($this->data['Legalcase']['legal_service'] == 'Case/Project Retainer') {
          $legal_service = 'case_project';
        }
        else {
          $legal_service = false;
        }

        $this->redirect(array('action' => 'letter_of_intent', $this->data['Legalcase']['user_id'], $this->Legalcase->id, $legal_service, 'from' => $from));

      } else {
        $this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
      }
    }

    $this->loadModel('Legalservice');
    $Legalservice = $this->Legalservice->find('all');
    // debug($Legalservice);
    $this->set('Legalservices', $Legalservice);
    $this->set('user_id', $id);
    $this->set('id', $id);
  }

  function letter_of_intent($id = null, $case_id = null, $legal_service = null, $case_detail_id = null, $option = null){

    //Display description when service is selected form Home
    if (isset($this->params['named']['from'])) {
      if ($this->params['named']['from'] == 'home') {
        $this->set('service_tip', true);
      }
    }
    else {
      $this->set('service_tip', false);
    }

    $this->loadModel('PersonalInfo');
    $this->loadModel('Legalservice');

    $PersonalInfo = $this->PersonalInfo->find('first', array('conditions' => array('PersonalInfo.user_id' => $id)));

    $user_full_name = $PersonalInfo['PersonalInfo']['first_name'].' '.$PersonalInfo['PersonalInfo']['last_name'];

    switch ($legal_service){
    case "video":
      $this->Session->write('Legalcase.legal_service', 'Video Conference');
      break;
    case "office":
      $this->Session->write('Legalcase.legal_service', 'Office Conference');
      break;
    case "monthly":
      $this->Session->write('Legalcase.legal_service', 'Monthly Retainer');
      break;
    case "case_project":
      $this->Session->write('Legalcase.legal_service', 'Case/Project Retainer');
      break;
    }

    $Legalservice = $this->Legalservice->find('first', array('conditions' => array('Legalservice.name' => $this->Session->read('Legalcase.legal_service'))));
    // debug($Legalservice['Legalservice']['fee']);

    if (!empty($this->data)) {

      // $this->redirect(array('controller' => 'LegalCases', 'action' => 'add'));

      // debug($this->data)
      // exit;

      //Case Retainer
      $mother_case_id = (isset($this->data['Legalcase']['mother_case_id']) ? $this->data['Legalcase']['mother_case_id'] : $this->data['Legalcase']['case_id']);

      //Create Case Retainer
      $data['CaseRetainer'] = array(
        'user_id'           => $this->data['Legalcase']['user_id'],
        'case_id'           => $mother_case_id,
        'client_type'       => $this->data['Legalcase']['client_type'],
        'handle_type'       => $this->data['Legalcase']['handle_type'],
        'case_project_type' => $this->data['Legalcase']['case_project_type'],
        'new_pending_type'  => (isset($this->data['Legalcase']['new_pending_type'])) ? $this->data['Legalcase']['new_pending_type'] : null,
        'case_title'        => (isset($this->data['Legalcase']['case_title'])) ? $this->data['Legalcase']['case_title'] : null,
        'case_no'           => (isset($this->data['Legalcase']['case_no'])) ? $this->data['Legalcase']['case_no'] : null,
        'court_filed'       => (isset($this->data['Legalcase']['court_filed'])) ? $this->data['Legalcase']['court_filed'] : null,
        'branch_no'         => (isset($this->data['Legalcase']['branch_no'])) ? $this->data['Legalcase']['branch_no'] : null,
        'project_title'     => (isset($this->data['Legalcase']['project_title'])) ? $this->data['Legalcase']['project_title'] : null,
        'location'          => (isset($this->data['Legalcase']['location'])) ? $this->data['Legalcase']['location'] : null,
      );

      $this->loadModel('CaseRetainer');
      $this->CaseRetainer->create();
      $this->CaseRetainer->save($data);

      //Send Email to Admin		
      $this->_send_case_retainer_details($this->data['Legalcase']['user_id'], $this->CaseRetainer->id);

      if ($this->Auth_user['User']['type'] == 'personal') {
        $action = 'personal_info';
      }
      else {
        $action = 'corporate_partnership_representative_info';
      }

      $this->redirect(array('controller' => 'users', 'action' => $action, $this->data['Legalcase']['user_id'], $mother_case_id, '?' => array('test', 'test' )));
    }

    $this->set('user_full_name', $user_full_name);
    $this->set('email', $PersonalInfo['PersonalInfo']['email']);
    $this->set('fee', $Legalservice['Legalservice']['fee']);
    $this->set('id', $id);
    $this->set('case_id', $case_id);
    $this->set('case_detail_id', $case_detail_id);
    $this->set('option', $option);
    $this->set('legal_service', $Legalservice['Legalservice']['name']);

    //Video or Office Conference
    if ($legal_service == 'video' || $legal_service == 'office') {
      $this->set('event_hours', '');
      $this->set('event_date', '');
      $this->set('event_start', '');
      $this->set('event_end', '');
      $this->set('conference', $legal_service);
      $this->set('conference_fee', $Legalservice['Legalservice']['fee']);
      $this->render('letter_of_intent_conference');
    }

    //Monthly Retainer
    if ($legal_service == 'monthly') {
      $this->render('letter_of_intent_monthly');
    }

    //Case/Project Retainer
    if ($legal_service == 'case_project') {

      //Get all cases
      $case_id_list = $this->Legalcase->find('list', array('fields' => array('case_retainer'), 'conditions' => array('Legalcase.user_id' => $id, 'Legalcase.status' => 'active')));
      // debug($case_id_list);

      $this->set('case_id_list', $case_id_list);
      $this->render('letter_of_intent_case_project');
    }
  }

  function scope_of_monthly_legal_service($id, $case_id = null, $case_detail_id = null) {
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid user', true));
      $this->redirect(array('action' => 'index'));
    }

    // Update Case Details
    if (!empty($this->data)) {

      // debug($this->data);

      $monthly_scope_values = '';

      foreach ($this->data['Legalcase']['monthly_scope'] as $monthly_scope) {

        if ($monthly_scope == 'other') {
          $monthly_scope = 'Other Services: '. $this->data['Legalcase']['other_services'];
        }

        $monthly_scope_values .= $monthly_scope;
      }

      // debug($monthly_scope_values);
      // exit;

      $this->loadModel('Legalcasedetail');

      $this->Legalcase->id = $this->data['Legalcase']['id'];

      if ($this->Legalcase->save($this->data)) {

        //Create Case Detail ID
        $data['Legalcasedetail'] = array(
          'user_id' => $this->data['Legalcase']['user_id'],
          'case_id' => $this->Legalcase->id,
          'legal_service' => $this->Session->read('Legalcase.legal_service'),
          'monthly_scope' => $monthly_scope_values
        );
        //Remove model validation
        $this->Legalcasedetail->validate = array();
        $this->Legalcasedetail->create();
        $this->Legalcasedetail->save($data);
        $case_detail_id = $this->Legalcasedetail->id;

        //Create Legalcase_id Folder
        $file = $_SERVER{'DOCUMENT_ROOT'} . $this->uploads_path . $this->data['Legalcase']['user_id'] . '/' . $this->Legalcase->id . '/' . $case_detail_id; 
        $this->Custom->create_folder($file);

        //Send Email to Admin		
        $this->_send_monthly_retainer_details($this->data['Legalcase']['user_id'], $this->Legalcasedetail->id);
        $this->_send_monthly_retainer_confirmation($this->data['Legalcase']['user_id'], $this->Legalcasedetail->id);

        $this->redirect(array('controller' => 'pages', 'action' => 'thankyou_monthly'));
        // exit;

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
    $this->set('case_detail_id', $case_detail_id);

    //Assign legal_problem
    if ($this->Auth_user['User']['type'] == 'corporation') {
      $this->set('legal_problem', 'Corporate/Partnership');
    }
    elseif ($this->Auth_user['User']['type'] == 'personal') {
      $this->set('legal_problem', 'Individual');
    }

  }

  function reschedule_conference($event_id, $reschedule_type = null){
    $this->loadModel('Event');
    $this->loadModel('PersonalInfo');
    $this->loadModel('Legalservice');
    $this->loadModel('Payment');

    $Event          = $this->Event->findById($event_id);

    if (!$Event) {
      $this->Session->setFlash(__('Invalid Conference ID. Please contact us for any concerns', true));
      $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
    }

    $event_id       = $Event['Event']['id'];
    $id             = $Event['Event']['user_id'];
    $case_id        = $Event['Event']['case_id'];
    $case_detail_id = $Event['Event']['case_detail_id'];
    $conference     = $Event['Event']['conference'];
    $no_of_hours    = $this->Custom->date_difference($Event['Event']['start'], $Event['Event']['end'], 'h');

    $PersonalInfo   = $this->PersonalInfo->find('first', array('conditions' => array('PersonalInfo.user_id' => $id)));
    $user_full_name = $PersonalInfo['PersonalInfo']['first_name'].' '.$PersonalInfo['PersonalInfo']['last_name'];

    //Get Conference Type
    switch ($conference){
    case "video":
      $legal_service_name = 'Video Conference';
      break;
    case "office":
      $legal_service_name = 'Office Conference';
      break;	
    }

    $Legalservice = $this->Legalservice->find('first', array('conditions' => array('Legalservice.name' => $legal_service_name)));

    // $Payment = $this->Payment->findByCaseDetailId($case_detail_id);

    // debug($Payment);

    //Not sure kung ano silbi nito?
    if (!empty($this->data)) {
      $this->redirect(array('controller' => 'LegalCases', 'action' => 'add'));
    }

    $this->set('user_full_name', $user_full_name);
    $this->set('email', $PersonalInfo['PersonalInfo']['email']);
    $this->set('fee', $Legalservice['Legalservice']['fee']);
    $this->set('id', $id);
    $this->set('case_id', $case_id);
    $this->set('case_detail_id', $case_detail_id);
    $this->set('event_id', $event_id);


    $this->set('legal_service', $Legalservice['Legalservice']['name']);
    $this->set('event_hours', '');
    $this->set('event_date', '');
    $this->set('event_start', '');
    $this->set('event_end', '');
    $this->set('conference', $conference);
    $this->set('conference_fee', $Legalservice['Legalservice']['fee']);
    $this->set('messenger_type', $Event['Event']['messenger_type']);
    $this->set('messenger_username', $Event['Event']['messenger_username']);
    $this->set('reschedule_type', $reschedule_type);
    $this->set('no_of_hours', $no_of_hours);
  }

  function legal_problem($id, $case_id=null,$case_detail_id=null){ //$id = user_id

    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid user', true));
      $this->redirect(array('action' => 'index'));
    }

    // debug($this->data);
    // exit;

    // Update Case Details
    if (!empty($this->data)) {
      $this->loadModel('Legalcasedetail');

      $this->Legalcase->id = $this->data['Legalcase']['id'];

      $case_detail_id = $this->data['Legalcase']['case_detail_id'];

      if ($case_detail_id) {
        //Get and Set Session of legal_service
        $Legalcasedetail = $this->Legalcasedetail->find('first', array('fields' => array('Legalcasedetail.legal_service'), 'conditions' => array('Legalcasedetail.id' => $case_detail_id)));
        $this->Session->write('Legalcase.legal_service', $Legalcasedetail['Legalcasedetail']['legal_service']);
      }

      if ($this->Legalcase->save($this->data)) {
        // $this->Session->setFlash(__('Case Information has been saved', true));

        if (!$this->data['Legalcase']['case_detail_id']) {
          // debug(1);
          // exit;

          //Create Case Detail ID
          $data['Legalcasedetail'] = array(
            'user_id' => $this->data['Legalcase']['user_id'],
            'case_id' => $this->Legalcase->id,
            'legal_service' => $this->Session->read('Legalcase.legal_service')
          );
          //Remove model validation
          $this->Legalcasedetail->validate = array();
          $this->Legalcasedetail->create();
          $this->Legalcasedetail->save($data);
          $case_detail_id = $this->Legalcasedetail->id;

          /*
          //Update Events - insert case_detail_id
          if ($this->Session->read('Event.calendar_id')) {
                        debug($this->Session->read('Event.calendar_id'));
                        exit;
                        $this->loadModel('Event');
              $this->Event->updateAll(
                  array('Event.case_detail_id' => $case_detail_id),
                  array('Event.calendar_id' => $this->Session->read('Event.calendar_id'))
              );
          }
           */
        }

        //Create Legalcase_id Folder
        $file = $_SERVER{'DOCUMENT_ROOT'} . $this->uploads_path . $this->data['Legalcase']['user_id'] . '/' . $this->Legalcase->id . '/' . $case_detail_id; 
        $this->Custom->create_folder($file);

        $this->redirect(array('action' => 'summary_of_facts', $this->data['Legalcase']['user_id'], $this->Legalcase->id, $case_detail_id));

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
    $this->set('case_detail_id', $case_detail_id);
  }

  function summary_of_facts($id=null, $case_id=null, $case_detail_id=null, $type=null){ //$id = user_id
    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid user', true));
      $this->redirect(array('action' => 'index'));
    }

    $this->loadModel('Legalcasedetail');

    //Remove model validation
    $this->Legalcasedetail->validate = array();

    // Update Case Details
    if (!empty($this->data)) {

      $this->Legalcasedetail->id = $this->data['Legalcasedetail']['id'];

      if ($this->Legalcasedetail->save($this->data)) {
        // $this->Session->setFlash(__('Case Information has been saved', true));

        //Save Payments
        $payment_data = array(
          'Payment' => array(
            'id' => null,
            'user_id' => $this->data['Legalcasedetail']['user_id'],
            'case_id' => $this->data['Legalcasedetail']['case_id'],
            'case_detail_id' => $this->Legalcasedetail->id,
          ),
        );
        $this->loadModel('Payment');
        $this->Payment->create();
        $this->Payment->save($payment_data);

        $this->redirect(array('action' => $this->data['Legalcase']['goto'], $this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id'], $this->Legalcasedetail->id));
      } else {
        $this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
      }

      $this->data = $this->Legalcasedetail->read(null, $this->data['Legalcasedetail']['case_id']);
    }

    if (empty($this->data)) {
      $this->data = $this->Legalcasedetail->read(null, $case_detail_id);
    }

    /*
    //If new facts create case_detail_id
    if ($type == 'new_facts') {

        $legal_service_id = $case_detail_id;

        //Get Service
        $this->loadModel('Legalservice');
        $Legalservice = $this->Legalservice->find($legal_service_id);

        //Create legal_case_detail
          $legal_case_detail_data = array(
        'Legalcasedetail' => array(
          'user_id'       => $id,
          'case_id'       => $case_id,
          'legal_service' => $Legalservice['Legalservice']['name'],
          'status'        => 'Pending',
        )
      );

            $this->Legalcasedetail->save($legal_case_detail_data);
    }
     */

    $upload_folder = $this->uploads_path . "$id/$case_id/$case_detail_id";

    $this->set('id', $id);
    $this->set('case_id', $case_id);
    $this->set('case_detail_id', $case_detail_id);
    $this->set('legal_service', $this->Session->read('Legalcase.legal_service'));
    $this->set('upload_folder', $upload_folder);
    $this->set('files', $this->Custom->show_files($upload_folder));
    $this->set('type', $type);
  }

  function objectives_questions($id, $case_id=null, $case_detail_id=null){

    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid user', true));
      $this->redirect(array('action' => 'index'));
    }

    // debug($this->data);
    // exit;

    $this->loadModel('Legalcasedetail');

    $this->Legalcasedetail->validate = array();

    // Update Case Details
    if (!empty($this->data)) {

      $this->Legalcasedetail->id = $this->data['Legalcasedetail']['id'];

      if ($this->Legalcasedetail->save($this->data)) {
        // $this->Session->setFlash(__('Case Information has been saved', true));

        //Send Case/Project Retainer Email Confirmation
        if ($this->Session->read('Legalcase.legal_service') == 'Case/Project Retainer') {
          $this->_send_case_retainer_confirmation($this->data['Legalcasedetail']['user_id'], $this->Legalcasedetail->id);
        }

        $this->redirect(array('action' => $this->data['Legalcase']['goto'], $this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id'], $this->Legalcasedetail->id));

      } else {
        $this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
      }

      $this->data = $this->Legalcasedetail->read(null, $this->data['Legalcasedetail']['case_id']);

    }

    //Update Events - insert case_detail_id
    if ($this->Session->read('TempEvent.id')) {
      // debug($case_detail_id);
      // exit;

      //Delete duplicate events via case detail id
      $this->loadModel('Event');
      $this->Event->deleteAll(array('Event.case_detail_id' => $case_detail_id));

      $this->loadModel('TempEvent');
      $TempEvent = $this->TempEvent->findById($this->Session->read('TempEvent.id'));

      // debug($TempEvent);
      // debug($TempEvent['TempEvent']['user_id']);

      $Event_data = array(
        'Event' => array(
          'user_id'            => $TempEvent['TempEvent']['user_id'],
          'case_id'            => $TempEvent['TempEvent']['case_id'],
          'case_detail_id'     => $case_detail_id,
          'title'              => $TempEvent['TempEvent']['title'],
          'allday'             => $TempEvent['TempEvent']['allday'],
          'start'              => $TempEvent['TempEvent']['start'],
          'end'                => $TempEvent['TempEvent']['end'],
          'editable'           => $TempEvent['TempEvent']['editable'],
          'is_locked'          => $TempEvent['TempEvent']['is_locked'],
          'calendar_id'        => $TempEvent['TempEvent']['calendar_id'],
          'conference'         => $TempEvent['TempEvent']['conference'],
          'color'              => $TempEvent['TempEvent']['color'],
          'messenger_type'     => $TempEvent['TempEvent']['messenger_type'],
          'messenger_username' => $TempEvent['TempEvent']['messenger_username'],
        )
      );

      $this->loadModel('Event');
      $this->Event->save($Event_data);

      //Clear Data
      $this->Session->write('TempEvent.id', '');

      /*
      $this->Event->updateAll(
          array('Event.case_detail_id' => $case_detail_id),
          array('Event.calendar_id' => $this->Session->read('Event.calendar_id'))
      );
       */
    }

    if (empty($this->data)) {
      $this->data = $this->Legalcasedetail->read(null, $case_detail_id);
    }

    $this->set('id', $id);
    $this->set('case_id', $case_id);
    $this->set('case_detail_id', $case_detail_id);
  }

  function summary_of_information($id=null, $case_id=null, $case_detail_id=null, $type=null, $legal_service=null){

    $this->Session->write('new_facts', '');

    //This block is for new facts
    if (!empty($this->data)) {
      //Create Case Detail ID
      $data['Legalcasedetail'] = array(
        'user_id' => $this->data['Legalcasedetail']['user_id'],
        'case_id' => $this->data['Legalcasedetail']['case_id'],
        'legal_service' => $this->Session->read('Legalcase.legal_service')
      );

      $this->loadModel('Legalcasedetail');
      $this->Legalcasedetail->validate = array(); //Remove model validation
      $this->Legalcasedetail->create();
      $this->Legalcasedetail->save($data);
      $case_detail_id = $this->Legalcasedetail->id;

      //Create Legalcase_id Folder
      $file = $_SERVER{'DOCUMENT_ROOT'} . $this->uploads_path . $this->data['Legalcasedetail']['user_id'] . '/' . $this->data['Legalcasedetail']['case_id'] . '/' . $case_detail_id; 
      $this->Custom->create_folder($file);

      $this->Session->write('new_facts', true);

      //Redirect Controller
      if ($this->Session->read('Legalcase.legal_service') == 'Per Query') {
        //Redirect to summary of facts
        $this->redirect(array('action' => 'summary_of_facts', $this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id'], $case_detail_id));
      }
      elseif ($this->Session->read('Legalcase.legal_service') == 'Video Conference') {
        //Redirect to letter of intent
        $this->redirect(array('action' => 'letter_of_intent', $this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id'], $this->data['Legalcasedetail']['legal_service'], $case_detail_id, 'new_facts'));
      }
      elseif ($this->Session->read('Legalcase.legal_service') == 'Office Conference') {
        //Redirect to letter of intent
        $this->redirect(array('action' => 'letter_of_intent', $this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id'], $this->data['Legalcasedetail']['legal_service'], $case_detail_id, 'new_facts'));
      }
    }

    //Assign Legal Service Session
    if ($legal_service == 'perquery') {
      $this->Session->write('Legalcase.legal_service', 'Per Query');
    }

    if ($legal_service == 'video') {
      $this->Session->write('Legalcase.legal_service', 'Video Conference');
    }

    if ($legal_service == 'office') {
      $this->Session->write('Legalcase.legal_service', 'Office Conference');
    }
    //end assign

    if (!$id && empty($this->data)) {
      $this->Session->setFlash(__('Invalid user', true));
      $this->redirect(array('action' => 'index'));
    }

    $this->loadModel('Legalcasedetail');

    if ($type == 'view') {
      $options = array('conditions' => array('Legalcasedetail.id' => $case_detail_id));
    }
    else {
      $options = array('conditions' => array('Legalcasedetail.case_id' => $case_id), 'order' => array('Legalcasedetail.id DESC'));
    }

    $Legalcasedetail = $this->Legalcasedetail->find('all', $options);

    $this->set('Legalcasedetails', $Legalcasedetail);
    $this->set('id', $id);
    $this->set('case_id', $case_id);
    $this->set('case_detail_id', $case_detail_id);
    $this->set('type', $type);
    $this->set('no_of_hours', '');
    $this->set('legal_service', $legal_service);

    //Get Legalservice fee
    $this->loadModel('Legalservice');
    $Legalservice = $this->Legalservice->find('all');
    $this->set('Legalservices', $Legalservice);
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

    //Legal Service Fee
    $this->loadModel('Legalservice');
    $Legalservice = $this->Legalservice->find('first', array('conditions' => array('Legalservice.name' => $this->Session->read('Legalcase.legal_service'))));

    if ($Legalservice['Legalservice']['name'] == 'Video Conference' OR $Legalservice['Legalservice']['name'] == 'Office Conference') {
      $this->loadModel('Event');        
      $Event = $this->Event->findByCaseDetailId($case_detail_id);
      // debug($Event);
      // exit;
            /*
            $datetime1 = new DateTime($Event['Event']['start']);
            $datetime2 = new DateTime($Event['Event']['end']);
            $interval = $datetime1->diff($datetime2);

            $fee = (float)$Legalservice['Legalservice']['fee'] * (float)$interval->format('%h');
             */

      $fee = (float)$Legalservice['Legalservice']['fee'] * $this->Custom->date_difference($Event['Event']['start'], $Event['Event']['end'], 'h');
    }
    else {
      $fee = $Legalservice['Legalservice']['fee'];
    }

    $this->set('fee', $fee);
    $this->set('user_full_name', $user_full_name);
    $this->set('id', $id);
    $this->set('case_id', $case_id);
    $this->set('case_detail_id', $case_detail_id);
  }

  // Description: User request a reschedule of conference
  function request_reschedule_conference($id=null, $case_id=null, $case_detail_id=null, $event_id=null, $conference=null, $request=null) {

    $this->loadModel('RequestReschedule');
    $this->loadModel('Event');

    if ($request == 'request') {
      $this->loadModel('RequestReschedule');
      $RequestReschedule = $this->RequestReschedule->find('first', array('fields' => array('TIMEDIFF(RequestReschedule.end, RequestReschedule.start) as total_time'), 'conditions' => array('RequestReschedule.id' => $event_id)));
      $total_time = explode(':', $RequestReschedule[0]['total_time']);
    }
    else {
      $Event = $this->Event->find('first', array('fields' => array('TIMEDIFF(Event.end, Event.start) as total_time'), 'conditions' => array('Event.id' => $event_id)));
      $total_time = explode(':', $Event[0]['total_time']);
    }

    if (!empty($this->data)) {

      if ($this->data['Legalcase']['request'] == 'request') {
        //Delete Request
        $this->RequestReschedule->delete($this->data['Legalcase']['event_id']);
      }
      else {
        //Delete Event
        $this->Event->delete($this->data['Legalcase']['event_id']);
      }

      //Save Data
      $data = array(
        'RequestReschedule' => array(
          'user_id'        => $this->data['Legalcase']['user_id'],
          'case_id'        => $this->data['Legalcase']['case_id'],
          'case_detail_id' => $this->data['Legalcase']['case_detail_id'],
          'event_id'       => $this->data['Legalcase']['event_id'],
          'conference'     => $this->data['Legalcase']['conference'],
          'date'           => $this->data['Legalcase']['date'],
          'notes'          => $this->data['Legalcase']['notes'],
          'start'          => $this->data['Legalcase']['start'],
          'end'            => $this->data['Legalcase']['end'],
        ));

      $this->RequestReschedule->save($data);

      //Send Email to Admin		
      $this->_send_request_reschedule_conference($this->data['Legalcase']['user_id'], $this->RequestReschedule->id);

      //Redirect if sucessful
      $this->redirect(array('controller' => 'pages', 'action' => 'request_reschedule_conference_sent'));
    }

    $this->set('id', $id);
    $this->set('case_id', $case_id);
    $this->set('case_detail_id', $case_detail_id);
    $this->set('event_id', $event_id);
    $this->set('conference', $conference);
    $this->set('request', $request);
    $this->set('total_time', ltrim($total_time[0], '0'));
  }

  function _send_request_reschedule_conference($id, $request_reschedule_id) {
    $this->loadModel('User');
    $this->loadModel('Event');

    $User                  = $this->User->read(null,$id);
    $RequestReschedule     = $this->RequestReschedule->read(null,$request_reschedule_id);

    $this->Email->to       = $this->admin_email;
    $this->Email->subject  = "E-Lawyers Online - Request to Reschedule Conference";
    $this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
    $this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
    $this->Email->additionalParams = '-finfo@e-lawyersonline.com';
    $this->Email->template = 'request_reschedule_conference'; // note no '.ctp'
    //Send as 'html', 'text' or 'both' (default is 'text')
    $this->Email->sendAs   = 'html'; // because we like to send pretty mail
    //Set view variables as normal
    $this->set('User', $User);
    $this->set('RequestReschedule', $RequestReschedule);
    //Do not pass any args to send()
    $this->Email->send();

  }

  function _send_monthly_retainer_details($id, $case_detail_id) {
    $this->loadModel('User');
    $this->loadModel('Legalcasedetail');

    $User                  = $this->User->read(null,$id);
    $Legalcasedetail          = $this->Legalcasedetail->read(null,$case_detail_id);

    $this->Email->to       = $this->admin_email;
    $this->Email->subject  = "E-Lawyers Online - Monthly Retainer Details";
    $this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
    $this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
    $this->Email->additionalParams = '-finfo@e-lawyersonline.com';
    $this->Email->template = 'monthly_retainer_details'; // note no '.ctp'
    //Send as 'html', 'text' or 'both' (default is 'text')
    $this->Email->sendAs   = 'html'; // because we like to send pretty mail
    //Set view variables as normal
    $this->set('User', $User);
    $this->set('Legalcasedetail', $Legalcasedetail);
    //Do not pass any args to send()
    $this->Email->send();

  }

  function _send_monthly_retainer_confirmation($id, $case_detail_id) {
    $this->loadModel('User');
    $this->loadModel('Legalcasedetail');

    $User                  = $this->User->read(null,$id);
    $Legalcasedetail       = $this->Legalcasedetail->read(null,$case_detail_id);

    $this->Email->to       = $User['User']['username'];
    $this->Email->bcc      = $this->admin_email;
    $this->Email->subject  = "E-Lawyers Online - Monthly Retainer Confirmation";
    $this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
    $this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
    $this->Email->additionalParams = '-finfo@e-lawyersonline.com';
    $this->Email->template = 'monthly_retainer_confirmation'; // note no '.ctp'
    //Send as 'html', 'text' or 'both' (default is 'text')
    $this->Email->sendAs   = 'html'; // because we like to send pretty mail
    //Set view variables as normal
    $this->set('User', $User);
    $this->set('Legalcasedetail', $Legalcasedetail);
    //Do not pass any args to send()
    $this->Email->send();

  }

  function _send_case_retainer_details($id, $case_retainer_id) {
    $this->loadModel('User');
    $this->loadModel('CaseRetainer');

    $User                  = $this->User->read(null,$id);
    $CaseRetainer          = $this->CaseRetainer->read(null,$case_retainer_id);

    $this->Email->to       = $this->admin_email;
    $this->Email->subject  = "E-Lawyers Online - Case Retainer Details";
    $this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
    $this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
    $this->Email->additionalParams = '-finfo@e-lawyersonline.com';
    $this->Email->template = 'case_retainer_details'; // note no '.ctp'
    //Send as 'html', 'text' or 'both' (default is 'text')
    $this->Email->sendAs   = 'html'; // because we like to send pretty mail
    //Set view variables as normal
    $this->set('User', $User);
    $this->set('CaseRetainer', $CaseRetainer);
    //Do not pass any args to send()
    $this->Email->send();
  }

  function _send_case_retainer_confirmation($id, $case_detail_id) {
    $this->loadModel('User');
    $this->loadModel('Legalcasedetail');

    $User                  = $this->User->read(null,$id);
    $Legalcasedetail       = $this->Legalcasedetail->read(null,$case_detail_id);

    $this->Email->to       = $User['User']['username'];
    $this->Email->bcc      = $this->admin_email;
    $this->Email->subject  = "E-Lawyers Online - Case/Project Retainer Confirmation";
    $this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
    $this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
    $this->Email->additionalParams = '-finfo@e-lawyersonline.com';
    $this->Email->template = 'case_retainer_confirmation'; // note no '.ctp'
    //Send as 'html', 'text' or 'both' (default is 'text')
    $this->Email->sendAs   = 'html'; // because we like to send pretty mail
    //Set view variables as normal
    $this->set('User', $User);
    $this->set('Legalcasedetail', $Legalcasedetail);
    //Do not pass any args to send()
    $this->Email->send();

  }

  //Description: Delete file physically from the server
  function remove_file(){
    echo $folder = $_SERVER['DOCUMENT_ROOT'] . $_POST['file_path'];
    unlink($folder);
    $this->autoRender=false;
  }

  function initial_assessment() {

    $this->loadModel('InitialAssessment');

    if ($_POST) {
      // debug($this->data);
      $this->InitialAssessment->save($this->data);

      // Send Email
      // $this->Email->delivery = 'debug';
      $this->_send_initial_legal_assessment( $this->data['InitialAssessment'] );    
      // debug($this->Session->read('Message.email'));
      // exit;

      $this->redirect(array('controller' => 'pages', 'action' => 'thankyou_initial_assessment'));
    }
  }

  function _send_initial_legal_assessment($params) {
    $this->Email->to       = $params['email'];
    $this->Email->bcc      = $this->admin_email;
    $this->Email->subject  = "E-Lawyers Online - Initial Legal Assessment";
    $this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
    $this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
    $this->Email->additionalParams = '-finfo@e-lawyersonline.com';
    $this->Email->template = 'initial_assessment'; // note no '.ctp'
    //Send as 'html', 'text' or 'both' (default is 'text')
    $this->Email->sendAs   = 'html'; // because we like to send pretty mail
    //Set view variables as normal
    $this->set('params', $params);
    //Do not pass any args to send()
    $this->Email->send();
  }
}
?>
