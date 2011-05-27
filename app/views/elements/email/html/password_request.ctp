<p>Dear <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?>,</p>

<p>We received your request to reset your E-Lawyers Online password.</p>

<p>To reset your password, please click this <a href="<?php echo 'http://'. $_SERVER['SERVER_NAME'] . '/users/password_reset/'. $User['User']['id'];?>">link</a></p>

<p>Best regards,</p>
<p>E-Lawyers Online Team</p>


