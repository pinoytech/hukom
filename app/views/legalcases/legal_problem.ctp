<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
					
			<div class="form-title">My Legal Problem is - Ang Problemeng Legal Ko Ay</div>
			<div class="form-holder">
				<?php echo $this->Form->create('Legalcase');?>
				<?php
					echo $this->Form->input('Legalcase.id');
					echo $this->Form->input('Legalcase.user_id', array('type' => 'hidden', 'value' => $id));
					
					/*
					$options = array(
							'Personal' => 'Personal',
							'Family' => 'Family',
							'Property' => 'Property',
							'Contractual' => 'Contractual',
							'Business' => 'Business',
							'Work' => 'Work',
							'Legal Documents' => 'Legal Documents',
							'Special Projects/Contracts' => 'Special Projects/Contracts',
							'Anything under the sun' => 'Anything under the sun (Other Legal Services)',
						);	
					*/
						
					//echo $this->Form->input('Legalcase.legal_problem', array('type' => 'radio', 'options'=>$options, 'class' => 'remove-asterisk', 'legend' => false, ));
				?>
				
				<div class="input radio">
					
					<input type="radio" class="legal_problem_radio" value="Personal" id="LegalcaseLegalProblemPersonal" name="data[Legalcase][legal_problem]">Personal
					<br />
					<input type="radio" class="legal_problem_radio" value="Family" id="LegalcaseLegalProblemFamily" name="data[Legalcase][legal_problem]">Family
					<br />
					<input type="radio" class="legal_problem_radio" value="Property" id="LegalcaseLegalProblemProperty" name="data[Legalcase][legal_problem]">Property
					<br />
					<input type="radio" class="legal_problem_radio" value="Contractual" id="LegalcaseLegalProblemContractual" name="data[Legalcase][legal_problem]">Contractual
					<br />
					<input type="radio" class="legal_problem_radio" value="Business" id="LegalcaseLegalProblemBusiness" name="data[Legalcase][legal_problem]">Business
					<br />
						<div id="my_business_is">
							My Business is:
							<br />
							<input type="radio" class="legal_problem_radio" value="Single Proprietorship" name="data[Legalcase][legal_problem]">Single Proprietorship
							<br />
							<input type="radio" class="legal_problem_radio" value="Corporation Partnership" name="data[Legalcase][legal_problem]">Corporation Partnership
							<br />
							<input type="radio" class="legal_problem_radio" value="Unregistered Business, Joint Venture, Consortium etc" name="data[Legalcase][legal_problem]">Unregistered Business, Joint Venture, Consortium etc.
							<br />
							<input type="radio" class="legal_problem_radio" value="Others" name="data[Legalcase][legal_problem]">Others
							<br />
						</div>
					<input type="radio" class="legal_problem_radio" value="Work" id="LegalcaseLegalProblemWork" name="data[Legalcase][legal_problem]">Work
					<br />
					<input type="radio" class="legal_problem_radio" value="Legal Documents" id="LegalcaseLegalProblemLegalDocuments" name="data[Legalcase][legal_problem]">Legal Documents
					<br />
					<input type="radio" class="legal_problem_radio" value="Special Projects/Contracts" id="LegalcaseLegalProblemSpecialProjectsContracts" name="data[Legalcase][legal_problem]">Special Projects/Contracts
					<br />
					<input type="radio" class="legal_problem_radio" value="Anything under the sun" id="LegalcaseLegalProblemAnythingUnderTheSun" name="data[Legalcase][legal_problem]">Anything under the sun (Other Legal Services)
					<div id="anything_under">
						<input type="text" name="data[Legalcase][legal_problem]" disabled>
					</div>
				</div>
				<div style="display:block;padding-left:300px;">
					<label for="data[Legalcase][legal_problem]" class="error" style="display:none">Please select legal problem</label> 
				</div>
				<br />
			</div>
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

<?php echo $html->script('form-hacks');?>

<script type="text/javascript">
jQuery('document').ready(function() {

	//Assign radio value
	jQuery('.legal_problem_radio').filter('[value=<?php echo $this->data['Legalcase']['legal_problem'] ;?>]').attr('checked', true);

	jQuery("#LegalcaseLegalProblemForm").validate({
		rules: {
			"data[Legalcase][legal_problem]" : {
				required: true
			}
		},
		submitHandler: function(form) {
			
			if (jQuery('.legal_problem_radio:checked').val() == 'Business'){
				
				if (! jQuery('#my_business_is input').is(":checked")){
					alert('Please select business type');
					return false;
				}
					
			}
			
			if (jQuery('.legal_problem_radio:checked').val() == 'Anything under the sun'){
				
				if (jQuery('#anything_under').children('input').val() == ''){
					alert('Please input data on Other Legal Services field');
					return false;
				}

			}
			
			form.submit();
		}
	});
	
	//Submit button logic
	jQuery('#back').click(function() {
		window.location = '/users/children_info/<?php echo $id;?>/<?php echo $case_id;?>';
	});

	jQuery('#next').click(function() {
		jQuery('form').submit();
	});
	
	jQuery('.legal_problem_radio').click(function() {
		if (jQuery(this + ':checked')){
			if (jQuery(this).val() == 'Anything under the sun'){
				jQuery('#anything_under').show();
				jQuery('#anything_under').children('input').attr('disabled', false);
			}
			else {
				jQuery('#anything_under').children('input').val('');
				jQuery('#anything_under').children('input').attr('disabled', true);				
			}
			
			if (jQuery(this).val() == 'Business'){
				jQuery('#my_business_is').show();
			}
		}		
	});
	
});
</script>