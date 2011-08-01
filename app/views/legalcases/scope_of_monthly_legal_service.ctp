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
				?>
				
				<div class="input radio">
					<input type="checkbox" name="data[Legalcase][monthly_scope][]" value="All legal services in the nature of legal consulations, legal opinion and legal advice required in the ordinary course of business;<br />">
					All legal services in the nature of legal consulations, legal opinion and legal advice required in the ordinary course of business;
					<br />
					<br />
					<input type="checkbox" name="data[Legalcase][monthly_scope][]" value="Preparation and review of legal papers, affidavits, contracts, deeds, and simple agreements for the day-to-day activtities of the business;<br />">
					Preparation and review of legal papers, affidavits, contracts, deeds, and simple agreements for the day-to-day activtities of the business;
					<br />
					<br />
					<input type="checkbox" name="data[Legalcase][monthly_scope][]" value="Representation/attendance in all board meetings/conferences where lawyer's presence may be required;<br />">
					Representation/attendance in all board meetings/conferences where lawyer's presence may be required
					<br />
					<br />
					<input type="checkbox" name="data[Legalcase][monthly_scope][]" value="Reperesentation, negotation and liaison with govenrment agencies and instrumentalities;<br />">
					Reperesentation, negotation and liaison with govenrment agencies and instrumentalities;
					<br />
					<br />
					<input type="checkbox"  name="data[Legalcase][monthly_scope][]" value="other">Other Services
					<input type="text" name="data[Legalcase][other_services]" style="width:80%;">
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
