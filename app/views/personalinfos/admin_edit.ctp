<div class="personalinfos form">
<?php echo $this->Form->create('Personalinfos');?>
	<fieldset>
 		<legend><?php __('Edit Personal Info'); ?></legend>
	<?php
		echo $this->Form->input('PersonalInfo.id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('PersonalInfo.user_id', array('type' => 'hidden'));
		echo $this->Form->input('PersonalInfo.email', array('readonly' => true));
		echo $this->Form->input('PersonalInfo.first_name');
		echo $this->Form->input('PersonalInfo.middle_name');
		echo $this->Form->input('PersonalInfo.last_name');
        echo $this->Form->input('PersonalInfo.gender', array('type' => 'select', 'options' => $list_gender));
		echo $this->Form->input('PersonalInfo.birth_date');
		echo $this->Form->input('PersonalInfo.birth_place');
		echo $this->Form->input('PersonalInfo.address_ph');
		echo $this->Form->input('PersonalInfo.address_abroad');
		echo $this->Form->input('PersonalInfo.telephone_no');
		echo $this->Form->input('PersonalInfo.cellphone_no');
		echo $this->Form->input('PersonalInfo.age');
		echo $this->Form->input('PersonalInfo.citizenship');
		echo $this->Form->input('PersonalInfo.education_attained', array('type' => 'select', 'options' => $list_education_attained));
		echo $this->Form->input('PersonalInfo.school');
		echo $this->Form->input('PersonalInfo.company_work');
		echo $this->Form->input('PersonalInfo.nature_of_business');
		echo $this->Form->input('PersonalInfo.company_address');
		echo $this->Form->input('PersonalInfo.work_position');
		echo $this->Form->input('PersonalInfo.work_duration');
		echo $this->Form->input('PersonalInfo.work_status', array('type' => 'select', 'options' => $list_work_status));
		echo $this->Form->input('PersonalInfo.civil_status', array('type' => 'select', 'options' => $list_civil_status));
		echo $this->Form->input('PersonalInfo.marriage_date');
		echo $this->Form->input('PersonalInfo.marriage_place');
		echo $this->Form->input('PersonalInfo.mothers_name');
		echo $this->Form->input('PersonalInfo.mothers_age');
		echo $this->Form->input('PersonalInfo.mothers_citizenship');
		echo $this->Form->input('PersonalInfo.mothers_address');
		echo $this->Form->input('PersonalInfo.fathers_name');
		echo $this->Form->input('PersonalInfo.fathers_age');
		echo $this->Form->input('PersonalInfo.fathers_citizenship');
		echo $this->Form->input('PersonalInfo.fathers_address');
	?>
	</fieldset>
	
	<?php echo $this->Form->end(__('Submit', true));?>
	
	<br />
	<div>
		<?php echo $this->Html->link(__('View', true), array('admin' => true, 'action' => 'view', $this->data['PersonalInfo']['id'])); ?>
		|
		<?php echo $this->Html->link(__('Case List', true), array('admin' => true, 'controller' => 'legalcases', 'action' => 'index', $this->data['User']['id'])); ?>
	</div>
	
</div>
<?php echo $this->element('admin_navigation'); ?>