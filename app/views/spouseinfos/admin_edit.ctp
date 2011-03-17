<div class="SpouseInfos form">
<?php echo $this->Form->create('Spouseinfos');?>
	<fieldset>
 		<legend><?php __('Edit Personal Info'); ?></legend>
	<?php
		echo $this->Form->input('SpouseInfo.id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('SpouseInfo.user_id', array('type' => 'hidden'));
		echo $this->Form->input('SpouseInfo.email', array('readonly' => true));
		echo $this->Form->input('SpouseInfo.first_name');
		echo $this->Form->input('SpouseInfo.middle_name');
		echo $this->Form->input('SpouseInfo.last_name');
        echo $this->Form->input('SpouseInfo.gender', array('type' => 'select', 'options' => $list_gender));
		echo $this->Form->input('SpouseInfo.birth_date');
		echo $this->Form->input('SpouseInfo.birth_place');
		echo $this->Form->input('SpouseInfo.address_ph');
		echo $this->Form->input('SpouseInfo.address_abroad');
		echo $this->Form->input('SpouseInfo.telephone_no');
		echo $this->Form->input('SpouseInfo.cellphone_no');
		echo $this->Form->input('SpouseInfo.age');
		echo $this->Form->input('SpouseInfo.citizenship');
		echo $this->Form->input('SpouseInfo.education_attained', array('type' => 'select', 'options' => $list_education_attained));
		echo $this->Form->input('SpouseInfo.school');
		echo $this->Form->input('SpouseInfo.company_work');
		echo $this->Form->input('SpouseInfo.nature_of_business');
		echo $this->Form->input('SpouseInfo.company_address');
		echo $this->Form->input('SpouseInfo.work_position');
		echo $this->Form->input('SpouseInfo.work_duration');
		echo $this->Form->input('SpouseInfo.work_status', array('type' => 'select', 'options' => $list_work_status));
	?>
	</fieldset>
	
	<?php echo $this->Form->end(__('Submit', true));?>
	
	<br />
	<div>
		<?php echo $this->Html->link(__('View', true), array('admin' => true, 'action' => 'view', $this->data['SpouseInfo']['id'])); ?>
		|
		<?php echo $this->Html->link(__('View Personal Info', true), array('admin' => true, 'controller' => 'personalinfos', 'action' => 'view', $personal_info_id)); ?>
		|
		<?php echo $this->Html->link(__('Case List', true), array('admin' => true, 'controller' => 'legalcases', 'action' => 'index', $this->data['User']['id'])); ?>
	</div>
	
</div>
<?php echo $this->element('admin_navigation'); ?>