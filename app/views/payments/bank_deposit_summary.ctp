<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->Session->flash(); ?>
		
		<?php
		// debug($User);
		?>
		
		<div class="form-title">Bank Deposit Summary</div>
		<div class="form-holder">
			<?php echo $this->Form->create('Payment');?>
			<table class="summary-info">
				<tr>
					<td class="label">Bank:</td>
					<td><?php echo $Payment['Payment']['bank_name'];?></td>
				</tr>
				<tr>
					<td class="label">Date Deposited:</td>
					<td><?php echo $Payment['Payment']['bank_date_deposited'];?></td>
				</tr>
				<tr>
					<td class="label">Date Deposited:</td>
					<td><?php echo $Payment['Payment']['bank_branch'];?></td>
				</tr>
				<tr>
					<td class="label">Country:</td>
					<td><?php echo $Payment['Payment']['bank_country'];?></td>
				</tr>
				<tr>
					<td class="label">Amount:</td>
					<td><?php echo $Payment['Payment']['amount'];?></td>
				</tr>
				<tr>
					<td class="label">Reference No.:</td>
					<td><?php echo $Payment['Payment']['reference_no'];?></td>
				</tr>
				<tr>
					<td class="label">File Attachments:</td>
					<td class="actions">
				    	<?php
						foreach ($files as $key => $value) {
							echo '<a href="' . $upload_folder . '/' . $value . '" target="_blank">' . $value . '</a><br />';
						}
						?>    					
					</td>
				</tr>
			</table>
			</form>				
		</div>
		
		<br />
		<table>
			<tr>
				<td>
					<input type="button" id="back" value="Back" />
				</td>
				<td>
					<input type="button" id="next" value="Submit Payment" />
				</td>
			</tr>
		</table>
	</div>
</div>

<script type="text/javascript">
jQuery('document').ready(function() {

	//jQuery Valdidate
	jQuery("#LegalcaseSummaryOfFactsForm").validate({});

	jQuery('#back').click(function() {
		window.location = '/payments/bank_deposit/<?php echo $id ?>/<?php echo $case_id ?>/<?php echo $case_detail_id ?>/<?php echo $payment_id ?>';
	});

	jQuery('#next').click(function() {
		window.location = '/payments/payment_confirmation/<?php echo $id ?>/<?php echo $case_id ?>/<?php echo $case_detail_id ?>/<?php echo $payment_id ?>/bank_deposit';
	});

});

</script>