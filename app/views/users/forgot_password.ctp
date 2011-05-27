<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
		
		<div class="form-title">Forgot Password</div>
		<div class="form-holder form-login">
		<p>Please enter your email address to re-set to a new password</p>
		</br>
		<?php
		echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'forgot_password')));
		echo $this->Form->input('User.username', array('label' => 'Email', 'class' => 'required email'));
		echo $this->Form->end('Submit');
		?>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery('document').ready(function() {
	//jQuery Valdidate
	jQuery("#UserForgotPasswordForm").validate();
});
</script>

<?php echo $html->script('form-hacks');?>
