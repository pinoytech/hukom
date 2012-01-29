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
				    <?php echo SiteCopy::body('onlline_legal_consultation'); ?>
				    
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
						<input type="radio" value="<?php echo $Legalservice['Legalservice']['name'];?>" id="<?php echo $i . '-legal-service';?>" name="data[Legalcase][legal_service]" class="legal_service_type"><?php echo $Legalservice['Legalservice']['name'];?>
						<?php
							$i++;
						}
						?>
					</div>
				</div>
                <div style="display:block;padding-left:290px;">
					<label for="data[Legalcase][legal_service]" class="error" style="display:none">Please select type of service</label> 
				</div>
				
				<center>
    				<br />
    				<input type="submit" class="button-next" value="" />
				</center>
				
				<br />
				<div id="legal-service-descriptions">
                	<ul>
                		<li><a href="#tabs-1">Per Query </a></li>
                		<li><a href="#tabs-2">Video Conference</a></li>
                		<li><a href="#tabs-3">Office Conference</a></li>
                		<li><a href="#tabs-4">Monthly Retainer</a></li>
                		<li><a href="#tabs-5">Case/Project Retainer</a></li>
                	</ul>
                	<div id="tabs-1">
                		<?php echo SiteCopy::body('per_query_onlline_legal_consultation'); ?>
                	</div>
                	<div id="tabs-2">
                	    <?php echo SiteCopy::body('video_conference_onlline_legal_consultation'); ?>
                	</div>
                	<div id="tabs-3">
                        <?php echo SiteCopy::body('office_conference_onlline_legal_consultation'); ?>
                	</div>
                	<div id="tabs-4">
                	    <?php echo SiteCopy::body('monthly_retainer_onlline_legal_consultation'); ?>
                	</div>
                    <div id="tabs-5">
                        <?php echo SiteCopy::body('case_project_onlline_legal_consultation'); ?>
                	</div>
                </div>
		</div>
		<?php echo $this->Form->end();?>
	</div>
</div>

<?php $html->scriptBlock("online_legal_consultation_form();", array('inline'=>false));?>
<?php echo $html->script('form-hacks', array('inline'=>false));?>