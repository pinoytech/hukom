<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
					
			<div class="form-title">My Legal Problem is - Ang Problema kong Legal ay:</div>
			<div class="form-holder">
			    
			    <p>
			        (Choose your legal problem - Pumili kung ano ang iyong problemang legal)
			    </p>
			    
				<?php echo $this->Form->create('Legalcase');?>
				<?php
					echo $this->Form->input('Legalcase.id');
					echo $this->Form->input('Legalcase.user_id', array('type' => 'hidden', 'value' => $id));
					echo $this->Form->input('Legalcase.status', array('type' => 'hidden', 'value' => 'active'));
					echo $this->Form->input('Legalcase.case_detail_id', array('type' => 'hidden', 'value' => $case_detail_id));
					
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
					
					<input type="radio" class="legal_problem_radio" value="Personal" id="LegalcaseLegalProblemPersonal" name="data[Legalcase][legal_problem]"><span class="label">Personal</span> - I have problem in my birth certificate, my passport, my criminal case, etc.
					<br />
					<input type="radio" class="legal_problem_radio" value="Family" id="LegalcaseLegalProblemFamily" name="data[Legalcase][legal_problem]"><span class="label">Family</span> - I have a problem in annulment, child custody, adoption, etc.
					<br />
					<input type="radio" class="legal_problem_radio" value="Property" id="LegalcaseLegalProblemProperty" name="data[Legalcase][legal_problem]"><span class="label">Property</span> - I have a problem with my land title, car, stocks, etc.
					<br />
					<input type="radio" class="legal_problem_radio" value="Contractual" id="LegalcaseLegalProblemContractual" name="data[Legalcase][legal_problem]"><span class="label">Contractual</span> - I have a problem with my contract, sub-contract, etc. 
					<br />
					<input type="radio" class="legal_problem_radio" value="Business" id="LegalcaseLegalProblemBusiness" name="data[Legalcase][legal_problem]"><span class="label">Business</span> - I have a problem in my business.
					<br />
						<div id="my_business_is">
							My Business is:
							<br />
							<input type="radio" class="legal_problem_radio" value="Single Proprietorship" name="data[Legalcase][legal_problem]"><span class="label">Single Proprietorship</span>
							<br />
							<input type="radio" class="legal_problem_radio" value="Corporation Partnership" name="data[Legalcase][legal_problem]"><span class="label">Corporation Partnership</span> - SEC, DTI, BIR, etc.
							<br />
							<input type="radio" class="legal_problem_radio" value="Unregistered Business, Joint Venture, Consortium etc" name="data[Legalcase][legal_problem]"><span class="label">Unregistered Business, Joint Venture, Consortium, etc.</span>
							<br />
							<input type="radio" class="legal_problem_radio" value="Others" name="data[Legalcase][legal_problem]"><span class="label">Others</span>
							<br />
						</div>
					<input type="radio" class="legal_problem_radio" value="Work" id="LegalcaseLegalProblemWork" name="data[Legalcase][legal_problem]"><span class="label">Work</span> - I have a problem in my work, dismissal, SSS, Pag-Ibig, OWWA, etc.
					<br />
					<input type="radio" class="legal_problem_radio" value="Legal Documents" id="LegalcaseLegalProblemLegalDocuments" name="data[Legalcase][legal_problem]"><span class="label">Legal Documents</span> - I need an affidavit, SPA, deed of sale, contract, etc.
					<br />
					<input type="radio" class="legal_problem_radio" value="Special Projects/Contracts" id="LegalcaseLegalProblemSpecialProjectsContracts" name="data[Legalcase][legal_problem]"><span class="label">Special Projects/Contracts</span> - I need a lawyer for a big transaction.
					<br />
					<input type="radio" class="legal_problem_radio" value="Anything under the sun" id="LegalcaseLegalProblemAnythingUnderTheSun" name="data[Legalcase][legal_problem]"><span class="label">Anything under the sun (Other Legal Services)</span> - I need a legal advice before I act.
					<div id="anything_under">
						<input type="text" name="data[Legalcase][legal_problem]" disabled>
					</div>
				</div>
				<div style="display:block;padding-left:300px;">
					<label for="data[Legalcase][legal_problem]" class="error" style="display:none">Please select legal problem</label> 
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
	    <?php
        if ($auth_user_type == 'personal') {
            $profile_action = 'personal_info';
        }
        elseif ($auth_user_type == 'corporation') {
            $profile_action = 'corporate_partnership_representative_info';
        }
        ?>
        
		window.location = '/users/<?php echo $profile_action; ?>/<?php echo $id;?>/<?php echo $case_id;?>/<?php echo $case_detail_id;?>';
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