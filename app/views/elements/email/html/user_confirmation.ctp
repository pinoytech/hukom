<p>Dear <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?>,</p>

<p>Congratulations! Your account has been successfully created. </p>

<p>To complete the sign-up process and verify your account, please click <a href="<?php echo 'http://'. $_SERVER['SERVER_NAME'] . '/users/verification/' . $User['User']['id'];?>">here</a>.</p>

<!-- <p>Please click this <a href="<?php //echo 'http://'. $_SERVER['SERVER_NAME'] . '/users/login/';?>">link</a> to login to your dashboard.</p> -->

<p>Regards,</p>
<p>E-Lawyers Online Team</p>