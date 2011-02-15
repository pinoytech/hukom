<?php
class DashboardController extends AppController {

	var $name = 'Dashboard';
	
	function beforeFilter() {
	    parent::beforeFilter(); 
	    // $this->Auth->allowedActions = array('index', 'view');
	
		
	}

	function index() {
		parent::redirect_to_admin_index(); 
		
		// debug($this->Auth_user);
		
		$this->set('id', $this->Auth_user['User']['id']);

	}

	function admin_index() {
		// $this->Post->recursive = 0;
		// $this->set('posts', $this->paginate());
	}
}
?>