<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('User');?>
			<div class="form-title">Personal Information</div>
			<div class="form-holder form-personal-info">
				<?php
					echo $this->Form->input('User.id');
					echo $this->Form->input('PersonalInfo.id');
					echo $this->Form->input('User.case_id', array('type' => 'hidden', 'value' => $case_id));
					
					echo '<div class="row three-field">';
					echo $this->Form->input('PersonalInfo.first_name', array('class' => 'required'));
					echo $this->Form->input('PersonalInfo.middle_name', array('class' => 'required'));
					echo $this->Form->input('PersonalInfo.last_name', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row full-field">';
					echo $this->Form->input('PersonalInfo.address_ph', array('label' => 'Address (Philippines)', 'class' => 'required', 'style' => ''));
					echo '</div>';
					
					echo '<div class="row full-field">';
					echo $this->Form->input('PersonalInfo.address_abroad', array('label' => 'Address (Abroad)', 'style' => ''));
					echo '</div>';
					
					echo '<div class="row three-field">';
					echo $this->Form->input('PersonalInfo.telephone_no', array('class' => 'required digits'));
					echo $this->Form->input('PersonalInfo.cellphone_no', array('class' => 'required digits'));
					echo $this->Form->input('PersonalInfo.email', array('readonly' => true));
					echo '</div>';
					
					echo '<div class="row two-field">';
					// echo $this->Form->input('PersonalInfo.birth_date', array('minYear' => '1900', 'maxYear' => date('Y'), 'empty' => 'Select', 'label' => 'Date of Birth', 'after' => '<input type="hidden" id="birth_date_check" class="required">', 'class' => 'birth_date'));
					echo $this->Form->input('PersonalInfo.birth_date', array('type' => 'text', 'class' => 'birth_date'));
					echo $this->Form->input('PersonalInfo.birth_place', array('label' => 'Place of Birth', 'class' => 'required'));
					echo '</div>';
					
					echo '<div class="row three-field">';
					echo $this->Form->input('PersonalInfo.gender', array('type' => 'select', 'empty' => 'Select', 'class' => 'required', 'options' => $list_gender));
					echo $this->Form->input('PersonalInfo.age', array('class' => 'required digits'));
					echo $this->Form->input('PersonalInfo.citizenship', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('PersonalInfo.education_attained', array('class' => 'required', 'type' => 'select', 'options' => $list_education_attained, 'empty' => 'Select One'));
					echo $this->Form->input('PersonalInfo.school', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('PersonalInfo.company_work', array('label' => 'Company/Work', 'class' => 'required'));
					echo $this->Form->input('PersonalInfo.nature_of_business', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row full-field">';
					echo $this->Form->input('PersonalInfo.company_address', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row three-field">';
					echo $this->Form->input('PersonalInfo.civil_status', array('options' => $list_civil_status, 'empty' => 'Select', 'class' => 'civil-status required'));
					// echo $this->Form->input('PersonalInfo.marriage_date', array('label' => 'Date of Marriage', 'minYear' => '1900', 'maxYear' => date('Y'), 'empty' => 'Select', 'class' => 'marriage_date', 'validate' => 'required:true'));
					echo $this->Form->input('PersonalInfo.marriage_date', array('type' => 'text', 'class' => 'birth_date marriage_date'));
					echo $this->Form->input('PersonalInfo.marriage_place', array('label' => 'Place of Marriage', 'class' => 'marriage-input'));
					echo '</div>';
					
					echo '<div class="row three-field">';
					echo $this->Form->input('PersonalInfo.work_position', array('label' => 'Work/Position', 'class' => 'required'));
					echo $this->Form->input('PersonalInfo.work_duration', array('class' => 'required'));
					echo $this->Form->input('PersonalInfo.work_status', array('options' => $list_work_status, 'class' => 'required', 'empty' => 'Select'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('PersonalInfo.mothers_name', array('label' => "Mother's Name"));
					echo $this->Form->input('PersonalInfo.mothers_age', array('label' => "Mother's Age", 'class' => 'digits'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('PersonalInfo.mothers_citizenship', array('label' => "Mother's Citizenship"));
					echo $this->Form->input('PersonalInfo.mothers_address', array('label' => "Mother's Address"));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('PersonalInfo.fathers_name', array('label' => "Father's Name"));
					echo $this->Form->input('PersonalInfo.fathers_age', array('label' => "Father's Age", 'class' => 'digits'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('PersonalInfo.fathers_citizenship', array('label' => "Father's Citizenship"));
					echo $this->Form->input('PersonalInfo.fathers_address', array('label' => "Father's Address"));
					echo '</div>';
				?>
			</div>
			<br />
	    <?php
		if ($case_id) {
		    echo $this->Form->end(__('Next', true));
		}
		else {
		    echo $this->Form->end(__('Save', true));
		}
		?>
	</div>
</div>

<?php echo $html->script('form-hacks');?>

<script type="text/javascript">
jQuery('document').ready(function() {
	
	//jQuery Valdidate
	jQuery("#UserPersonalInfoForm").validate({
	    submitHandler: function(form) {
			
			if (jQuery('#PersonalInfoCivilStatus').val() == 'Married' || jQuery('#PersonalInfoCivilStatus').val() == 'Divorced/Annulled'){
                    
			    if (jQuery('#PersonalInfoMarriageDate').val() == '' || jQuery('#PersonalInfoMarriagePlace').val() == '') {
			       alert('Marriage Date and Marriage Place must not be empty');
			       return false;
			    }
			}
			
			form.submit();
		}
	});
	
	//Disable Marriage Fields
	if (jQuery('#PersonalInfoCivilStatus').val() == '' || jQuery('#PersonalInfoCivilStatus').val() == 'Single' || jQuery('#PersonalInfoCivilStatus').val() == 'Living In') {
		bool = true;
	}
	else {
		bool = false;
	}
	jQuery('.marriage_date').attr('disabled', bool);
	jQuery('#PersonalInfoMarriagePlace').attr('disabled', bool);
	
	jQuery('#PersonalInfoCivilStatus').change(function(){
		if (jQuery(this).val() == 'Single' || jQuery(this).val() == '' || jQuery(this).val() == 'Living In') {
			bool = true;
			jQuery('#PersonalInfoMarriagePlace').val('');
			jQuery('#PersonalInfoMarriageDate').val('');
		}
		else{
			bool = false;
		}
		jQuery('.marriage_date').attr('disabled', bool);
		jQuery('#PersonalInfoMarriagePlace').attr('disabled', bool);
		
	});
	
});
</script>
