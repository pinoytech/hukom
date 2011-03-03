<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
						
		<?php echo $this->Session->flash(); ?>
		
		<div class="form-title">Summary Of Facts</div>
		<div class="form-holder">
		
			<?php echo $this->Form->create('Legalcase');?>
			<?php
				echo $this->Form->input('Legalcasedetail.id', array('type' => 'hidden'));
				echo $this->Form->input('Legalcasedetail.case_id', array('type' => 'hidden', 'value' => $case_id));
				echo $this->Form->input('Legalcasedetail.user_id', array('type' => 'hidden', 'value' => $id));
				echo $this->Form->input('Legalcasedetail.legal_service', array('type' => 'hidden', 'value' => $legal_service));
			?>
				<div>
					<p>
						Describe/Narrate from past to present the clear, complete and specific details/facts of your legal problem by answering the questions of WHO? WHY? WHEN? WHERE? WHAT? AND HOW? If you want to refer to any document, picture or video, you can scan and attach it in this form.
					</p>
					
					<p>
						Ikuwento nang malinaw, kumpleto at detalyadong pangyayari ng iyong problemang legal mula simula hanggang sa kasalukuyan sa pamamagitan ng pagsagot sa mga katanungang Sino? Bakit? Kailan? Saan? Ano? At Paano? Kung meron ka na papel, dokumento, larawan o video na kasama sa iyong katanungan, kopyahin at isama ito sa aplikasyon na ito.
					</p>
				</div>
			<?php echo $this->Form->textarea('Legalcasedetail.summary', array('label' => false, 'class' => 'required')); ?>
				
				<div>
					<em>*You can prepare your summary of facts from Microsoft Word then copy and paste to this textarea</em>
				</div>
				<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
			</form>
			
			<div>
				Attach Document/s:
			</div>
			
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
	jQuery("#LegalcaseSummaryOfFactsForm").validate({
	});

	jQuery('#back').click(function() {
		jQuery('#goto').val('legal_problem');
		
		if (jQuery('#LegalcasedetailSummary').val() == '') {
			
			var agree=confirm("Data you provided on this form will be discared. Do you want to continue?");
	        if (agree){                        
	           window.location = '/legalcases/legal_problem/<?php echo $id ?>/<?php echo $case_id ?>';
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
		jQuery('#goto').val('objectives_questions');
		jQuery('form').submit();
	});

});

</script>
