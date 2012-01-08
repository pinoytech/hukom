<?php
class StaticController extends AppController {
    var $uses = array('SiteCopy');
	var $name = 'Static';
	var $helpers = array('Html', 'TinyMce.TinyMce');
	
	function beforeFilter() {	    
		parent::beforeFilter(); 
		$this->Auth->allowedActions = array('page');
	}
	
	function page($slug=null) {
	    $site_copy = $this->SiteCopy->findBySlug($slug);
        $this->set('title', $site_copy['SiteCopy']['title']);
        $this->set('body', $site_copy['SiteCopy']['body']);
	}	
	
	//Admin Methods
	function admin_index() {
        $this->SiteCopy->recursive = 0;
        $this->set('site_copies', $this->paginate());
	}
	
	function admin_add() {
        $this->render('admin_form');
	}   
	    
	function admin_edit($id) {
	    $this->data = $this->SiteCopy->read(null, $id);
	    $this->render('admin_form');
	}   
	
	function admin_form() {
	    App::import('Lib', 'Facebook.FB');
	    
	    if (!empty($this->data)) {
	        if (!$this->data['SiteCopy']['id']) {
	           $this->SiteCopy->create();
	        }
	        
	        if ($this->data['SiteCopy']['post_to_facebook']) {
	            $Facebook = new FB();
	            debug($Facebook);
                $fbuser = $Facebook->api('/me');
	            
	            debug();
	            exit; 
	        }
	        
            if ($this->SiteCopy->save($this->data)) {
                $this->Session->setFlash(__('The site copy has been saved', true));
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The site copy could not be saved. Please, try again.', true));
            }
        }
	}
	    
    function admin_delete($id = null) {
      if (!$id) {
        $this->Session->setFlash(__('Invalid id for site copy', true));
        $this->redirect(array('action'=>'index'));
      }
      if ($this->SiteCopy->delete($id)) {
        $this->Session->setFlash(__('Site Copy deleted', true));
        $this->redirect(array('action'=>'index'));
      }
      $this->Session->setFlash(__('Site Copy was not deleted', true));
      $this->redirect(array('action' => 'index'));
    }
}       
?>      