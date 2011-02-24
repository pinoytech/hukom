<div id="full-content">
	<div id="main">
		
		<?php echo $this->Session->flash(); ?>

			<div class="form-title">Bank Deposit</div>
			<div class="form-holder form-registration">
			<?php echo $this->Form->create('Payment');?>
			<?php
				echo $this->Form->input('Bankdeposit.id');
				echo $this->Form->input('Bankdeposit.user_id', array('type' => 'hidden', 'value' => $id));
				echo $this->Form->input('Bankdeposit.case_id', array('type' => 'hidden','value' => $case_id));
				echo $this->Form->input('Bankdeposit.case_detail_id', array('type' => 'hidden','value' => $case_detail_id));
				
				$options=array('Allied Bank'=>'Allied Bank','Banco De Oro'=>'Banco De Oro','BPI Family Savings Bank'=>'BPI Family Savings Bank','Metrobank'=>'Metrobank');
				echo $this->Form->input('Bankdeposit.bank', array('type' => 'select', 'options'=>$options, 'label' => 'Choose Bank', 'empty' => 'Select', 'class' => 'required'));
				echo $this->Form->input('Bankdeposit.date_deposited', array('type' => 'text', 'class' => 'required birth_date'));
				echo $this->Form->input('Bankdeposit.branch', array('class' => 'required'));
				echo $this->Form->input('Bankdeposit.country', array('class' => 'required'));
				echo $this->Form->input('Bankdeposit.amount', array('class' => 'required decimal'));
				echo $this->Form->input('Bankdeposit.reference_no', array('class' => 'required'));
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
	jQuery("#PaymentBankDepositForm").validate();
	
	jQuery('#back').click(function() {
		jQuery('#goto').val('mode_of_payment');
		
		if (jQuery('#BankdepositId').val() == '') {
			
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
		jQuery('#goto').val('bank_deposit_summary');
		jQuery('form').submit();
	});
});
</script>

<?php echo $html->script('form-hacks');?>
