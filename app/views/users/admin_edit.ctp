<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('User.admin_edit_user', array('type' => 'hidden', 'value' => 1));
		echo $this->Form->input('User.type', array('type' => 'hidden'));
		echo $this->Form->input('User.id');
		echo $this->Form->input('User.username', array('readonly' => true));
		echo $this->Form->input('User.password', array('type' => 'hidden'));
		echo $this->Form->input('User.password_confirm', array('type' => 'hidden', 'value' => '1'));
		echo $this->Form->input('User.new_password', array('label' => 'Change Password (enter value to change password)'));
		echo $this->Form->input('User.group_id');
	?>
	</fieldset>
	
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<?php echo $this->element('admin_navigation'); ?>