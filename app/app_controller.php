<?php
class AppController extends Controller {
    var $components = array('Acl', 'Auth', 'Session');
    var $helpers = array('Html', 'Form', 'Session');
    // var $admin_email = array('gino.carlo.cortez@gmail.com');
    var $admin_email = array('gino.carlo.cortez@gmail.com', 'attyvalderama@gmail.com', 'redgfernandez@yahoo.com', 'redgfernandez@gmail.com');
	
	function beforeFilter() {
        //Configure AuthComponent
        $this->Auth->authorize = 'actions';
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        // $this->Auth->loginRedirect = array('controller' => 'posts', 'action' => 'add');

        //ACL
		$this->Auth->allowedActions = array('display');

		//Assign Auth User globally
		$this->Auth_user = $this->Auth->user();

		//Redirect to Admin
		if (isset($this->params['admin']) && $this->params['admin'] = TRUE) {
			$this->layout = 'admin';
			
			$this->Auth->loginRedirect = array('controller' => 'dashboard', 'action' => 'admin_index');

			if ($this->Session->read('Auth.User')) {
				// Redirect users out of admin prefix
				if ($this->Auth_user['User']['group_id'] != 1) {
					$this->redirect('/', null, false);
				}
			}
		}
		else {
		    //Redirect from close confirmation email
		    if (isset($this->params['url']['to'])) {
                // debug($this->params['url']['to']);
                header("location:" . $this->params['url']['to']);
		    }
		    
			$this->Auth->loginRedirect = array('controller' => 'home', 'action' => 'index');
		}
		
		//Set global user variable for View (i.e. navigation)
		$this->set('auth_user_type', $this->Auth_user['User']['type']);
		$this->set('auth_user_id', $this->Auth_user['User']['id']);
			
    }

	// Redirect admin to admin_index of controller
	function redirect_to_admin_index() {
		
		if ($this->Auth_user['User']['group_id'] == 1) {
			$this->redirect(array('admin' => true, 'action' => 'admin_index'));
		}
	}
	
	//Email Confirmation
	//Returns: email body and sends mail to user
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
		$this->loadModel('Event');

		$User                  = $this->User->read(null,$id);
		$Event                 = $this->Event->read(null,$event_id);
		$this->Email->to       = $User['User']['username'];
		$this->Email->bcc      = $this->admin_email;  
		$this->Email->subject  = "E-Lawyers Online - $subject";
		$this->Email->replyTo  = 'no-reply@e-laywersonline.com';
		$this->Email->from     = 'E-Lawyers Online <info@e-lawyersonline.com>';
		$this->Email->additionalParams = '-finfo@e-lawyersonline.com';
		$this->Email->template = $template; // note no '.ctp'
		//Send as 'html', 'text' or 'both' (default is 'text')
		$this->Email->sendAs   = 'html'; // because we like to send pretty mail
	    //Set view variables as normal
	    $this->set('User', $User);
	    $this->set('Event', $Event);
	    $this->set('case_id', $case_id);
	    //Do not pass any args to send()
	    $this->Email->send();
	}
}
?>