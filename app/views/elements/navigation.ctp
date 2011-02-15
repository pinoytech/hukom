<ul>
	<li><?php echo $this->Html->link(__('Dashboard', true), array('controller' => 'dashboard', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link(__('My Cases', true), array('controller' => 'cases', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link('Logout', '/users/logout', array()); ?></li>
</ul>