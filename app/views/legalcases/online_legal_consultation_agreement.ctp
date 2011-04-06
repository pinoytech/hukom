<div id="reject-alert" class="hidden" title="Online Legal Consultation Agreement">
	<p style="padding-top:20px; text-align:center;">
	You must agree to continue.
	</p>
</div>

<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
			<div class="form-title">Online Legal Consultation Agreement</div>
			<div class="form-holder">
				<?php
					echo $this->Form->input('Legalcase.id');
					echo $this->Form->input('Legalcase.user_id', array('type' => 'hidden', 'value' => $id));
					
				?>
				
				<p>
					I, <?php echo $user_full_name;?>, of legal age, freely and voluntarily provided information to E-LAWYERS ONLINE with the intention to obtain legal advice for me or for the company/partnership I duly represents. I agree that:
				</p>
				
				<ol>
					<li>I will pay the amount of Php <?php echo $fee;?> as professional fee. This fee for online legal consultation service shall cover only the subject matter discussed herein and to no other.</li>
					<li>I understand that the result of this consultation is for internal, personal and non-commercial purpose and I shall use the same not for any other purpose.</li>
					<li>Any and all information that will be given by me shall be treated as private and strictly confidential. I certify that all information given is true and correct and/or based on authentic documents.</li>
					<li>I expressly acknowledge that the legal advise obtained herein does not assure success of litigation as the same is based on the evidence presented and as appreciated by the courts of law;</li>
					<li>Legal advice given will be based on the facts narrated and documents sent by client and E-Lawyers Online reserves the right to defer legal advice if the facts/docs are incomplete. Failure to provide additional information/documents, initial legal advice shall be considered as final legal advice without right of reimbursement or refund of fees.</li>
					<li>E-Lawyers Online reserves the right to refuse to give legal advise by reason of conflict of interest or due to ethical professional consideration. In such a case, the fee shall be refunded to me;</li>
					<li>Legal advice shall be given via email upon confirmation of payment of prescribed fees. Legal fees inclusive of taxes;</li>
					<li>Legal advice shall not include preparation of contracts, pleadings, petitions, complaint or any papers and/or liaison work and/or court appearance and/or filing fees unless agreed otherwise in a separate retainer agreement and required additional fees has been paid and confirmed.</li>
					<li>Client shall fully cooperate with lawyer by providing needed information and documents.</li>
					<li>I agree that E-Lawyers Online shall have the right to first assess the scope of services based on the facts and documents submitted by me and to determine if the same is commensurate to the fees paid by me. E-Lawyers Online shall have the right to refund my fee in the event of disagreement of the parties upon determination that the fee is not proportionate to the legal services requested.</li>
					<li>The legal fee is for the full payment for the online consultation for the subject matter of my query/ies and any question/s I did not ask/provide in this website upon submission of this form shall be considered waived and forfeited. Follow-up questions or queries on other subject matter not covered by the fee may be entertained at the option of E-Lawyers Online on a discounted basis.</li>
				</ol>

				<p style="text-align:center;">
					I hereby <input type="checkbox" id="accept" value="accept" class="terms" style="float:none;"> ACCEPT <input type="checkbox" id="reject" class="terms" value="reject" style="float:none;"> REJECT the above said terms and conditions.
					<br />
					<br />
					<input type="button" value="Submit" id="check_end_user" style="width:100px">
				</p>

			</div>

	</div>
</div>
<script type="text/javascript">
jQuery('document').ready(function() {
	//jQuery('#UserRegisterForm').	

	jQuery("#reject-alert").dialog({
		autoOpen: false,
		width: 400,
		height: 200,
        modal: true,
		resizable: false,
        buttons: {
            Ok: function() {
            	jQuery(this).dialog('close');
			}
        }
	});
	
	jQuery('#check_end_user').click(function() {
		if(jQuery('#accept').is(":checked")){
			window.location = "/payments/mode_of_payment/<?php echo $id;?>/<?php echo $case_id;?>/<?php echo $case_detail_id;?>";
			return false;
		}
		
		if(jQuery('#reject').is(":checked")){
			jQuery("#reject-alert").dialog("open");
		}
		
		if(jQuery('.terms:not(:checked)')){
			jQuery("#reject-alert").dialog("open");
		}
		
	});
	
	jQuery('#accept').click(function() {
		if(jQuery('#accept').is(":checked")){
			jQuery('#reject').attr('checked', false);
		}
	});
	
	jQuery('#reject').click(function() {
		if(jQuery('#reject').is(":checked")){
			jQuery('#accept').attr('checked', false);
		}
	});
});


</script>