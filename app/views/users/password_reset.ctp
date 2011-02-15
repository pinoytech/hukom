<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
		
		<h2>Password Reset</h2>
		<p>Please enter your new password</p>
		</br>
		<?php
		echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'password_reset')));
		echo $this->Form->input('User.id');
		echo $this->Form->input('User.username', array('type' => 'hidden'));
		echo $this->Form->input('User.password', array('label' => 'New Password', 'value' => ''));
		echo $this->Form->input('User.password_confirm', array('label' => 'Retype Password', 'type' => 'password', 'value' => ''));
		echo $this->Form->end('Submit');
		?>
	</div>
</div>