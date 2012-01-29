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
				
				<?php echo eval('?>' . SiteCopy::body('online_legal_consultation_agreement') . '<?php '); ?>
				
				<p style="text-align:center;">
					I hereby <input type="checkbox" id="accept" value="accept" class="terms" style="float:none;"> ACCEPT <input type="checkbox" id="reject" class="terms" value="reject" style="float:none;"> REJECT the above said terms and conditions.
					<br />
					<br />
					<input type="button" value="" id="check_end_user" class="button-submit" >
				</p>

			</div>

	</div>
</div>

<?php $html->scriptBlock("online_legal_consulation_agreement_form('$id', '$case_id', '$case_detail_id');", array('inline'=>false));?>