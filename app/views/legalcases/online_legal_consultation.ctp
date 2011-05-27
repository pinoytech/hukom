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
				        The <b>Online Legal Consultation Service</b> offers you the most convenient way to start an attorney-client relationship by discussing all your legal problems online and choosing from the five (5) types of online legal service most preferable to your needs.
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
                		<p>
                		  <b>Online Legal Consultation By E-Mail/Written Query</b> – this legal service is best suited for clients that need initial evaluation of his/her case or legal problem.  The client can discuss the legal problem by providing the facts/details, objectives, and questions through our online form. Upon payment of the Online legal consultation fee of P1,500.00, E-Lawyers Online will send the legal advice through e-mail based on the given information. 
                		</p>
                		

                		  Tips:
                	        <ul>
                	            <li>It will be useful for the client to write the complete facts, objectives, and questions regarding his/her legal problem using any word processor program (like Microsoft Word, Wordpad, or Notepad) for an easy cut-and-paste process. </li>
                	            <li>For any documents which can be valuable for the case, clients can upload any Microsoft Word, Portable Document Format (PDF), or a scanned image (in JPEG format) for a more comprehensive legal advice from E-Lawyers Online.</li>
                		    </ul>

                	</div>
                	<div id="tabs-2">
                        <p>
                            <b>Online Legal Consultation By Video Conference</b> – this legal service is suitable for clients, mostly abroad or have time and distance contraint,  who require an in-depth discussion of his/her case or legal problem through video conference (and/or chat) using Skype or Yahoo Messenger. Through our online form, the client can select a preferred date and time and provide in advance the necessary facts/details, objectives, and questions relevant to the legal problem. The video conference is rated at Php 2,000/hour, E-Lawyers Online will send the initial legal advice through e-mail based on the given information and during the conference, the client can explore more on the chances or probability of winning his/her case by asking follow-up questions from the lawyer.
                        </p>
                        
                		  Tips:
                	        <ul>
                	            <li>It will be useful for the client to write the complete facts, objectives, and questions regarding his/her legal problem using any word processor program (like Microsoft Word, Wordpad, or Notepad) for an easy cut-and-paste process. </li>
                	            <li>For any documents which can be valuable for the case, clients can upload any Microsoft Word, Portable Document Format (PDF), or a scanned image (in JPEG format) for a more comprehensive legal advice from E-Lawyers Online.</li>
                	            <li>Make sure you have the following: built-in or separate headset with microphone and webcam. Before the video conference, test if your headset, microphone, and webcam are working properly. Prepare a copy of the facts and details for reference during the conference.</li>
                		    </ul>
                	</div>
                	<div id="tabs-3">
                        <p>
                            <b>Online Legal Consultation By Office Conference</b> – this legal service is suitable for clients who require an in-depth discussion of his/her case or legal problem through office conference. Through our online form, the client can select a preferred date and time of office conference and provide in advance the necessary facts/details, objectives, and questions relevant to the legal problem. The office conference is rated at Php 2,000/hour and will be held at Suite 10-G Strata 100 Condominium, 100 F. Ortigas Jr. Road, Ortigas Center, Pasig City, Metro Manila. E-Lawyers Online will send the initial legal advice through e-mail based on the given information and during the conference the client can explore more on the chances or probability of winning his/her case by asking follow-up questions from the lawyer.
                        </p>
                        
                		  Tips:
                	        <ul>
                	            <li>It will be useful for the client to write the complete facts, objectives, and questions regarding his/her legal problem using any word processor program (like Microsoft Word, Wordpad, or Notepad) for an easy cut-and-paste process. </li>
                	            <li>For any documents which can be valuable for the case, clients can upload any Microsoft Word, Portable Document Format (PDF), or a scanned image (in JPEG format) for a more comprehensive legal advice from E-Lawyers Online.</li>
                	            <li>We advised you to be at our office 30 minutes before the set schedule of office conference for purposes of preparation of documents and initial interview.</li>
                		    </ul>
                	</div>
                	<div id="tabs-4">
                		<p>
                		    <b>Online/Offline Legal Consultation under a Monthly Retainer Agreement</b> – this legal service is tailored for clients who require a dedicated lawyer to attend to the legal requirements of their business and/or projects on a monthly basis. Clients can choose from a scope of a monthly service through our website and E-Lawyers Online will send a proposed Monthly Retainer Agreement. Upon signing the agreement and payment of the retainer fee, E-Lawyers Online will provide online legal service through video, chat, or phone, and through personal meeting at the convenience of the client.
                		</p>        	
                	</div>
                    <div id="tabs-5">
                		<p>
                		    <b>Online/Offline Legal Consultation Per Case/Project</b> – this legal service is for clients who need a lawyer to handle a particular case or a particular project. The client can discuss the legal problem by providing the facts/details, objectives, and questions through our online form. After assessment and review of the relevant information, E-Lawyers Online will send a proposed Per Case/Project Retainer Agreement. Upon signing of the agreement and payment of the acceptance fee, E-Lawyers Online shall provide the legal advice, services, and representation to the client on a per case or per project basis.
                		</p>
                		
                		  Tips:
                	        <ul>
                	            <li>It will be useful for the client to write the complete facts, objectives, and questions regarding his/her legal problem using any word processor program (like Microsoft Word, Wordpad, or Notepad) for an easy cut-and-paste process. </li>
                	            <li>For any documents which can be valuable for the case, clients can upload any Microsoft Word, Portable Document Format (PDF), or a scanned image (in JPEG format) for a more comprehensive legal advice from E-Lawyers Online.</li>
                		    </ul>
                	</div>
                </div>
				
				
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
	
	jQuery('#legal-service-descriptions').tabs();
});


</script>