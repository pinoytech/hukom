<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />

<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->Session->flash(); ?>

		<div class="form-title">SmartMoney</div>
		<div class="form-holder form-registration">
		    <p>
			    You have chosen to pay through <b>Smart Money</b>
			    <?php
			    if ($this->Session->read('Legalcase.legal_service') != 'Monthly Retainer' && $this->Session->read('Legalcase.legal_service') != 'Case/Project Retainer') {
			    ?>
			    , your professional fee is <b>Php <?php echo $fee; ?></b>.
			    <?php
		        }
			    ?>
            </p>
		
			<p>
			    Select the type of Smart Money payment and send your payment to this Smart Money cellphone number <b>(+639498443880)</b> and fill out the form below.
			</p>
		    
			<?php echo $this->Form->create('Payment');?>
			<?php
				echo $this->Form->input('Payment.id');
				echo $this->Form->input('Payment.user_id', array('type' => 'hidden', 'value' => $id));
				echo $this->Form->input('Payment.case_id', array('type' => 'hidden','value' => $case_id));
				echo $this->Form->input('Payment.case_detail_id', array('type' => 'hidden','value' => $case_detail_id));
				echo $this->Form->input('Payment.option', array('type' => 'hidden','value' => 'SmartMoney'));
			
				$options=array('Over-the-Counter' => 'Over-the-Counter','Wallet-to-Wallet' => 'Wallet-to-Wallet','Mobile Banking Service' => 'Mobile Banking Service','Smart Padala' => 'Smart Padala');
				echo $this->Form->input('Payment.smartmoney_type', array('type' => 'select', 'options'=>$options, 'label' => 'Choose Type of SmartMoney', 'empty' => 'Select', 'class' => 'required'));
				echo $this->Form->input('Payment.cellphone_no', array('class' => 'required digits'));
				echo $this->Form->input('Payment.reference_no', array('class' => 'required'));
				echo $this->Form->input('Payment.amount', array('class' => 'required'));
			?>	
			<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
		    
		    <br />
			<table>
				<tr>
					<td>
						<input type="button" id="back" class="button-back" value="" />
					</td>
					<td>
						<input type="button" id="next" class="button-next" value="" />
					</td>
				</tr>
			</table>
			
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery('document').ready(function() {
	//jQuery Valdidate
	jQuery("#PaymentSmartmoneyForm").validate();
	
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