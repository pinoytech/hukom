<?php
$soi_path       = $base_url . 'legalcases/summary_of_information/' .  $User['User']['id'] . '/' . $case_id . '/all/add/';
$per_query_link = urlencode($soi_path . 'perquery');
$video_link     = urlencode($soi_path . 'video');
$office_link    = urlencode($soi_path . 'office');
?>
Dear <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?>,
<br />
<br />
Thank you for availing our service. We hope that you are satisfied with the result of our study of your case.
<br />
<br />
Should you have any suggestions or comments, please feel free to visit this <a href="<?php echo $base_url . 'pages/contact_us/';?>">link</a>.
<br />
<br />
If you have further queries involving the same subject matter and have follow-up questions, please visit this <a href="<?php echo $base_url . 'users/login?to=' . $per_query_link ;?>">link</a>.  For a more personal consultation through Video Conference, you may click on this <a href="<?php echo $base_url . 'users/login?to=' . $video_link;?>">link</a> or for Office Conference, you may click on this <a href="<?php echo $base_url . 'users/login?to=' . $office_link;;?>">link</a> and E-Lawyers Online will voluntarily give you a discount.
<br />
<br />
Should you wish to retain our services or engage our firm to handle your case, we will be more than glad to arrange a  meeting with you at your most convenient schedule. You may get in touch with us at the following numbers:
<br />
<br />
<b>Telephone Nos.:</b> (02)683-02-37; (02)683-02-38; (02)683-02-40; (02)683-02-41<br />
<b>Cellphone (Globe):</b> (63)9178981435; (63)927-9845404<br />
<b>Cellphone (Smart):</b> (63)9498443880<br />
<br />
If you want a draft copy of our retainer agreements, you can download them from the links below:
<ul>
	<li><a href="<?php echo $base_url . 'pages/downloads/#';?>">Standard Retainer Agreement (Per Case)</a></li>
	<li><a href="<?php echo $base_url . 'pages/downloads/#';?>">Standard Retainer Agreement (Per Project)</a></li>
	<li><a href="<?php echo $base_url . 'pages/downloads/#';?>">Monthly Retainer Agreement</a></li>
</ul>
Very truly yours,
<br />
<br />
E-Lawyers Online Team