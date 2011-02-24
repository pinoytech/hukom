<!-- <ul>
	<li><?php echo $this->Html->link(__('Dashboard', true), array('controller' => 'dashboard', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link(__('My Cases', true), array('controller' => 'cases', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link('Logout', '/users/logout', array()); ?></li>
</ul> -->

<div class="dashboard-navigation">
	<?php echo $this->Html->link(__('Profile', true), array('controller' => 'users', 'action' => 'personal_info', $id)); ?> | 
	<?php echo $this->Html->link(__('My Cases', true), array('controller' => 'legalcases', 'action' => 'index', $id)); ?> | 
	<?php echo $this->Html->link(__('Payment Options', true), array('controller' => 'legalcases', 'action' => 'index', $id)); ?> | 
	<?php echo $this->Html->link(__('Video/Office Conference', true), array('controller' => 'legalcases', 'action' => 'index', $id)); ?> | 
	<?php echo $this->Html->link(__('Monthly Retainer', true), array('controller' => 'legalcases', 'action' => 'index', $id)); ?> | 
	<?php echo $this->Html->link(__('Case Retainer', true), array('controller' => 'legalcases', 'action' => 'index', $id)); ?> |
	<?php echo $this->Html->link('Logout', '/users/logout', array()); ?>
</div>

<div>&nbsp;</div>