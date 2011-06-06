<div id="end-user-form" class="hidden" title="End User Agreement">
	<p style="text-align:center;">End User Agreement</p>
	<p>
	    Welcome! By registering in this e-Lawyers Online Website, I hereby agree that I will abide the terms and conditions of the use of this Website. I expressly acknowledge that I voluntarily registered in this Website, without force or compulsion from anyone, and it is not a result of a spam message and/or other similar advertising. I read and understood the contents of this terms and conditions of the use of this Website. I understand that this is subject to amendment by the owners thereof without notice to me and I undertake to be aware of any amendment or modification hereto. I expressly agree to respect the copyright, trademark, service mark or other intellectual property of the owner of this Website including all other proprietary rights as to the content, organization, design, process, compilation and the likes, and shall not use, copy, re-produce or publish without the written consent of the owner. I am given access to the E-Lawyers Online Website for internal, personal and non-commercial purpose and I shall use the same not for any other purpose. The e-Lawyers Online main page Website is for informational purposes only and is not meant to serve as legal advice or to replace legal consultation, which I can secure only upon proper registration with the online legal consultation process of this website. I acknowledge that the information on the e-Lawyers Online Main Page Website is provided "as is" for general information only. I therefore acknowledge that the Website, its owners, partners, employees, officers, directors, attorneys, and agents do not promise or guarantee that the content is correct, complete, or up-to-date. There is no guarantee that the content is correct, complete, or up-to-date for any specific circumstance or myself.
	</p>
	<p>
	    I agree that I will hold harmless the owner, employees, contributors and volunteers from all claims or damages whether actual or indirect, incidental, consequential, special, or exemplary damages or lost profits, arising out of or related to your access or use of, or my inability to access or use, this Website or the information contained in this Website or other websites to which it is linked. This includes, but is not limited to, information or materials viewed or downloaded from this Website or another website to which it is linked that appear to me or are construed by me to be obscene, offensive, defamatory, or that infringe upon my intellectual property rights.
	</p>
	<p>
	    I further agree that I shall not post or transmit any material which violates or infringes in any way upon the rights of others, which is unlawful, threatening, abusive, defamatory, invasive of privacy or publicity rights, vulgar, obscene, profane or otherwise objectionable, which encourages conduct that would constitute a criminal offense, give rise to civil liability or otherwise violate any law, or which, without the owner’s express prior approval, contains advertising or any solicitation with respect to products or services.
	</p>
	<p>
        I finally agree that this website disclaims ANY WARRANTIES THAT MAY BE EXPRESS OR IMPLIED BY LAW REGARDING THE CONTENTS, OPINIONS AND DISCUSSION IN THIS WEBSITE INCLUDING WARRANTIES AGAINST INFRINGEMENT. 
	</p>
	<p>
	    I agree that the governing law with respect the use of this website is Philippine law and jurisdiction of any action shall be Pasig City exclusively and to no other for adjudication.
	</p>
</div>

<div id="reject-alert" class="hidden" title="End User Agreement">
	<p style="padding-top:20px; text-align:center;">
	You must agree to continue.
	</p>
</div>

<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>

		<?php //echo $this->Form->create('User', array('onsubmit' => 'check_end_user(); return false;', 'name' => 'UserRegisterForm', 'inputDefaults' => array('class' => 'required')));?>
		<?php echo $this->Form->create('User', array('name' => 'UserRegisterForm'));?>
			<div class="form-title">Register</div>
			<div class="form-holder form-registration">
			<?php
				echo $this->Form->input('User.group_id', array('type' => 'hidden', 'value' => 3));
				
				$options=array('personal'=>'Personal','corporation'=>'Corporation/Partnership');
				echo $this->Form->input('User.type', array('type' => 'select', 'options'=>$options, 'label' => 'Please select type of account', 'empty' => 'Select', 'class' => 'required'));
				
				// echo '<div>Please select type of account</div>';
				// echo '<div><label>&nbsp;</label></div>';
				// echo '<span id="type">';
				// echo $this->Form->input('User.type', array('type' => 'radio', 'options'=>$options, 'div' => false, 'legend' => false, 'class' => 'type'));
				// echo '</span>';
				
				echo $this->Form->input('PersonalInfo.first_name', array('class' => 'required'));
				echo $this->Form->input('PersonalInfo.last_name', array('class' => 'required'));
				echo $this->Form->input('User.username', array('label' => 'Email', 'class' => 'required email'));
				echo $this->Form->input('User.password', array('value' => '', 'class' => 'required'));
				echo $this->Form->input('User.password_confirm', array('label' => 'Retype Password', 'type' => 'password', 'value' => '', 'class' => 'required'));
				echo $this->Form->input('PersonalInfo.gender', array('type' => 'select', 'options' => $custom->list_gender(), 'empty' => 'Select', 'class' => 'required'));
				// echo $this->Form->input('PersonalInfo.birth_date', array('minYear' => '1900', 'maxYear' => date('Y'), 'empty' => 'Select', 'after' => '<input type="hidden" id="birth_date_check" class="required">', 'class' => 'birth_date'));
				echo $this->Form->input('PersonalInfo.birth_date', array('type' => 'text', 'class' => 'birth_date required'));
				echo $this->Form->input('User.referred_by', array('type' => 'text', 'div' => 'referred-by'));
			?>
				<input type="hidden" id="agree-checker">
				<input type="submit" class="button-submit" value="">
			</div>
		<?php echo $this->Form->end();?>
	</div>
</div>

<?php $html->scriptBlock("register_form();", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>