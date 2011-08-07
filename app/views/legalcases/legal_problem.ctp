<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
					
			<div class="form-title"><?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Legal Problem is - Ang Problema <?php echo ($auth_user_type == 'personal') ? 'kong' : 'naming'; ?> Legal ay:</div>
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
					<?php
					if ($auth_user_type == 'personal') {
					?>
					<input type="radio" class="legal_problem_radio" value="Personal" id="LegalcaseLegalProblemPersonal" name="data[Legalcase][legal_problem]"><span class="label">Personal</span> - I have problem in <?php echo ($auth_user_type == 'personal') ? 'my' : 'our'; ?> birth certificate, <?php echo ($auth_user_type == 'personal') ? 'my' : 'our'; ?> passport, <?php echo ($auth_user_type == 'personal') ? 'my' : 'our'; ?> criminal case, etc.
					<br />
					<input type="radio" class="legal_problem_radio" value="Family" id="LegalcaseLegalProblemFamily" name="data[Legalcase][legal_problem]"><span class="label">Family</span> - I have a problem in annulment, child custody, adoption, etc.
					<br />
					<?php
				    }
					?>
					<input type="radio" class="legal_problem_radio" value="Property" id="LegalcaseLegalProblemProperty" name="data[Legalcase][legal_problem]"><span class="label">Property</span> - <?php echo ($auth_user_type == 'personal') ? 'I' : 'We'; ?> have a problem with <?php echo ($auth_user_type == 'personal') ? 'my' : 'our'; ?> land title, car, stocks, etc.
					<br />
					<input type="radio" class="legal_problem_radio" value="Contractual" id="LegalcaseLegalProblemContractual" name="data[Legalcase][legal_problem]"><span class="label">Contractual</span> - <?php echo ($auth_user_type == 'personal') ? 'I' : 'We'; ?> have a problem with <?php echo ($auth_user_type == 'personal') ? 'my' : 'our'; ?> contract, sub-contract, etc. 
					<br />
					<input type="radio" class="legal_problem_radio" value="Business" id="LegalcaseLegalProblemBusiness" name="data[Legalcase][legal_problem]"><span class="label">Business</span> - <?php echo ($auth_user_type == 'personal') ? 'I' : 'We'; ?> have a problem in <?php echo ($auth_user_type == 'personal') ? 'my' : 'our'; ?> business.
					<br />
						<div id="my_business_is">
							<?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Business is:
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
					<input type="radio" class="legal_problem_radio" value="Work" id="LegalcaseLegalProblemWork" name="data[Legalcase][legal_problem]"><span class="label">Work</span> - <?php echo ($auth_user_type == 'personal') ? 'I' : 'We'; ?> have a problem in <?php echo ($auth_user_type == 'personal') ? 'my' : 'our'; ?> work, dismissal, SSS, Pag-Ibig, OWWA, etc.
					<br />
					<input type="radio" class="legal_problem_radio" value="Legal Documents" id="LegalcaseLegalProblemLegalDocuments" name="data[Legalcase][legal_problem]"><span class="label">Legal Documents</span> - <?php echo ($auth_user_type == 'personal') ? 'I' : 'We'; ?> need an affidavit, SPA, deed of sale, contract, etc.
					<br />
					<input type="radio" class="legal_problem_radio" value="Special Projects/Contracts" id="LegalcaseLegalProblemSpecialProjectsContracts" name="data[Legalcase][legal_problem]"><span class="label">Special Projects/Contracts</span> - <?php echo ($auth_user_type == 'personal') ? 'I' : 'We'; ?> need a lawyer for a big transaction.
					<br />
					<input type="radio" class="legal_problem_radio" value="Anything under the sun" id="LegalcaseLegalProblemAnythingUnderTheSun" name="data[Legalcase][legal_problem]"><span class="label">Anything under the sun (Other Legal Services)</span> - <?php echo ($auth_user_type == 'personal') ? 'I' : 'We'; ?> need a legal advice before <?php echo ($auth_user_type == 'personal') ? 'I' : 'we'; ?> act.
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
    						<input type="submit" id="next" class="button-next" value="" />
    					</td>
    				</tr>
    			</table>
		<?php echo $this->Form->end();?>
	</div>
</div>

<?php
if ($auth_user_type == 'personal') {
    $profile_action = 'personal_info';
}
elseif ($auth_user_type == 'corporation') {
    $profile_action = 'corporate_partnership_representative_info';
}
?>

<?php $html->scriptBlock("legal_problem_form('$profile_action', '$id', '$case_id', '$case_detail_id', '" . $this->data['Legalcase']['legal_problem'] . "');", array('inline'=>false)); ?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>