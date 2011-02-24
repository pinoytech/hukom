<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
			<div class="form-title">Spouse Information</div>
			<div class="form-holder form-personal-info">
				<?php echo $this->Form->create('User');?>
				<?php
					echo $this->Form->input('User.case_id', array('type' => 'hidden', 'value' => $case_id));
					
					echo $this->Form->input('SpouseInfo.id', array('value' => $this->data['SpouseInfo']['id']));
					echo $this->Form->input('SpouseInfo.user_id', array('type' => 'hidden', 'value' => $this->data['User']['id']));
					
					echo '<div class="row three-field">';
					echo $this->Form->input('SpouseInfo.first_name', array('class' => 'required'));
					echo $this->Form->input('SpouseInfo.middle_name', array('class' => 'required'));
					echo $this->Form->input('SpouseInfo.last_name', array('class' => 'required'));
					echo '</div>';

					echo '<div class="row full-field">';
					echo $this->Form->input('SpouseInfo.address_ph', array('label' => 'Address (Philippines)', 'class' => 'required'));
					echo '</div>';
					
					echo '<div class="row full-field">';
					echo $this->Form->input('SpouseInfo.address_abroad', array('label' => 'Address (Abroad)', 'class' => 'required'));
					echo '</div>';
					
					echo '<div class="row three-field">';
					echo $this->Form->input('SpouseInfo.telephone_no', array('class' => 'required'));
					echo $this->Form->input('SpouseInfo.cellphone_no', array('class' => 'required'));
					echo $this->Form->input('SpouseInfo.email', array('class' => 'required email'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('SpouseInfo.birth_date', array('type' => 'text', 'class' => 'required birth_date'));
					echo $this->Form->input('SpouseInfo.birth_place', array('label' => 'Place of Birth'));
					echo '</div>';
					
					echo '<div class="row three-field">';
					if ($this->data['PersonalInfo']['gender'] == 'male') {
						$spouse_gender = 'Female';
					}
					else {
						$spouse_gender = 'Male';
					}
					echo $this->Form->input('SpouseInfo.gender', array('readonly' => true, 'value' => $spouse_gender));
					echo $this->Form->input('SpouseInfo.age', array('class' => 'required digits'));
					echo $this->Form->input('SpouseInfo.citizenship', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('SpouseInfo.education_attained', array('class' => 'required'));
					echo $this->Form->input('SpouseInfo.school', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row two-field">';
					echo $this->Form->input('SpouseInfo.company_work', array('label' => 'Company/Work', 'class' => 'required'));
					echo $this->Form->input('SpouseInfo.nature_of_business', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row full-field">';
					echo $this->Form->input('SpouseInfo.company_address', array('class' => 'required'));
					echo '</div>';
					
					echo '<div class="row three-field">';
					echo $this->Form->input('SpouseInfo.work_position', array('label' => 'Work/Position','class' => 'required'));
					echo $this->Form->input('SpouseInfo.work_duration', array('class' => 'required'));
					echo $this->Form->input('SpouseInfo.work_status', array('options' => array('regular' => 'Regular','probationary' => 'Probationary','casual' => 'Casual','project' => 'Project','other' => 'Other'),'class' => 'required', 'empty' => 'Select'));
					echo '</div>';
				?>
				<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
				</form>				
			</div>
			<br />
			<table>
				<tr>
					<td>
						<input type="button" id="back" value="Back" />
					</td>
					<td>
						<input type="button" id="next" value="Next" />
					</td>
				</tr>
			</table>
		
	</div>
</div>
<?php echo $html->script('form-hacks');?>

<script type="text/javascript">
jQuery('document').ready(function() {	
	//jQuery Valdidate
	jQuery("#UserSpouseInfoForm").validate();
	
	//Submit button logic
	jQuery('#back').click(function() {
		jQuery('#goto').val('personal_info');
		
		// alert(jQuery('#SpouseInfoId').val());
		
		if (jQuery('#SpouseInfoId').val() == '') {
			
			var agree=confirm("Data you provided on this form will be discared. Do you want to continue?");
	        if (agree){                        
	           window.location = '/users/personal_info/<?php echo $id ?>/<?php echo $case_id ?>';
	        }
	        else{
	           return false;
	        }
		}
		else{
			jQuery('form').submit();
		}
	});

	jQuery('#next').click(function() {
		jQuery('#goto').val('children_info');
		jQuery('form').submit();
	});
});
</script>

