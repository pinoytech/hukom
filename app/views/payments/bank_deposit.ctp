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

<script type="text/javascript" src="/uploadify/swfobject.js"></script>
<script type="text/javascript" src="/uploadify/jquery.uploadify.v2.1.4.min.js"></script>

<script type="text/javascript">
jQuery('document').ready(function() {
	//jQuery Valdidate
	jQuery("#PaymentBankDepositForm").validate();
	
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
		jQuery('#goto').val('bank_deposit_summary');
		jQuery('form').submit();
	});
	
	jQuery('#file_upload').uploadify({
	    'uploader'  : '/uploadify/uploadify.swf',
	    'script'    : '/uploadify/uploadify.php',
	    'cancelImg' : '/uploadify/cancel.png',
	    'folder'    : '<?php echo $upload_folder;?>',
		'buttonImg' : '/img/selectButton_up.png',
		'wmode'     : 'transparent',
	    'auto'      : true,
	    'fileExt'   : '*.jpg;*.gif;*.png;*.doc;*.docx;*.pdf',
	    'fileDesc'  : 'Image Files (JPG, GIF, PNG); Document Files (PDF, Word Doc)',
	    'sizeLimit' : 2097152,
		'onComplete' : function(event, ID, fileObj, response, data) {
				append_files(fileObj)
		    }
	  });
	
	function append_files(fileObj) {
		name = fileObj.name;
		jQuery('#file-list').append('<li class="actions">'+name+' <a class="remove_file" id="'+fileObj.filePath+'" >Remove</a></li>');
	}
	
	jQuery('.remove_file').live('click', function(e) {
		var parent = jQuery(this).parent();

		jQuery.ajax({
			type: "POST", 
			url: "/legalcases/remove_file",
			data: 'file_path=' + jQuery(this).attr('id'),
			success: function(msg)
			{
				parent.empty().fadeOut();
			},
			error: function()
			{
				alert("An error occured while updating. Try again in a while");
			}
		 });
	});
});
</script>

<?php echo $html->script('form-hacks');?>
