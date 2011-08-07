Dear <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?>,
<br/>
<br/>

Your requested schedule is not available, please select your new schedule <a href="<?php echo $base_url . 'users/login?to=' . urlencode($base_url . 'legalcases/request_reschedule_conference/'. $RequestReschedule['RequestReschedule']['user_id'] .'/'. $RequestReschedule['RequestReschedule']['case_id'] .'/'. $RequestReschedule['RequestReschedule']['case_detail_id'] .'/'. $RequestReschedule['RequestReschedule']['id'] . '/' .  $conference .'/'. 'request');?>">here</a>.
<br/>
<br/>

We greatly appreciate your trust and confidence on us by giving opportunity to E-Lawyers Online to render service for you.
<br/>
<br/>

Very truly yours,
<br/>
<br/>

E-Lawyers Online Team