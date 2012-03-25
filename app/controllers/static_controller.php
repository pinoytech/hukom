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

  //Search
  function admin_search() {
		// the page we will redirect to
		$url['action'] = 'index';

		// build a URL will all the search elements in it
		// the resulting URL will be 
		// example.com/cake/posts/index/Search.keywords:mykeyword/Search.tag_id:3
		foreach ($this->data as $k=>$v){ 
			foreach ($v as $kk=>$vv){ 
				$url[$k.'.'.$kk]=$vv; 
			} 
		}

		// redirect the user to the url
		$this->redirect($url, null, true);
  }

  //Admin Methods
  function admin_index() {
    
    // we want to set a title containing all of the 
 		// search criteria used (not required)		
 		$title = array();

 		//
 		// filter by id
 		//
 		if(isset($this->passedArgs['Search.id'])) {
 			// set the conditions
 			$this->paginate['conditions'][]['SiteCopy.id'] = $this->passedArgs['Search.id'];

 			// set the Search data, so the form remembers the option
 			$this->data['Search']['id'] = $this->passedArgs['Search.id'];

 			// set the Page Title (not required)
 			$title[] = __('ID',true).': '.$this->passedArgs['Search.id'];
 		}
 		
 		//
 		// filter by keywords
 		//
 		if(isset($this->passedArgs['Search.keywords'])) {
 			$keywords = $this->passedArgs['Search.keywords'];
 			$this->paginate['conditions'][] = array(
 				'OR' => array(
 					'SiteCopy.title LIKE' => "%$keywords%",
 					'SiteCopy.slug LIKE' => "%$keywords%",
 					'SiteCopy.body LIKE' => "%$keywords%",
 				)
 			);
 			$this->data['Search']['keywords'] = $keywords;
 			$title[] = __('Keywords',true).': '.$keywords;
 		}

 		//
 		// filter by title
 		//
 		if(isset($this->passedArgs['Search.title'])) {
 			$this->paginate['conditions'][]['SiteCopy.title LIKE'] = '%'.$this->passedArgs['Search.title'].'%';
 			$this->data['Search']['title'] = $this->passedArgs['Search.title'];
 			$title[] = __('Title',true).': '.$this->passedArgs['Search.title'];
 		}

 		//
 		// filter by slug
 		//
 		if(isset($this->passedArgs['Search.slug'])) {
 			$this->paginate['conditions'][]['SiteCopy.slug LIKE'] = '%'.$this->passedArgs['Search.slug'].'%';
 			$this->data['Search']['slug'] = $this->passedArgs['Search.slug'];
 			$title[] = __('Slug',true).': '.$this->passedArgs['Search.slug'];
 		}

 		//
 		// filter by slug
 		//
 		if(isset($this->passedArgs['Search.body'])) {
 			$this->paginate['conditions'][]['SiteCopy.body LIKE'] = '%'.$this->passedArgs['Search.body'].'%';
 			$this->data['Search']['body'] = $this->passedArgs['Search.body'];
 			$title[] = __('Body',true).': '.$this->passedArgs['Search.body'];
 		}

 		//
 		// filter by created
 		//
 		if(isset($this->passedArgs['Search.created'])) {
      $this->paginate['conditions'][] = array("date(Payment.created) = '".$this->passedArgs['Search.created']."'");
 			$this->data['Search']['created'] = $this->passedArgs['Search.created'];
 			$title[] = __('Created',true).': '.$this->passedArgs['Search.created'];
 		}

 		//
 		// filter by date range
 		//
 		if(isset($this->passedArgs['Search.start_date']) && isset($this->passedArgs['Search.end_date'])) {
      $this->paginate['conditions'][] = array(
 				'OR' => array(
 					"Payment.created >= '".$this->passedArgs['Search.start_date']."'
 					AND Payment.created <= '".$this->passedArgs['Search.end_date']."'"
 				)
 			);
 			$this->data['Search']['start_date'] = $this->passedArgs['Search.start_date'];
 			$this->data['Search']['end_date'] = $this->passedArgs['Search.end_date'];
 			$title[] = __('Start Date',true).': '.$this->passedArgs['Search.start_date'];
 			$title[] = __('End Date',true).': '.$this->passedArgs['Search.end_date'];
 		}

		$title = implode(' | ',$title);
		$this->set(compact('title'));
    
    
    $this->SiteCopy->recursive = 0;
    $this->paginate['order'][] = array('id' => 'desc');
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

    if (!empty($this->data)) {
      if (!$this->data['SiteCopy']['id']) {
        $this->SiteCopy->create();
      }

      if ($this->data['SiteCopy']['post_to_facebook']) {
      }

      if ($this->SiteCopy->save($this->data)) {
        $this->Session->setFlash(__('The site copy has been saved', true));
        //$this->redirect(array('action' => 'index'));
        $this->redirect(array('action' => 'edit', $this->SiteCopy->id));
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
