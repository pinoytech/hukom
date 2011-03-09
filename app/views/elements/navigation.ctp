<!-- <ul>
	<li><?php echo $this->Html->link(__('Dashboard', true), array('controller' => 'dashboard', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link(__('My Cases', true), array('controller' => 'cases', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link('Logout', '/users/logout', array()); ?></li>
</ul> -->

<div class="dashboard-navigation">
	<?php echo $this->Html->link(__('Profile', true), array('controller' => 'users', 'action' => 'personal_info', $id)); ?> | 
	<?php echo $this->Html->link(__('My Cases', true), array('controller' => 'legalcases', 'action' => 'index', $id)); ?> | 
	<?php echo $this->Html->link('Logout', '/users/logout', array()); ?>
</div>

<div>&nbsp;</div>