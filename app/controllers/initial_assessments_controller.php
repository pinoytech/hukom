<?php
class InitialAssessmentsController extends AppController {
  var $name = 'InitialAssessments';
  var $helpers = array('Html');

  function beforeFilter() {	    
    parent::beforeFilter(); 
  }

  //Admin Methods
  function admin_index() {
    $this->InitialAssessment->recursive = 0;
    $this->paginate = array(
      'order' => array('id' => 'desc')
    );
    $this->set('initial_assessments', $this->paginate());
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid id for initial assessment', true));
      $this->redirect(array('action'=>'index'));
    }
    if ($this->SiteCopy->delete($id)) {
      $this->Session->setFlash(__('Initial Assessment deleted', true));
      $this->redirect(array('action'=>'index'));
    }
    $this->Session->setFlash(__('Initial Assessment was not deleted', true));
    $this->redirect(array('action' => 'index'));
  }

  function admin_view($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid user', true));
      $this->redirect(array('action' => 'index'));
    }

    $initial_assessment = $this->InitialAssessment->read(null, $id);

    $this->set('initial_assessment', $initial_assessment);
  }
}       
?>      
