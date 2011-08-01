Dear Atty. Marlon P. Valderama:
<br />
<br />
I, <?php echo $User['PersonalInfo']['first_name']. ' ' . $User['PersonalInfo']['last_name'] ?>, with registered e-mail address of <?php echo $User['User']['username'];?>, of legal age, of which I am a:
<br />
<br />
<?php
if ($CaseRetainer['CaseRetainer']['client_type'] == 'new') {
    echo 'new client (those who are newly registered and have not completed fill-up forms)';
}
else {
    echo 'old client (those who are already registered and filled-up forms)';
}
?>
<br />
<br />
hereby intends to obtain from E-Lawyers Online your service for handling my: 
<br />
<br />
<?php
if ($CaseRetainer['CaseRetainer']['handle_type'] == 'case') {
    echo 'case (those actions involve prosecution or defense of your rights in court or in government agencies)';
}
else {
    echo 'project (those activities not covered/considered as a case mentioned above)';
}
?>
<br />
<br />
which is a:
<br />
<br />
<?php
if ($CaseRetainer['CaseRetainer']['case_project_type'] == 'new') {
    echo 'new case/project (those which are not yet filed in court or in government agencies or project not yet started)';
}
else {
    echo 'pending case/project (those which are already filed in court or government agencies or project already started)';
}
?>
<br />
<br />
<?php
if ($CaseRetainer['CaseRetainer']['case_title']) {
    echo 'Case Title: ' . $CaseRetainer['CaseRetainer']['case_title'] . '<br />';
    echo 'Case No.: ' . $CaseRetainer['CaseRetainer']['case_no'] . '<br />';
    echo 'Court Filed: ' . $CaseRetainer['CaseRetainer']['court_filed'] . '<br />';
    echo 'Branch No: ' . $CaseRetainer['CaseRetainer']['branch_no'] . '<br />';
}
?>
<br />
<br />
<?php
if ($CaseRetainer['CaseRetainer']['project_title']) {
    echo 'Project Title: ' . $CaseRetainer['CaseRetainer']['project_title'] . '<br />';
    echo 'Location: ' . $CaseRetainer['CaseRetainer']['location'] . '<br />';
}
?>
<br />
I/we agree to pay the amount of professional fee agreed upon under such terms and conditions of our case/project retainer agreement. 
For this purpose, I am providing you my/our personal information and the list of scope of services I/we require.
<br />
<br />
Respectfully submitted.