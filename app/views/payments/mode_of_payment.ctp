<div id="reject-alert" class="hidden" title="Please select payment option">
	<p style="padding-top:20px; text-align:center;">
	Please select payment option.
	</p>
</div>

<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('Payment');?>		
		
		<div class="form-title">Mode of Payment</div>
		<div class="form-holder">
			<?php
			echo $this->Form->input('Payment.user_id', array('type' => 'hidden', 'value' => $id));	
			echo $this->Form->input('Payment.case_id', array('type' => 'hidden', 'value' => $case_id));	
			echo $this->Form->input('Payment.case_detail_id', array('type' => 'hidden', 'value' => $case_detail_id));
			?>
			
			<?php
			//$options=array('Paypal'=>'Paypal','GCash'=>'GCash','Smart Money'=>'Smart Money', 'Bank Transfer' => 'Bank Transfer');
			//echo $this->Form->input('Payment.option', array('type' => 'radio', 'options'=>$options, 'legend' => 'Please select payment option', 'class' => 'payment-options'));	
			?>
			
			<div style="text-align:center">
				<div style="font-weight:bold">Please select your preferred payment option below:</div>
				<div>
					<input type="radio" class="option_radio" value="bank_deposit" name="data[Payment][option]" >Bank Deposit
					<input type="radio" class="option_radio" value="credit_card" name="data[Payment][option]">Credit Card
					<input type="radio" class="option_radio" value="paypal" name="data[Payment][option]">Paypal
					<input type="radio" class="option_radio" value="gcash" name="data[Payment][option]">G-Cash
					<input type="radio" class="option_radio" value="smartmoney" name="data[Payment][option]">SmartMoney
				</div>
			</div>
			<div style="display:block;padding-left:300px;">
				<label for="data[Payment][option]" class="error" style="display:none">Please select mode of payment</label> 
			</div>
			
			<br />
		</div>
		
		<br />
		
		<?php echo $this->Form->end(__('Next', true));?>
		
	</div>
</div>

<script type="text/javascript">
jQuery('document').ready(function() {

	//Assign radio value
	jQuery('.option_radio').filter('[value=<?php echo $this->data['Payment']['option'] ;?>]').attr('checked', true);

	jQuery("#PaymentModeOfPaymentForm").validate({
		rules: {
			"data[Payment][option]" : {
				required: true
			}
		}
	});
});


</script>