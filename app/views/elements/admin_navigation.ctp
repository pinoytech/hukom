<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Dashboard', true), array('admin' => true, 'controller' => 'dashboard', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Users', true), array('admin' => true, 'controller' => 'users', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Cases', true), array('admin' => true, 'controller' => 'legalcases', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Payments', true), array('admin' => true, 'controller' => 'payments', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Groups', true), array('admin' => true, 'controller' => 'groups', 'action' => 'index')); ?> </li>
	</ul>
</div>