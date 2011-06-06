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
					<td class="label">Bank Branch:</td>
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

<?php $html->scriptBlock("bank_deposit_summary('$id', '$case_id', '$case_detail_id', '$payment_id');", array('inline'=>false));?>