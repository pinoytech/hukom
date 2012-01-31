<?php
class AdvertisementsController extends AppController {
  var $name = 'Advertisements';
  var $helpers = array('Html', 'TinyMce.TinyMce');

  function beforeFilter() {	    
    parent::beforeFilter(); 
  }

  //Admin Methods
  function admin_index() {
    $this->Advertisement->recursive = 0;
    $this->paginate = array(
      'order' => array('id' => 'desc')
    );
    $this->set('advertisements', $this->paginate());
  }

  function admin_add() {
    $this->render('admin_form');
  }   

  function admin_edit($id) {
    $this->data = $this->Advertisement->read(null, $id);
    $this->render('admin_form');
  }   

  function admin_form() {

    if (!empty($this->data)) {
      if (!$this->data['Advertisement']['id']) {
        $this->Advertisement->create();
      }

      if ($this->Advertisement->save($this->data)) {
        $this->Session->setFlash(__('The Advertisement has been saved', true));
        //$this->redirect(array('action' => 'index'));
        $this->redirect(array('action' => 'edit', $this->Advertisement->id));
      } else {
        $this->Session->setFlash(__('The Advertisement could not be saved. Please, try again.', true));
      }
    }
  }

  function admin_delete($id = null) {
    if (!$id) {
      $this->Session->setFlash(__('Invalid ID for Advertisement', true));
      $this->redirect(array('action'=>'index'));
    }
    if ($this->Advertisement->delete($id)) {
      $this->Session->setFlash(__('Advertisement deleted', true));
      $this->redirect(array('action'=>'index'));
    }
    $this->Session->setFlash(__('Advertisement was not deleted', true));
    $this->redirect(array('action' => 'index'));
  }
}       
?>
