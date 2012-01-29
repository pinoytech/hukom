<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>

        <?php
        if($service_tip) {
        ?>
        <div class="form-title">Online Legal Consultation By E-Mail/Written Query </div>
        <div class="form-holder">
            <p>
                If you wish an evaluation of your case or legal problem through email, this is the service for you. There's an online form available for you to provide the facts/details, objectives and questions about your concerns and legal advice will be provided to you through email.
            </p>
            <p>
                (Kung gusto mo ng pagsusuri ng iyong kaso o ng iyong problemang legal sa pamamagitan ng email, ito ang serbisyong legal na para sa iyo. Meron dito na online form na magagamit mo para makapagbigay ng mga kwento ng mga pangyayari ng iyong problemang legal at mga detalye nito, ang iyong hangarin o gustong mangyari at mga katanungan na may kinalaman sa iyong kaso o problemang legal at ang aming payong legal ay ipapadala sa iyo sa pamamagitan ng email.)
            </p>
            
            <p><b>Fee:  PhP 1,500 per hour</b></p>
            
            Tips:
            
            <ul>
                <li>It will be useful for the client to write the complete facts, objectives, and questions regarding his/her legal problem using any word processor program (like Microsoft Word, Wordpad, or Notepad) for an easy cut-and-paste process. (Kung mahaba ang kwento ng mga pangyayari ng problemang legal, mas makakabuti na ito ay i-type muna sa word processor program (like Microsoft Word, Wordpad, or Notepad) at mag cut-and-paste ng natype na kwento)<br /> <br /></li>
                <li>For any documents, which can be valuable for the case, clients can upload any Microsoft Word, Portable Document Format (PDF), or a scanned image (in JPEG format) for a more comprehensive legal advice from E-Lawyers Online. (Kung meron kayong papel o dokumento na parte o makakatulong sa inyong kaso o problemang legal, pwede itong i-scan at i-attach dito para makapagbigay ang E-Lawyers Online ng mas kumpleto at malawak na payong legal.)</li>
            </ul>
        </div>    
        <?php
        }
        ?>
                
        <br />

		<div class="form-title">Client's Letter of Intent</div>
		<div class="form-holder">
		
		        <?php				
                if ($auth_user_type == 'personal') {
                    $profile_action = 'personal_info';
                }
                elseif ($auth_user_type == 'corporation') {
                    $profile_action = 'corporate_partnership_representative_info';
                }

                echo $this->Form->create('User', array('onsubmit' => "redirect_form('$profile_action', '$id', '$case_id', ''); return false;"));
				?>
				
				<?php echo eval('?>' . SiteCopy::body('letter_of_intent') . '<?php '); ?>		
				<br />
			    <input type="submit" class="button-submit" value="" />
			    
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>
