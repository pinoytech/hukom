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
		$this->set('id', $this->Auth_user['User']['id']);
		$this->set('dialog', false);
		$this->set('case_id', 1);
	}
	
	function calendar_dialog($id, $case_id) {
	    $this->set('dialog', true);
	    $this->set('id', $id);
	    $this->set('case_id', $case_id);
	    $this->layout = 'calendar';
		$this->render('index');
	}
	
	function _create_json_array($events) {
		$rows = array();
        for ($a=0; count($events)> $a; $a++) {
            //Is it an all day event?
            $all = ($events[$a]['Event']['allday'] == 1);

            //Create an event entry
            $rows[] = array(
				'id'     => $events[$a]['Event']['id'],
				'title'  => ucfirst($events[$a]['Event']['title']),
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
        //1. Transform request parameters to MySQL datetime format.
        $mysqlstart = date( 'Y-m-d H:i:s', $this->params['url']['start']);
        $mysqlend   = date('Y-m-d H:i:s', $this->params['url']['end']);

        //2. Get the events corresponding to the time range
        $conditions = array('Event.start BETWEEN ? AND ?' => array($mysqlstart,$mysqlend), 
            // 'Event.status' => 'active'
        );

        $events = $this->Event->find('all',array('conditions' =>$conditions));
		
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
			'Payment.status' => 'pending'
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
			}
        }
    }

    function check_lock() {
		$msg = 'ok';
		
        if ($this->Custom->date_difference(date('y-m-d'), $_POST['date_clicked'], 'd') > 3) { //if
			
			//check if resched conference
			if (!isset($_POST['reschedule'])) {
				//Check if case_id on events is is_locked. (is_locked must be removed if user is already paid) - questionable
	            $events = $this->Event->find('count', array('conditions' => array('Event.case_id' => $_POST['case_id'], 'Event.is_locked' => 1), 'limit' => 1));

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
	
	function _send_on_time_payment_confirmation($id, $case_id, $event_id, $conference) {
		
		if ($conference == 'video') {
			$subject = "Video Conference Payment Confirmation";
			$template = 'on_time_payment_confirmation';
		}
		elseif ($conference == 'office') {
			$subject = "Office Conference Payment Confirmation";
			$template = 'office_on_time_payment_confirmation';
		}
		
		$this->loadModel('User');

		$User                  = $this->User->read(null,$id);
		$Event                 = $this->Event->read(null,$event_id);
		$this->Email->to       = $User['User']['username'];
		$this->Email->bcc      = $this->admin_email;  
		$this->Email->subject  = "E-Lawyers Online - $subject";
		$this->Email->replyTo  = 'no-reply@e-laywersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = 'on_time_payment_confirmation'; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs   = 'html'; // because we like to send pretty mail
	    //Set view variables as normal
	    $this->set('User', $User);
	    $this->set('Event', $Event);
	    $this->set('case_id', $case_id);
	    //Do not pass any args to send()
	    $this->Email->send();
	}
	
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
		$this->Email->subject  = 'E-Lawyers Online - Late Payment Confirmation';
		$this->Email->replyTo  = 'no-reply@e-laywersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = 'late_payment_confirmation'; // note no '.ctp'
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
			
			$this->_send_available_confirmation($Event['Event']['user_id'], $Event['Event']['id']);
			
			Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
			echo 'available';
		}
	}
	
	function _send_available_confirmation($id, $event_id) {
		$this->loadModel('User');

		$User                  = $this->User->read(null,$id);
		$Event                 = $this->Event->read(null,$event_id);
		$this->Email->to       = $User['User']['username'];
		$this->Email->bcc      = $this->admin_email;  
		$this->Email->subject  = 'E-Lawyers Online - Conference Schedule Reset Request Confirmation';
		$this->Email->replyTo  = 'no-reply@e-laywersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = 'available_confirmation'; // note no '.ctp'
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
			
			$this->_send_not_available_confirmation($Event['Event']['user_id'], $Event['Event']['id']);
			
			Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
			echo 'available';
		}
	}
	
	function _send_not_available_confirmation($id, $event_id) {
		$this->loadModel('User');

		$User                  = $this->User->read(null,$id);
		$Event                 = $this->Event->read(null,$event_id);
		$this->Email->to       = $User['User']['username'];
		$this->Email->bcc      = $this->admin_email;  
		$this->Email->subject  = 'E-Lawyers Online - Conference Schedule Not Available Confirmation';
		$this->Email->replyTo  = 'no-reply@e-laywersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = 'not_available_confirmation'; // note no '.ctp'
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