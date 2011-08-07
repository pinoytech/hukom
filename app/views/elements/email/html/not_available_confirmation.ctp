Dear <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?>,
<br/>
<br/>

Your requested schedule is not available, please select your new schedule <a href="<?php echo $base_url . 'users/login?to=' . urlencode($base_url . 'legalcases/reschedule_conference/'. $Event['Event']['id'] . '/not_available');?>">here</a>.'
<br/>
<br/>

Please make sure that you added <?php echo ($Event['Event']['messenger_type'] == 'skype' ? 'attympvalderama' : 'attyvalderama@yahoo.com');?> in your list of contacts and have prepared the following requirements for a successful video consultation:
<br/>

	<ul>
		<li>Internet connection</li>
		<li>Computer/laptop with webcam</li>
		<li>Microphone and speaker or headset</li>
		<li>Skype/Yahoo Messenger</li>
	</ul>
	
<br/>

We advise you to be online 30 minutes before the scheduled video conference for purposes of testing the video, audio, and internet connection.
<br/>
<br/>

Please be reminded that in the event of your failure to attend/appear on the scheduled date and time of our video conference, your fee shall be forfeited in our favor, unless a written notice to reset the schedule is sent three (3) days before the scheduled video conference.
<br/>
<br/>

We greatly appreciate your trust and confidence on us by giving opportunity to E-Lawyers Online to render service for you.
<br/>
<br/>

Very truly yours,
<br/>
<br/>

E-Lawyers Online Team