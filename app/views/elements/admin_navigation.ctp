<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Dashboard', true), array('admin' => true, 'controller' => 'dashboard', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Users', true), array('admin' => true, 'controller' => 'users', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Cases', true), array('admin' => true, 'controller' => 'legalcases', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Incomplete Cases', true), array('admin' => true, 'controller' => 'legalcasedetails', 'action' => 'incomplete')); ?></li>
		<li><?php echo $this->Html->link(__('Payments', true), array('admin' => true, 'controller' => 'payments', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Conference Calendar', true), array('admin' => true, 'controller' => 'events', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('Conference On-Time Payments', true), array('admin' => true, 'controller' => 'events', 'action' => 'on_time_payments_list')); ?></li>
		<li><?php echo $this->Html->link(__('Conference Late Payments', true), array('admin' => true, 'controller' => 'events', 'action' => 'late_payments')); ?></li>
		<li><?php echo $this->Html->link(__('Request Reschedule Conference', true), array('admin' => true, 'controller' => 'events', 'action' => 'request_reschedule_conference')); ?></li>
		<li><?php echo $this->Html->link(__('Groups', true), array('admin' => true, 'controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Initial Assessments', true), array('admin' => true, 'controller' => 'initial_assessments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Site Copies', true), array('admin' => true, 'controller' => 'static', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Ads Management', true), array('admin' => true, 'controller' => 'advertisements', 'action' => 'index')); ?> </li>
	</ul>
</div>
