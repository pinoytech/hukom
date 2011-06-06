<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'forgot_password'))); ?>
		
			<div class="form-title">Forgot Password</div>
			<div class="form-holder form-login">
				<p>Please enter your email address to reset to a new password</p>
				<?php
				echo $this->Form->input('User.username', array('label' => 'Email', 'class' => 'required email'));
				?>
				<input type="submit" class="button-submit" value="">
			</div>
			
		<?php echo $this->Form->end();?>
	</div>
</div>

<?php $html->scriptBlock("forgot_password_form();", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>
