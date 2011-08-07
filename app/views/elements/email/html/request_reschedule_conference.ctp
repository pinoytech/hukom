Dear Admin,
<br />
<br />
User <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?> has requested to change his/her conference schedule
<br />
<br />
Request Reschedule Details:
<br />
<br />
User ID: <?php echo $RequestReschedule['RequestReschedule']['id'];?>
<br />
Case ID: <?php echo $RequestReschedule['RequestReschedule']['case_id'];?>
<br />
Case Detail ID: <?php echo $RequestReschedule['RequestReschedule']['case_detail_id'];?>
<br />
Original Event ID: <?php echo $RequestReschedule['RequestReschedule']['event_id'];?>
<br />
Date: <?php echo date('F d, Y', strtotime($RequestReschedule['RequestReschedule']['date']));?>
<br />
Start Time: <?php echo $RequestReschedule['RequestReschedule']['start'];?>
<br />
End Time: <?php echo $RequestReschedule['RequestReschedule']['end'];?>
<br />
Notes: <?php echo $RequestReschedule['RequestReschedule']['notes'];?>
<br />
<br />
<a href="<?php echo $base_url . 'admin/events'?>">Login to Admin</a>
<br />
<br />
Regards,
<br />
<br />
E-Lawyers Online Team