Dear <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?>,
<br />
<br />
We received your request to reset your E-Lawyers Online password.
<br />
<br />
To reset your password, please click this <a href="<?php echo $base_url . 'users/login?to=' . urlencode($base_url . 'users/password_reset/'. $User['User']['id']);?>">link</a>
<br />
<br />
Best regards,
<br />
<br />
E-Lawyers Online Team


