<?php
class AppController extends Controller {
  // var $components = array('Acl', 'Auth', 'Session', 'DebugKit.Toolbar');
  var $components = array('Acl', 'Auth', 'Session', 'RequestHandler', 'Custom');
  // var $components = array('Acl', 'Auth', 'Session');
  var $helpers = array('Html', 'Form', 'Session');
  var $admin_email = array('gino.carlo.cortez@gmail.com');
  //var $admin_email = array('gino.carlo.cortez@gmail.com', 'attyvalderama@gmail.com', 'redgfernandez@yahoo.com', 'redgfernandez@gmail.com', 'attyvalderama@e-lawyersonline.com');

  var $uploads_path = '/app/webroot/uploads/';

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
      // debug($this->params);

      //Logout User if User ID accesed is not valid
        /*
        if (isset($this->params['pass'][0])) {
                // debug('here');
                if ($this->params['pass'][0] != $this->Auth_user['User']['id']) {
                    $this->Session->setFlash(__('Invalid User. Please try again.', true));
                    $this->Auth->logout();
            }
        }
         */

      //Redirect from close confirmation email
      if (isset($this->params['url']['to'])) {
        $this->Auth->logout();
        header("location:" . $this->params['url']['to']);
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
      }
      else {
        $this->Auth->loginRedirect = array('controller' => 'home', 'action' => 'index');
      }

    }

    // check for mobile devices
    // if ($this->RequestHandler->isMobile()) {
    //     // if device is mobile, change layout to mobile
    //     $this->layout = 'mobile';
    //     // and if a mobile view file has been created for the action, serve it instead of the default view file
    //     $mobileViewFile = VIEWS . strtolower($this->params['controller']) . '/mobile/' . $this->params['action'] . '.ctp';
    //     if (file_exists($mobileViewFile)) {
    //         $mobileView = strtolower($this->params['controller']) . '/mobile/';
    //         $this->viewPath = $mobileView;
    //     }
    // }

    //Set global user variable for View (i.e. navigation)
    $this->set('auth_user_type', $this->Auth_user['User']['type']);
    $this->set('auth_user_id', $this->Auth_user['User']['id']);
    $this->set('base_url', 'https://'.$_SERVER['SERVER_NAME'].Router::url('/'));
    $this->set('uploads_path', $this->uploads_path);
    $this->loadModel('SiteCopy');
    $this->loadModel('Advertisement');
  }

  function afterFilter() {        
  }

  // Redirect admin to admin_index of controller
  function redirect_to_admin_index() {

    if ($this->Auth_user['User']['group_id'] == 1) {
      $this->redirect(array('admin' => true, 'action' => 'admin_index'));
    }
  }

  //Facebook Stuffs Here
  function facebook() {
    App::import('Vendor', 'facebook', array('file' => 'facebook/facebook.php'));
    $facebook = new Facebook(array(
      'appId'  => Configure::read("FB_APP_ID"),
      'secret' => Configure::read("FB_APP_SECRET"),
    ));

    $user = $facebook->getUser();

    if ($user) {
      try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
      } catch (FacebookApiException $e) {
        error_log($e);
        $user = null;
      }
    }

    // var_dump($user_profile);

    // Login or logout url will be needed depending on current user state.
    if ($user) {
      $logoutUrl = $facebook->getLogoutUrl();

      //Check if user is already registered
      $this->loadModel('User');
      $check_user = $this->User->findByUsername($user_profile['email']);

      if ($check_user) {
        //Check if user has an facebook_id
        if (!$check_user['User']['facebook_id']) {
          $this->User->id = $check_user['User']['id'];
          $this->User->saveField('facebook_id', $user_profile['id']);
        }

        $this->Auth->login($check_user);
      }
      else {
        //Create User
        $this->User->create();

        $fieldList = array(
          'user_id',
          'group_id',
          'type',
          'first_name',
          'last_name',
          'username',
          'password',
          'password_confirm',
          'gender',
          'birth_date',
          'referred_by',
          'facebook_id',
          'email',
          'verified',
        );

        //Generate Random Password
        $password = $this->generatePassword();

        //Convert Date
        $birthday     = explode('/', $user_profile['birthday']);
        $new_birthday = $birthday['2'] . '-' . $birthday['0'] . '-' . $birthday['1'];

        //Assign Data to be saved              
        $this->data['User']['group_id']           = 3;
        $this->data['User']['type']               = 'personal';
        $this->data['PersonalInfo']['first_name'] = $user_profile['first_name'];
        $this->data['PersonalInfo']['last_name']  = $user_profile['last_name'];
        $this->data['PersonalInfo']['email']      = $user_profile['email'];
        $this->data['User']['username']           = $user_profile['email'];
        $this->data['User']['password']           = $password;
        $this->data['User']['password_confirm']   = $password;
        $this->data['PersonalInfo']['gender']     = ucfirst($user_profile['gender']);
        $this->data['PersonalInfo']['birth_date'] = $new_birthday;
        $this->data['User']['referred_by']        = null;
        $this->data['User']['verified']           = 'yes';
        $this->data['User']['facebook_id']        = $user_profile['id'];

        // var_dump($this->data);

        $this->User->validate = array(); //Remove model validation

        if ($this->User->saveAll($this->data, array('fieldList' => $fieldList))) {

          //Create User_ID Folder 
          $file = $_SERVER{'DOCUMENT_ROOT'} . $this->uploads_path . $this->User->id;

          mkdir($file);
          chmod($file, 0755);

          if ($this->data['User']['type'] == 'corporation') {
            //Create Attachments Folder for Corporate Accounts
            $file = $_SERVER{'DOCUMENT_ROOT'} . $this->uploads_path . $this->User->id . '/attachments'; 
            mkdir($file);
            chmod($file, 0755);
          }

          $this->redirect(array('controller' => 'static', 'action' => 'page', 'thank_you_fb'));
        }
      }

      $this->set('user', $user);
      $this->set('user_profile', $user_profile);
      $this->set('logoutUrl', $logoutUrl);

    } else {
      $loginUrl = $facebook->getLoginUrl(
        array('scope' => 'email, user_about_me, user_birthday')
      );

      $this->set('loginUrl', $loginUrl);
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
    $this->Email->replyTo  = 'no-reply@e-lawyersonline.com';
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

  //Generate random strings
  function generatePassword ($length = 8){
    // start with a blank password
    $password = "";

    // define possible characters
    $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 

    // set up a counter
    $i = 0; 

    // add random characters to $password until $length is reached
    while ($i < $length) { 	
      // pick a random character from the possible ones
      $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);	        
      // we don't want this character if it's already in the password
      if (!strstr($password, $char)) { 
        $password .= $char;
        $i++;
      }	
    }	
    // done!
    return $password;	
  }
}
?>
