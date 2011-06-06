<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />

<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
		
		<?php echo $this->Session->flash(); ?>

			<div class="form-title">Bank Deposit</div>
			<div class="form-holder form-registration">
			    
			<p>
		        <em>Notes: Choosing this payment option assumes that you have deposited the necessary fees through your preferred bank as discussed in the payment instructions. Otherwise, please make your deposit first before proceeding, or choose another payment option.</em>
			</p>
			
			<p>
			    You have chosen to pay through Bank Deposit, please fill-out ALL the fields below:
			</p>
			
			<?php echo $this->Form->create('Payment');?>
			<?php
				echo $this->Form->input('Payment.id');
				echo $this->Form->input('Payment.user_id', array('type' => 'hidden', 'value' => $id));
				echo $this->Form->input('Payment.case_id', array('type' => 'hidden','value' => $case_id));
				echo $this->Form->input('Payment.case_detail_id', array('type' => 'hidden','value' => $case_detail_id));
				echo $this->Form->input('Payment.option', array('type' => 'hidden','value' => 'Bank Deposit'));

				$options=array('Allied Bank'=>'Allied Bank','Banco De Oro'=>'Banco De Oro','BPI Family Savings Bank'=>'BPI Family Savings Bank','Metrobank'=>'Metrobank');
				echo $this->Form->input('Payment.bank_name', array('type' => 'select', 'options'=>$options, 'label' => 'Choose Bank', 'empty' => 'Select', 'class' => 'required'));
				echo $this->Form->input('Payment.bank_date_deposited', array('type' => 'text', 'class' => 'required birth_date', 'label' => 'Date Deposited'));
				echo $this->Form->input('Payment.bank_branch', array('class' => 'required'));
				echo $this->Form->input('Payment.bank_country', array('class' => 'required', 'label' => 'Country'));
				echo $this->Form->input('Payment.amount', array('class' => 'required decimal'));
				echo $this->Form->input('Payment.reference_no', array('class' => 'required'));
			?>
			<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>

				<div>
					<b>Attach Document/s:</b>&nbsp;
					<br /><br />
					<input id="file_upload" name="file_upload" type="file" />

					<ul id="file-list">
						<?php
						foreach ($files as $key => $value) {
							echo '<li class="actions"><a href="' . $upload_folder . '/' . $value . '" target="_blank">' . $value . '</a>' . ' <a class="remove_file" id="' . $upload_folder . '/' . $value . '">Remove</a></li>';
						}
						?>
					</ul>
				</div>
				
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

<?php echo $html->script('/uploadify/swfobject.js', array('inline'=>false));?>
<?php echo $html->script('/uploadify/jquery.uploadify.v2.1.4.min.js', array('inline'=>false));?>
<?php $html->scriptBlock("bank_deposit_form('$id', '$case_id', '$case_detail_id', '$upload_folder');", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>
