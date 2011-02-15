<script type="text/javascript">
jQuery('document').ready(function() {
	//jQuery('#UserRegisterForm').	

	
});

function check_end_user() {
	jQuery("#reject-alert").dialog({
		autoOpen: false,
		width: 300,
		height: 200,
        modal: true,
		resizable: false,
        buttons: {
            Ok: function() {
            	jQuery(this).dialog('close');
			}
        }
	});
	
	if(jQuery('.payment-options').is(':checked')){
		form.submit();
	}
	else {
		jQuery("#reject-alert").dialog("open");
	}
	
}

</script>

<div id="reject-alert" class="hidden" title="Please select payment option">
	<p style="padding-top:20px; text-align:center;">
	Please select payment option.
	</p>
</div>

<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('Payment', array('onsubmit' => 'check_end_user(); return false;', 'name' => 'UserSelectOptionForm'));?>
		
			<fieldset>
		 		<legend><?php __('Payment Options'); ?></legend>
				
				<?php
					echo $this->Form->input('Payment.id');
					echo $this->Form->input('Payment.user_id', array('type' => 'hidden', 'value' => $user_id));	
					echo $this->Form->input('Payment.case_id', array('type' => 'hidden', 'value' => $case_id));	
				?>
				
				<?php
				$options=array('Paypal'=>'Paypal','GCash'=>'GCash','Smart Money'=>'Smart Money', 'Bank Transfer' => 'Bank Transfer');
				echo $this->Form->input('Payment.option', array('type' => 'radio', 'options'=>$options, 'legend' => 'Please select payment option', 'class' => 'payment-options'));
				
				?>
				
			</fieldset>
		
		<?php echo $this->Form->end(__('Next', true));?>
	</div>
</div>