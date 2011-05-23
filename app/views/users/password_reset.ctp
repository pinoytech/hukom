<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'password_reset')));?>
		    <div class="form-title">Reset Password</div>
    		<div class="form-holder form-registration">
        		<?php
        		echo $this->Form->input('User.id');
        		echo $this->Form->input('User.username', array('type' => 'hidden'));
        		echo $this->Form->input('User.password', array('label' => 'New Password', 'value' => '', 'class' => 'required'));
        		echo $this->Form->input('User.password_confirm', array('label' => 'Retype New Password', 'type' => 'password', 'value' => '', 'class' => 'required'));
                // echo $this->Form->end('Submit');
        		?>
        		<input type="submit" class="button-submit" value="">
    		</div>
	    <?php echo $this->Form->end();?>
	</div>
</div>

<script type="text/javascript">
jQuery('document').ready(function() {
    
    jQuery("#UserPasswordResetForm").validate({
        rules: {
			"data[User][password_confirm]": {
				equalTo: '#UserPassword'
			},
		}
	});
	
});
</script>