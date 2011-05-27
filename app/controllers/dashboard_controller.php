<?php
class DashboardController extends AppController {

	var $name       = 'Dashboard';
	var $components = array('Zip', 'Custom');
	var $helpers    = array('Custom');
	
	var $paginate = array(
	    'limit'      => 10,
	    'conditions' => array('Legalcase.status' => 'active'),
	    'recursive'  => 1,
	    'order'      => array('Legalcase.id' => 'asc'),
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
	
	function admin_corprepinfo_export_xls($id) {
	    $this->loadModel('PersonalInfo');
	    
		$this->PersonalInfo->recursive = 1;
		$data = $this->PersonalInfo->find('all', array('conditions' => array('PersonalInfo.user_id' => $id)));

		$this->set('rows',$data);
		$this->set('filename','corprepinfo_' . $data[0]['User']['id']);
		$this->render('corprepinfo_export_xls','export_xls');
	}
	
    function admin_corpinfo_export_xls($id) {
	    $this->loadModel('CorporatePartnershipInfo');
	    
		$this->CorporatePartnershipInfo->recursive = 1;
		$data = $this->CorporatePartnershipInfo->find('all', array('conditions' => array('CorporatePartnershipInfo.user_id' => $id)));

		$this->set('rows',$data);
		$this->set('filename','corpinfo_' . $data[0]['User']['id']);
		$this->render('corpinfo_export_xls','export_xls');
	}
	
    function admin_bod_export_xls($id) {
	    $this->loadModel('BoardOfDirector');
	    
		$this->BoardOfDirector->recursive = 1;
		$data = $this->BoardOfDirector->find('all', array('conditions' => array('BoardOfDirector.user_id' => $id)));

		$this->set('rows',$data);
		$this->set('filename','bod_' . $data[0]['User']['id']);
		$this->render('bod_export_xls','export_xls');
	}
	
	function admin_stockholders_export_xls($id) {
	    $this->loadModel('Stockholder');
	    
		$this->Stockholder->recursive = 1;
		$data = $this->Stockholder->find('all', array('conditions' => array('Stockholder.user_id' => $id)));

		$this->set('rows',$data);
		$this->set('filename','stockholders_' . $data[0]['User']['id']);
		$this->render('stockholders_export_xls','export_xls');
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
	
	function admin_count_hidden_case() {
	    $this->loadModel('Legalcasedetail');
	    
	    $no_of_hidden = $this->Legalcasedetail->find('count', array('conditions' => array('Legalcasedetail.is_hidden' => 1, 'Legalcasedetail.case_id' => $_POST['case_id'])));
	    
	    echo $no_of_hidden;
	    
	    $this->autoRender=false;
	}
	
	function admin_download_attachments($id) {
	    $this->loadModel('Legalcasedetail');
	    $Legalcasedetail = $this->Legalcasedetail->find('first', array('fields' => array('Legalcasedetail.id', 'Legalcasedetail.user_id', 'Legalcasedetail.case_id'), 'conditions' => array('Legalcasedetail.id' => $id)));
        // debug($Legalcasedetail);
        // exit;
        
        echo $upload_folder = $_SERVER{'DOCUMENT_ROOT'} . '/app/webroot/uploads/' . $Legalcasedetail['Legalcasedetail']['user_id'] . '/' . $Legalcasedetail['Legalcasedetail']['case_id'] . '/' . $Legalcasedetail['Legalcasedetail']['id'];
        
        $files = $this->Custom->list_folder_files($upload_folder);
        
        // debug($files);
        
        foreach ($files as $key => $value) {
            $files_to_zip[] = $upload_folder .'/'. $value;
        }
        
        debug($files_to_zip);

        $this->Zip->create_zip_modified($files_to_zip, 'zip-you.zip', true);
        
        // $this->Zip->create_zip($files_to_zip, $_SERVER{'DOCUMENT_ROOT'} . '/app/webroot/uploads/test.zip', true);
        
        // $file_names        = $files_to_zip;
        // $archive_file_name = 'zipped.zip';
        // $file_path         = $_SERVER{'DOCUMENT_ROOT'} . '/app/webroot/uploads/';

        // $this->Zip->zipFilesAndDownload($file_names,$archive_file_name,$upload_folder);
        
	}
}
?>