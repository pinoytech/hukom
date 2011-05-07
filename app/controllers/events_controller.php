<?php
App::import('Sanitize');
class EventsController extends AppController {
    var $name    = 'Events';
    var $helpers = array('Custom');

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
	}
	
	function feed() {
        //1. Transform request parameters to MySQL datetime format.
        $mysqlstart = date( 'Y-m-d H:i:s', $this->params['url']['start']);
        $mysqlend = date('Y-m-d H:i:s', $this->params['url']['end']);

        //2. Get the events corresponding to the time range
        $conditions = array('Event.start BETWEEN ? AND ?'
        => array($mysqlstart,$mysqlend));
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
            $this->set("displayTime",$displayTime);
            
            //Populate the event fields for the add form
            $event['Event']['start'] = $year.'-'.$month.'-'.$day.' '.$hour.':'.$min.':00';
            $event['Event']['end'] = $year.'-'.$month.'-'.$day.' '.$hourPlus.':'.$min.':00';            
            $event['Event']['date'] = $year.'-'.$month.'-'.$day;
            
            $this->set('event', $event);
            $this->set('user_id', $this->Auth_user['User']['id']);

            //Do not use a view template.
            // $this->layout="empty";
            
            $this->autoLayout = false;
            
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
            
            //GCC Code
            $this->Event->create();

            $this->data['Event']['title']    = Sanitize::paranoid($_POST['EventTitle'], array('!','\'','?','_','.',' ','-'));
            $this->data['Event']['allday']   = $_POST['EventAllday'];
            $this->data['Event']['start']    = $_POST['EventStart'];
            $this->data['Event']['end']      = $_POST['EventEnd'];
            $this->data['Event']['editable'] = '1';
            
            $this->Event->save($this->data);
            
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
}
?>