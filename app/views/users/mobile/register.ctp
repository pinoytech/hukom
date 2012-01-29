<div id="end-user-form" class="hidden" title="End User Agreement">
	<?php echo SiteCopy::excerpt('end_user_agreement'); ?>
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
        echo '<div class="input text" style="margin-top:0;font-size:11px;">
          <label>&nbsp;</label>
          (ex: 1974-12-31)
        </div>';
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
