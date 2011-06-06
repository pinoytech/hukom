<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
	
		<div class="form-title">Login</div>
		<div class="form-holder form-login">
		<?php
		echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'login')));
		echo $this->Form->input('User.username', array('label' => 'Email', 'class' => 'required email'));
		echo $this->Form->input('User.password', array('value' => '', 'class' => 'required'));
		echo $this->Form->end('login.jpg');
		?>
		<br />
		<p>
		<?php echo $this->Html->link(__('Forgot your password?', true), array('action' => 'forgot_password')); ?>
		</p>
		</div>
	</div>
</div>

<?php $html->scriptBlock("login_form();", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>