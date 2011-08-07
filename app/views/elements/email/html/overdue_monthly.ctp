Dear <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?>,
<br/>
<br/>
Greetings!
<br/>
<br/> 
Please be reminded of the monthly retainer fee, which will be due on the 5th day of the month. You may click this <a href="<?php echo $base_url . 'users/login?to=' . urlencode($base_url . 'payments/mode_of_payment/' . $Legalcasedetail['Legalcasedetail']['user_id'] . '/' . $Legalcasedetail['Legalcasedetail']['case_id'] . '/' . $Legalcasedetail['Legalcasedetail']['id']) ;?>">link</a> for the payment of the agreed fees.
<br/>
<br/>
Thank you for your usual prompt action on this matter.
<br/>
<br/>
Very truly yours,
<br/>
<br/>
E-Lawyers Online Team