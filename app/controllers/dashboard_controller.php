<?php
class DashboardController extends AppController {

	var $name = 'Dashboard';
	
	var $paginate = array(
	    'limit' => 10,
	    'conditions' => array('Legalcase.status' => 'active'),
	    'recursive' => 1
	    );
	
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
		$this->set('id', $this->Auth_user['User']['id']);

		$this->loadModel('Legalcase');

        // $Legalcase = $this->Legalcase->find('all', array('conditions' => array('Legalcase.status' => 'active')));
        // $this->set('Legalcase', $Legalcase);

        // $this->Legalcase->recursive = 0;
        // $this->paginate['conditions'][] = array('Legalcase.status' => 'active');
        
        $this->set('Legalcase', $this->paginate('Legalcase'));
	}
	
	function admin_case_export_xls($id) {
	    $this->loadModel('Legalcasedetail');
	    
		$this->Legalcasedetail->recursive = 1;
		$data = $this->Legalcasedetail->find('all', array('conditions' => array('Legalcasedetail.id' => $id)));
        // debug($data);
        // exit;
		$this->set('rows',$data);
		$this->set('filename','case_' . $data[0]['Legalcase']['id'] . '_' . $id);
		$this->render('case_export_xls','export_xls');
	}
	
	function admin_user_export_xls($id) {
	    $this->loadModel('User');
	    
		$this->User->recursive = 1;
		$data = $this->User->find('all', array('conditions' => array('User.id' => $id)));

		$this->set('rows',$data);
		$this->set('filename','user_' . $data[0]['User']['id']);
		$this->render('user_export_xls','export_xls');
	}
	
	function admin_personalinfo_export_xls($id) {
	    $this->loadModel('PersonalInfo');
	    
		$this->PersonalInfo->recursive = 1;
		$data = $this->PersonalInfo->find('all', array('conditions' => array('PersonalInfo.user_id' => $id)));

		$this->set('rows',$data);
		$this->set('filename','personalinfo_' . $data[0]['User']['id']);
		$this->render('personalinfo_export_xls','export_xls');
	}
	
	function admin_spouseinfo_export_xls($id) {
	    $this->loadModel('SpouseInfo');
	    
		$this->SpouseInfo->recursive = 1;
		$data = $this->SpouseInfo->find('all', array('conditions' => array('SpouseInfo.user_id' => $id)));

		$this->set('rows',$data);
		$this->set('filename','spouseinfo_' . $data[0]['User']['id']);
		$this->render('spouseinfo_export_xls','export_xls');
	}
	
	function admin_childreninfo_export_xls($id) {
	    $this->loadModel('ChildrenList');
	    
		$this->ChildrenList->recursive = 1;
		$data = $this->ChildrenList->find('all', array('conditions' => array('ChildrenList.user_id' => $id)));

		$this->set('rows',$data);
		$this->set('filename','childreninfo_' . $data[0]['User']['id']);
		$this->render('childreninfo_export_xls','export_xls');
	}
	
	//Hide Case from Dashboard
	function admin_hide_case() {
        // debug($_POST['id']);
	    $this->loadModel('Legalcasedetail');
	    $this->Legalcasedetail->id = $_POST['id'];
        $this->Legalcasedetail->saveField('is_hidden', 1);
	    
	    $this->autoRender=false;
	}
	
	function admin_unhide_cases() {
	    
	    $id = $_POST['id'];
	    
	    $this->loadModel('Legalcasedetail');
	    
	    $this->Legalcasedetail->updateAll(
	        array('Legalcasedetail.is_hidden' => 0),
	        array('Legalcasedetail.case_id' => $id)
	    );
	    	    
	    $this->autoRender=false;
	}
}
?>