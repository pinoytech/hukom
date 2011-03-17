<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->element('corporate_navigation');?>
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('User');?>
			<fieldset>
		 		<legend><?php __('Edit Corporate/Partnership Representative Information'); ?></legend>
				<?php
					echo $this->Form->input('User.id');
					echo $this->Form->input('CorporateInfo.id');
					echo $this->Form->input('CorporateInfo.first_name');
					echo $this->Form->input('CorporateInfo.last_name');
					echo $this->Form->input('CorporateInfo.email');
					echo $this->Form->input('CorporateInfo.gender', array('type' => 'select', 'options' => $list_gender));
					echo $this->Form->input('CorporateInfo.birth_date', array('minYear' => '1900', 'empty' => 'Select'));
					echo $this->Form->input('CorporateInfo.birth_place', array('label' => 'Place of Birth'));
					echo $this->Form->input('CorporateInfo.address_ph', array('label' => 'Address (Philippines)'));
					echo $this->Form->input('CorporateInfo.address_abroad', array('label' => 'Address (Abroad)'));
					echo $this->Form->input('CorporateInfo.telephone_no');
					echo $this->Form->input('CorporateInfo.cellphone_no');
					echo $this->Form->input('CorporateInfo.age');
					echo $this->Form->input('CorporateInfo.citizenship');
					echo $this->Form->input('CorporateInfo.education_attained');
					echo $this->Form->input('CorporateInfo.school');
					echo $this->Form->input('CorporateInfo.company_work', array('label' => 'Company/Work'));
					echo $this->Form->input('CorporateInfo.nature_of_business');
					echo $this->Form->input('CorporateInfo.company_address');
					echo $this->Form->input('CorporateInfo.work_position', array('label' => 'Work/Position'));
					echo $this->Form->input('CorporateInfo.work_duration');
					echo $this->Form->input('CorporateInfo.work_status');
					echo $this->Form->input('CorporateInfo.civil_status');
					echo $this->Form->input('CorporateInfo.marriage_date', array('label' => 'Date of Marriage', 'minYear' => '1900', 'maxYear' => date('Y'), 'empty' => 'Select'));
					echo $this->Form->input('CorporateInfo.marriage_place', array('label' => 'Place of Marriage'));
				?>
				
			</fieldset>
		<?php echo $this->Form->end(__('Submit', true));?>
	</div>
</div>