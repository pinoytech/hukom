<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
		
		<h2>Forgot Password</h2>
		<p>Please enter your email address to re-set to a new password</p>
		</br>
		<?php
		echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'forgot_password')));
		echo $this->Form->input('User.username', array('label' => 'Email'));
		echo $this->Form->end('Submit');
		?>
	</div>
</div>