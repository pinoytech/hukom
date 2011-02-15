<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->element('profile_navigation');?>
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('User');?>
			<fieldset>
		 		<legend><?php __('Edit Spouse Information'); ?></legend>
				<?php
					echo $this->Form->input('User.id');
					echo $this->Form->input('SpouseInfo.id', array('value' => $this->data['SpouseInfo']['id']));
					echo $this->Form->input('SpouseInfo.user_id', array('type' => 'hidden', 'value' => $this->data['User']['id']));
					echo $this->Form->input('SpouseInfo.first_name');
					echo $this->Form->input('SpouseInfo.last_name');
					echo $this->Form->input('SpouseInfo.email');
					// echo $this->Form->input('SpouseInfo.gender', array('type' => 'select', 'options' => array('male' => 'Male', 'female' => 'Female')));
					if ($this->data['PersonalInfo']['gender'] == 'male') {
						$spouse_gender = 'Female';
					}
					else {
						$spouse_gender = 'Male';
					}
					echo $this->Form->input('SpouseInfo.gender', array('readonly' => true, 'value' => $spouse_gender));
					echo $this->Form->input('SpouseInfo.birth_date', array('minYear' => '1900', 'maxYear' => date('Y'), 'empty' => 'Select'));
					echo $this->Form->input('SpouseInfo.birth_place', array('label' => 'Place of Birth'));
					echo $this->Form->input('SpouseInfo.address_ph', array('label' => 'Address (Philippines)'));
					echo $this->Form->input('SpouseInfo.address_abroad', array('label' => 'Address (Abroad)'));
					echo $this->Form->input('SpouseInfo.telephone_no');
					echo $this->Form->input('SpouseInfo.cellphone_no');
					echo $this->Form->input('SpouseInfo.age');
					echo $this->Form->input('SpouseInfo.citizenship');
					echo $this->Form->input('SpouseInfo.education_attained');
					echo $this->Form->input('SpouseInfo.school');
					echo $this->Form->input('SpouseInfo.company_work', array('label' => 'Company/Work'));
					echo $this->Form->input('SpouseInfo.nature_of_business');
					echo $this->Form->input('SpouseInfo.company_address');
					echo $this->Form->input('SpouseInfo.work_position', array('label' => 'Work/Position'));
					echo $this->Form->input('SpouseInfo.work_duration');
					echo $this->Form->input('SpouseInfo.work_status', array('options' => array('regular' => 'Regular','probationary' => 'Probationary','casual' => 'Casual','project' => 'Project','other' => 'Other')));
					
				?>
								
			</fieldset>
		
			<table>
				<tr>
					<td>
						<?php echo $this->Html->link(__('Back', true), array('action' => 'personal_info', $this->data['User']['id'])); ?>
					</td>
					<td>
						<?php echo $this->Form->end(__('Next', true));?>
					</td>
				</tr>
			</table>
		
	</div>
</div>