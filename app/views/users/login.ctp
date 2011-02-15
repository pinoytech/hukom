<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
	
		<h2>Log In</h2>
		<?php
		echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'login')));
		echo $this->Form->input('User.username', array('label' => 'Email'));
		echo $this->Form->input('User.password', array('value' => ''));
		echo $this->Form->end('Log In');
		?>
		<p>
		<?php echo $this->Html->link(__('Forgot your password?', true), array('action' => 'forgot_password')); ?>
		</p>
	</div>
</div>