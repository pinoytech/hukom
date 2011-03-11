<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />

<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->Session->flash(); ?>

			<div class="form-title">Globe GCash</div>
			<div class="form-holder form-registration">
			    
			<p>You have chosen to pay through <b>Globe GCash</b>.</p>
			
			<p>Your <b>professional fee</b> is Php <?php echo $fee;?>, please send your payment to this <b>Globe Cellphone number +639279845404</b> and please chose type of GCash payment and fill out the fields below.</p>
			    
			<?php echo $this->Form->create('Payment');?>
			<?php
				echo $this->Form->input('Payment.id');
				echo $this->Form->input('Payment.user_id', array('type' => 'hidden', 'value' => $id));
				echo $this->Form->input('Payment.case_id', array('type' => 'hidden','value' => $case_id));
				echo $this->Form->input('Payment.case_detail_id', array('type' => 'hidden','value' => $case_detail_id));
				echo $this->Form->input('Payment.option', array('type' => 'hidden','value' => 'GCash'));
				
				$options=array('GCash Mobile'=>'GCash Mobile','GCash Online'=>'GCash Online','GCash Remit'=>'GCash Remit');
				echo $this->Form->input('Payment.gcash_type', array('type' => 'select', 'options'=>$options, 'label' => 'Choose Type of GCash', 'empty' => 'Select', 'class' => 'required'));
				echo $this->Form->input('Payment.cellphone_no', array('class' => 'required'));
				echo $this->Form->input('Payment.reference_no', array('class' => 'required'));
				echo $this->Form->input('Payment.amount', array('class' => 'required'));
			?>	
			<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
			
			</form>
			</div>
			
			<br />
			<table>
				<tr>
					<td>
						<input type="button" id="back" value="Back" />
					</td>
					<td>
						<input type="button" id="next" value="Next" />
					</td>
				</tr>
			</table>
	</div>
</div>

<script type="text/javascript">
jQuery('document').ready(function() {
	//jQuery Valdidate
	jQuery("#PaymentGcashForm").validate();
	
	jQuery('#back').click(function() {
		jQuery('#goto').val('mode_of_payment');
		
		if (jQuery('#PaymentId').val() == '') {
			
			var agree=confirm("Data you provided on this form will be discarded. Do you want to continue?");
	        if (agree){                        
	           window.location = '/payments/mode_of_payment/<?php echo $id ?>/<?php echo $case_id ?>/<?php echo $case_detail_id; ?>';
	        }
	        else{
	           return false;
	        }
		}
		else{
			jQuery('form').submit();
		}
	});

	jQuery('#next').click(function() {
		jQuery('#goto').val('payment_confirmation');
		jQuery('form').submit();
	});
	
});
</script>

<?php echo $html->script('form-hacks');?>