<?php
class HomeController extends AppController {
    var $uses = array();
	var $name = 'Home';
	var $helpers = array('Html', 'Form');
	
	function beforeFilter() {	    
		parent::beforeFilter(); 
		$this->Auth->allowedActions = array('index');
	}
	
	function index() {
	    parent::facebook();
		// debug(2);
		// exit;
		$this->loadModel('User');
		$Auth_User = $this->Auth->User();
		$User = $this->User->find('first', array('conditions' => array('User.id' => $Auth_User['User']['id'])));
		$this->set(compact('User'));
	}	
}
?>