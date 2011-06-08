<?php
class LegalcasesController extends AppController {

	var $name       = 'Legalcases';
	var $components = array('Email', 'Custom');
	var $helpers    = array('Custom');
	
	function beforeFilter() {
	    parent::beforeFilter(); 
	    // $this->Auth->allowedActions = array('index', 'view');
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
		$this->paginate['sort'][] = array('Legalcase.id' => 'asc');
		$this->paginate['limit'] = 5;
		$this->set('Legalcase', $this->paginate());
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
		
		$file = $_SERVER{'DOCUMENT_ROOT'} . '/app/webroot/uploads/' . $Legalcase['Legalcase']['user_id'] . '/' . $id;

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
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			
			//Assign Sessions
			$this->Session->write('Legalcase.legal_service', $this->data['Legalcase']['legal_service']);
			
			// debug($this->Session->read('Legalcase.legal_service'));
			// exit;
			
			$this->Legalcase->id = $this->data['Legalcase']['id'];
			if ($this->Legalcase->save($this->data)) {
				
				//Create Legalcase_id Folder
				$file = $_SERVER{'DOCUMENT_ROOT'} . '/app/webroot/uploads/' . $this->data['Legalcase']['user_id'] . '/' . $this->Legalcase->id; 
				if (!file_exists($file)) {
					mkdir($file);
					chmod($file, 0755);
				}
				
				// $this->Session->setFlash(__('Case Information has been saved', true));
				
				if ($this->data['Legalcase']['legal_service'] == 'Video Conference' OR $this->data['Legalcase']['legal_service'] == 'Office Conference' ) {
					
					switch ($this->data['Legalcase']['legal_service']){
						case "Video Conference":
							$conference = 'video';
							break;
						case "Office Conference":
							$conference = 'office';
							break;	
					}
					
				    $this->Session->write('Event.calendar_id', time());
				}
				else {
				    $conference = false;
				}
				
				$this->redirect(array('action' => 'letter_of_intent', $this->data['Legalcase']['user_id'], $this->Legalcase->id, $conference));
				
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
	
	function letter_of_intent($id, $case_id, $conference = null){
		$this->loadModel('PersonalInfo');
		$this->loadModel('Legalservice');
		
		$PersonalInfo = $this->PersonalInfo->find('first', array('conditions' => array('PersonalInfo.user_id' => $id)));
		
		$user_full_name = $PersonalInfo['PersonalInfo']['first_name'].' '.$PersonalInfo['PersonalInfo']['last_name'];
		
		$Legalservice = $this->Legalservice->find('first', array('conditions' => array('Legalservice.name' => $this->Session->read('Legalcase.legal_service'))));
		// debug($Legalservice['Legalservice']['fee']);
		
		if (!empty($this->data)) {
			$this->redirect(array('controller' => 'LegalCases', 'action' => 'add'));
		}

		$this->set('user_full_name', $user_full_name);
		$this->set('email', $PersonalInfo['PersonalInfo']['email']);
		$this->set('fee', $Legalservice['Legalservice']['fee']);
		$this->set('id', $id);
		$this->set('case_id', $case_id);
		
		if ($conference) {
		    $this->set('legal_service', $Legalservice['Legalservice']['name']);
		    $this->set('event_hours', '');
		    $this->set('event_date', '');
		    $this->set('event_start', '');
		    $this->set('event_end', '');
		    $this->set('conference', $conference);
		    $this->set('conference_fee', $Legalservice['Legalservice']['fee']);
		    $this->render('letter_of_intent_conference');
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
			
			$this->Legalcase->id = $this->data['Legalcase']['id'];
			
			$case_detail_id = $this->data['Legalcase']['case_detail_id'];
			
			if ($this->Legalcase->save($this->data)) {
				// $this->Session->setFlash(__('Case Information has been saved', true));
				
				if (!$this->data['Legalcase']['case_detail_id']) {
					// debug(1);
					// exit;
					
					//Create Case Detail ID
					$this->loadModel('Legalcasedetail');
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
					
					//Update Events
					if ($this->Session->read('Event.calendar_id')) {
                        // debug($this->Session->read('Event.calendar_id'));
                        // exit;
                        $this->loadModel('Event');
    					$this->Event->updateAll(
    					    array('Event.case_detail_id' => $case_detail_id),
    					    array('Event.calendar_id' => $this->Session->read('Event.calendar_id'))
    					);
					}
				}
				
				//Create Legalcase_id Folder
				$file = $_SERVER{'DOCUMENT_ROOT'} . '/app/webroot/uploads/' . $this->data['Legalcase']['user_id'] . '/' . $this->Legalcase->id . '/' . $case_detail_id; 
				if (!file_exists($file)) {
					mkdir($file);
					chmod($file, 0755);
				}
				
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
				
				//Create Details Folder here
				
				$this->redirect(array('action' => $this->data['Legalcase']['goto'], $this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id'], $this->Legalcasedetail->id));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}
			
			$this->data = $this->Legalcasedetail->read(null, $this->data['Legalcasedetail']['case_id']);
		}
		
		if (empty($this->data)) {
			$this->data = $this->Legalcasedetail->read(null, $case_detail_id);
		}
		
		$upload_folder = "/app/webroot/uploads/$id/$case_id/$case_detail_id";
		
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
				$this->redirect(array('action' => $this->data['Legalcase']['goto'], $this->data['Legalcasedetail']['user_id'], $this->data['Legalcasedetail']['case_id'], $this->Legalcasedetail->id));
			} else {
				$this->Session->setFlash(__('Case Information could not be saved. Please, try again.', true));
			}

			$this->data = $this->Legalcasedetail->read(null, $this->data['Legalcasedetail']['case_id']);
		}
		
		if (empty($this->data)) {
			$this->data = $this->Legalcasedetail->read(null, $case_detail_id);
		}

		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);
	}

	function summary_of_information($id, $case_id=null, $case_detail_id=null, $type=null, $legal_service=null){
		
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
		
		// Will get all legal_case_details data
		$Legalcase = $this->Legalcase->find('first', array('conditions' => array('Legalcase.id' => $case_id)));
		//, 'order' => array('Legalcasedetail.id' => 'DESC')
		// debug($Legalcase);
        
        $upload_folder = "/app/webroot/uploads/$id/$case_id/$case_detail_id";
        
		$this->set('Legalcase', $Legalcase);
		$this->set('id', $id);
		$this->set('case_id', $case_id);
		$this->set('case_detail_id', $case_detail_id);
		$this->set('type', $type);
		$this->set('upload_folder', $upload_folder);
		$this->set('files', $this->Custom->show_files($upload_folder));
		$this->set('no_of_hours', '');
		
		//Get Legalservice fee
		$this->loadModel('Legalservice');
		$Legalservice = $this->Legalservice->find('first', array('conditions' => array('Legalservice.name' => $this->Session->read('Legalcase.legal_service'))));
		$this->set('fee', $Legalservice['Legalservice']['fee']);
		
		//Get Event
        $this->loadModel('Event');        
        $Event = $this->Event->findByCaseDetailId($case_detail_id);		
        
        if ($Event) {
            $no_of_hours = $this->Custom->date_difference($Event['Event']['start'], $Event['Event']['end'], 'h');
			
			$this->set('Event', $Event);
			$this->set('no_of_hours', $no_of_hours);
			$this->set('fee', (float)$Legalservice['Legalservice']['fee'] * $no_of_hours);
        }
        else {
            $this->set('Event', false);
        }
        //end Event
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

	function remove_file(){
		echo $folder = $_SERVER['DOCUMENT_ROOT'] . $_POST['file_path'];
		unlink($folder);
		$this->autoRender=false;
	}
}
?>