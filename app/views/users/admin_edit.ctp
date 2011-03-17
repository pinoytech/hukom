<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('User.admin_edit_user', array('type' => 'hidden', 'value' => 1));
		echo $this->Form->input('User.id');
		echo $this->Form->input('User.username');
		echo $this->Form->input('User.password', array('type' => 'hidden'));
		echo $this->Form->input('User.password_confirm', array('type' => 'hidden', 'value' => '1'));
		echo $this->Form->input('User.new_password', array('label' => 'Change Password (enter value to change password)'));
		echo $this->Form->input('User.group_id');
	?>
	</fieldset>
	
	<fieldset>
 		<legend><?php __('Edit Personal Info'); ?></legend>
	<?php
		echo $this->Form->input('PersonalInfo.id');
		echo $this->Form->input('PersonalInfo.first_name');
		echo $this->Form->input('PersonalInfo.last_name');
		echo $this->Form->input('PersonalInfo.gender', array('type' => 'select', 'options' => $list_gender));
		echo $this->Form->input('PersonalInfo.birth_date', array('minYear' => '1900'));
	?>
	</fieldset>
	
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php echo $this->element('admin_navigation'); ?>