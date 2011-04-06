<?php
class AppController extends Controller {
    var $components = array('Acl', 'Auth', 'Session');
    var $helpers = array('Html', 'Form', 'Session');
    var $admin_email = array('gino.carlo.cortez@gmail.com', 'ginoc@sourcepad.com', 'gino@etgdes.com');
    // var $admin_email = array('gino.carlo.cortez@gmail.com', 'attyvalderama@gmail.com', 'redgfernandez@yahoo.com');
	
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
}
?>