Dear <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?>,
<br />
<br />
Congratulations! Your account has been successfully created.
<br />
<br />
To complete the sign-up process and verify your account, please click <a href="<?php echo 'http://'. $_SERVER['SERVER_NAME'] . '/users/verification/' . $User['User']['id'];?>">here</a>.
<br />
<br />
Regards,
<br />
<br />
E-Lawyers Online Team