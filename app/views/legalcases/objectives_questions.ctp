<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('Legalcase');?>
		
		<?php
		echo $this->Form->input('Legalcasedetail.id', array('type' => 'hidden'));
		echo $this->Form->input('Legalcasedetail.case_id', array('type' => 'hidden', 'value' => $case_id));
		echo $this->Form->input('Legalcasedetail.user_id', array('type' => 'hidden', 'value' => $id));
		?>
		
		<div class="form-title">My Objectives/Mga Gusto Ko:</div>
		<div class="form-holder">
			<?php
			echo $this->Form->textarea('Legalcasedetail.objectives', array('label' => false, 'class' => 'required'));
			?>
			<div>
				<em>*You can prepare your summary of facts from Microsoft Word then copy and paste to this textarea</em>
			</div>
		</div>
		
		<div class="form-title">My Questions/Ang (mga) Tanong Ko:</div>
		<div class="form-holder">
		<?php
		echo $this->Form->textarea('Legalcasedetail.questions', array('label' => false, 'class' => 'required'));
		?>
			<div>
				<em>*You can prepare your summary of facts from Microsoft Word then copy and paste to this textarea</em>
			</div>
		</div>	
		
		<?php echo $this->Form->input('goto', array('type' => 'hidden', 'id' => 'goto'));?>
		</form>

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
	jQuery("#LegalcaseObjectivesQuestionsForm").validate({
	});

	jQuery('#back').click(function() {
		jQuery('#goto').val('summary_of_facts');
		
		if (jQuery('#LegalcasedetailObjectives').val() == '' || jQuery('#LegalcasedetailQuestions').val() == '') {
			
			var agree=confirm("Data you provided on this form will be discared. Do you want to continue?");
	        if (agree){                        
	           window.location = '/legalcases/summary_of_facts/<?php echo $id ?>/<?php echo $case_id ?>/<?php echo $case_detail_id ?>';
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
		jQuery('#goto').val('summary_of_information');
		jQuery('form').submit();
	});

});

</script>