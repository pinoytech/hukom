<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
						
		<?php echo $this->Session->flash(); ?>
		
		<div class="form-title">Online Legal Consultation</div>
		<div class="form-holder">
			<?php
				echo $this->Form->create('Legalcase');
				echo $this->Form->input('Legalcase.id');
				echo $this->Form->input('Legalcase.user_id', array('type' => 'hidden', 'value' => $user_id));
				// $options = array('per query' => 'Per Query', 'video office conference' => 'Video/Office Conference', 'monthly retainer' => 'Monthly Retainer',  'Legalcase project retainer' => 'Legalcase/Project Retainter');
				// echo $this->Form->input('Legalcase.legal_service', array('label' => false, 'legend' => 'Please select type of legal service that you would like to avail from E-lawyers Online', 'type' => 'radio', 'options' => $options));
			?>
				<div style="text-align:center">
				    <p>
				        The Online Legal Consultation Page is an interactive platform for clients to discuss online his/her legal problem and avail of legal services/advice.  The Client may select from the four (4) kinds of online legal consultation services we offer, as follows:
				    </p>
				    
					<div style="font-weight:bold">Please select the type of legal service that you would like to avail from E-Lawyers Online.</div>
					<div>
						<!--
						<input type="radio" value="per query" id="CaseLegalServiceTypePerQuery" name="data[Legalcase][legal_service]" >Per Query
						<input type="radio" value="video office conference" id="CaseLegalServiceTypeVideoOfficeConference" name="data[Legalcase][legal_service]">Video/Office Conference
						<input type="radio" value="monthly retainer" id="CaseLegalServiceTypeMonthlyRetainer" name="data[Legalcase][legal_service]">Monthly Retainer
						<input type="radio" value="case project retainer" id="CaseLegalServiceTypeCaseProjectRetainer" name="data[Legalcase][legal_service]">Case/Project Retainter
						-->
						<?php
						$i=0;
						foreach ($Legalservices as $Legalservice) {
						?>
						<input type="radio" value="<?php echo $Legalservice['Legalservice']['name'];?>" id="<?php echo $i . '-legal-service';?>" name="data[Legalcase][legal_service]" ><?php echo $Legalservice['Legalservice']['name'];?>
						<?php
							$i++;
						}
						?>
					</div>
				</div>
				<div style="display:block;padding-left:300px;">
					<label for="data[Legalcase][legal_service]" class="error" style="display:none">Please select type of service</label> 
				</div>
				<br />
				<input type="submit" class="button-next" value="" />
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>

<?php echo $html->script('form-hacks');?>

<script type="text/javascript">
jQuery('document').ready(function() {

	jQuery("#LegalcaseOnlineLegalConsultationForm").validate({
		rules: {
			"data[Legalcase][legal_service]" : {
				required: true
			}
		}
	});	
});


</script>