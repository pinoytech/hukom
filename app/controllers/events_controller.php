<?php
App::import('Sanitize');
class EventsController extends AppController {
    var $name       = 'Events';
    var $components = array('Custom');
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
	
	function feed() {
        //1. Transform request parameters to MySQL datetime format.
        $mysqlstart = date( 'Y-m-d H:i:s', $this->params['url']['start']);
        $mysqlend = date('Y-m-d H:i:s', $this->params['url']['end']);

        //2. Get the events corresponding to the time range
        $conditions = array('Event.start BETWEEN ? AND ?' => array($mysqlstart,$mysqlend), 
            // 'Event.case_detail_id !=' => "''"
        );
        $events = $this->Event->find('all',array('conditions' =>$conditions));

        //3. Create the json array
        $rows = array();
        for ($a=0; count($events)> $a; $a++) {
            //Is it an all day event?
            $all = ($events[$a]['Event']['allday'] == 1);

            //Create an event entry
            $rows[] = array('id' => $events[$a]['Event']['id'],
            'title' => $events[$a]['Event']['title'],
            'start' => date('Y-m-d H:i', strtotime($events[$a]['Event']['start'])),
            'end' => date('Y-m-d H:i',strtotime($events[$a]['Event']['end'])),
            'allDay' => $all,
            'className' => $events[$a]['Event']['className'],
            );
        }

        //4. Return as a json array
        Configure::write('debug', 0);
        $this->autoRender = false;
        $this->autoLayout = false;
        $this->header('Content-Type: application/json');
        echo json_encode($rows);
    }
    
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
            // debug($events);
            // exit;
            if (!$events) {
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
            
            /*
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
    
    function check_lock() {

        //Check if day click is 3 days more than today
        
        /*
        $datetime1 = new DateTime(date('y-m-d'));
        $datetime2 = new DateTime($_POST['date_clicked']);
        $interval = $datetime1->diff($datetime2);
        */
				
		// debug($this->Custom->date_difference(date('y-m-d'), $_POST['date_clicked'], 'd'));
		
		$msg = '';
		
        if ($this->Custom->date_difference(date('y-m-d'), $_POST['date_clicked'], 'd') > 3) { //if
            $events = $this->Event->find('count', array('conditions' => array('Event.case_id' => $_POST['case_id'], 'Event.is_locked' => 1), 'limit' => 1));
			
			// debug($events);
            
			if ($events > 0) {
                $msg = 'locked';
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
    
    function get_info() {
        $Event = $this->Event->findByCalendarId($this->Session->read('Event.calendar_id'));

        /*
        $datetime1 = new DateTime($Event['Event']['start']);
        $datetime2 = new DateTime($Event['Event']['end']);
        $interval = $datetime1->diff($datetime2);
        */

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
}
?>