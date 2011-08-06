<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
					
			<div class="form-title"><?php echo ($auth_user_type == 'personal') ? 'My' : 'Our'; ?> Scope of Monthly Legal Service/s are:</div>
			<div class="form-holder">
			    
			    <p>
			        (Choose the legal service you intend to avail monthly from E-Lawyers Online)
			    </p>
			    
				<?php echo $this->Form->create('Legalcase');?>
				<?php
					echo $this->Form->input('Legalcase.id');
					echo $this->Form->input('Legalcase.user_id', array('type' => 'hidden', 'value' => $id));
					echo $this->Form->input('Legalcase.status', array('type' => 'hidden', 'value' => 'active'));
					echo $this->Form->input('Legalcase.legal_problem', array('type' => 'hidden', 'value' => $legal_problem));
				?>
				
				<div class="input radio">
					<div style="float:left;"><input type="checkbox" name="data[Legalcase][monthly_scope][]" value="All legal services in the nature of legal opinion, and legal advice required in the ordinary course of business;<br />"></div>
					<div class="scope-text">All legal services in the nature of legal opinion, and legal advice required in the ordinary course of business;</div>
					<br />
					<br />
					<div style="float:left;"><input type="checkbox" name="data[Legalcase][monthly_scope][]" value="Preparation and review of legal papers, affidavits, contracts, deeds, and simple agreements for the day-to-day activities of the business;<br />"></div>
					<div class="scope-text">Preparation and review of legal papers, affidavits, contracts, deeds, and simple agreements for the day-to-day activities of the business;</div>
					<br />
					<br />
					<br />
					<input type="checkbox" name="data[Legalcase][monthly_scope][]" value="Representation/attendance in all board meetings/conferences where lawyer's presence may be required;<br />">
					Representation/attendance in all board meetings/conferences where lawyer's presence may be required;
					<br />
					<br />
					<input type="checkbox" name="data[Legalcase][monthly_scope][]" value="Representation, negotiation and liaison with government agencies and instrumentalities;<br />">
					Representation, negotiation and liaison with government agencies and instrumentalities;
					<br />
					<br />
					<input type="checkbox" id="other_services"  name="data[Legalcase][monthly_scope][]" value="other">Other Services
					<input type="text" id="other_services_text" name="data[Legalcase][other_services]" class="required" style="width:80%;">
                    
				</div>
				<div style="display:block;padding-left:290px;">
					<label for="data[Legalcase][monthly_scope][]" class="error" style="display:none">Please select scope of services</label> 
				</div>
				<br />
				<table>
    				<tr>
    					<td>
    						<input type="button" id="back" class="button-back" value="" />
    					</td>
    					<td>
    						<input type="Submit" id="next" class="button-submit" value="" />
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

<?php $html->scriptBlock("scope_of_monthly_legal_service_form('$profile_action', '$id', '$case_id');", array('inline'=>false)); ?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>
