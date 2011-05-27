<ul>
	<li><?php echo $this->Html->link(__('Edit Personal Information', true), array('controller' => 'users', 'action' => 'personal_info', $id)); ?></li>
	<li><?php echo $this->Html->link(__('Edit Spouse Information', true), array('controller' => 'users', 'action' => 'spouse_info', $id)); ?></li>
	<li><?php echo $this->Html->link(__('Edit Children Information', true), array('controller' => 'users', 'action' => 'children_info', $id)); ?></li>
</ul>