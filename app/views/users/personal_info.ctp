<script type="text/javascript">
jQuery('document').ready(function() {
	jQuery('.civil-status').change(function() {
		if (jQuery(this).val() == 'single') {
			jQuery('.marriage-input').val('');
		};
	});		
});
</script>
<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php
		if ($auth_user_type == 'personal') {
			echo $this->element('profile_navigation');
		}
		?>
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('User');?>
			<fieldset>
		 		<legend><?php __('Edit Personal Information'); ?></legend>
				<?php
					echo $this->Form->input('User.id');
					echo $this->Form->input('PersonalInfo.id');
					echo $this->Form->input('PersonalInfo.first_name');
					echo $this->Form->input('PersonalInfo.last_name');
					echo $this->Form->input('PersonalInfo.email', array('readonly' => true));
					echo $this->Form->input('PersonalInfo.gender', array('type' => 'select', 'options' => array('male' => 'Male', 'female' => 'Female')));
					echo $this->Form->input('PersonalInfo.birth_date', array('minYear' => '1900', 'maxYear' => date('Y'), 'empty' => 'Select'));
					echo $this->Form->input('PersonalInfo.birth_place', array('label' => 'Place of Birth'));
					echo $this->Form->input('PersonalInfo.address_ph', array('label' => 'Address (Philippines)'));
					echo $this->Form->input('PersonalInfo.address_abroad', array('label' => 'Address (Abroad)'));
					echo $this->Form->input('PersonalInfo.telephone_no');
					echo $this->Form->input('PersonalInfo.cellphone_no');
					echo $this->Form->input('PersonalInfo.age');
					echo $this->Form->input('PersonalInfo.citizenship');
					echo $this->Form->input('PersonalInfo.education_attained');
					echo $this->Form->input('PersonalInfo.school');
					echo $this->Form->input('PersonalInfo.company_work', array('label' => 'Company/Work'));
					echo $this->Form->input('PersonalInfo.nature_of_business');
					echo $this->Form->input('PersonalInfo.company_address');
					echo $this->Form->input('PersonalInfo.work_position', array('label' => 'Work/Position'));
					echo $this->Form->input('PersonalInfo.work_duration');
					echo $this->Form->input('PersonalInfo.work_status', array('options' => array('regular' => 'Regular','probationary' => 'Probationary','casual' => 'Casual','project' => 'Project','other' => 'Other')));
					echo $this->Form->input('PersonalInfo.civil_status', array('options' => array('single' => 'Single','married' => 'Married','separated' => 'Separated','divorced/annulled' => 'Divorced/Annulled'), 'class' => 'civil-status'));
					echo $this->Form->input('PersonalInfo.marriage_date', array('label' => 'Date of Marriage', 'minYear' => '1900', 'maxYear' => date('Y'), 'empty' => 'Select', 'class' => 'marriage-input'));
					echo $this->Form->input('PersonalInfo.marriage_place', array('label' => 'Place of Marriage', 'class' => 'marriage-input'));
					echo $this->Form->input('PersonalInfo.mothers_name', array('label' => "Mother's Name"));
					echo $this->Form->input('PersonalInfo.mothers_age', array('label' => "Mother's Age"));
					echo $this->Form->input('PersonalInfo.mothers_citizenship', array('label' => "Mother's Citizenship"));
					echo $this->Form->input('PersonalInfo.mothers_address', array('label' => "Mother's Address"));
					echo $this->Form->input('PersonalInfo.fathers_name', array('label' => "Father's Name"));
					echo $this->Form->input('PersonalInfo.fathers_age', array('label' => "Father's Age"));
					echo $this->Form->input('PersonalInfo.fathers_citizenship', array('label' => "Father's Citizenship"));
					echo $this->Form->input('PersonalInfo.fathers_address', array('label' => "Father's Address"));
					
				?>
				
			</fieldset>
		
		<?php echo $this->Form->end(__('Next', true));?>
		
	</div>
</div>