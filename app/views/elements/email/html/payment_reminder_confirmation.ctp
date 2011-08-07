Dear <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?>,
<br/>
<br/>
Greetings!
<br/>
<br/> 

<?php
$payment_form_link = $base_url . 'users/login?to=' . urlencode($base_url . 'payments/mode_of_payment/' . $Legalcasedetail['Legalcasedetail']['user_id'] . '/' . $Legalcasedetail['Legalcasedetail']['case_id'] . '/' . $Legalcasedetail['Legalcasedetail']['id']);
?>

<?php if ($legal_service == 'Case/Project Retainer') { ?>

This is to confirm our earlier understanding on the Proposed Retainer Agreement. Thank you for your trust and confidence on us for handling your case. Please be reminded that we did not receive the agreed fee based on our final Retainer Agreement. You may click this <a href="<?php echo $payment_form_link; ?>">link</a> for the payment of the agreed fees or call us at 02-4511594 or 09178981435.

<?php } ?>

<?php if ($legal_service == 'Monthly Retainer') { ?>

This refers to our recently executed Monthly Retainer Agreement and we hereby remind you of the agreed monthly retainer fee, which will be due on the 5th day of the month. You may click this <a href="<?php echo $payment_form_link; ?>">link</a> for the payment of the agreed fees or call us at 02-4511594 or 09178981435.
    
<?php } ?>

<br/>
<br/>
Very truly yours,
<br/>
<br/>
E-Lawyers Online Team