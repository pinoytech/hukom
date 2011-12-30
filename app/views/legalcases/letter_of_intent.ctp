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
				<p>
					<?php echo date('F d, Y');?>
				</p>
				
				<p>
					I, <b><?php echo $user_full_name;?></b>, with registered e-mail address of <b><?php echo $email;?></b>, of legal age, hereby intends to obtain from E-Lawyers Online your service of online legal consultation via E-Mail or Written Query.
				</p>
				
				<p>
				    I agree to pay the amount of <b>Php <?php echo $fee;?></b> as professional fee. I undertake to pay the same within two (2) days from submission of this letter of intent and I understand that my failure to pay within the said period shall entitle E-Lawyers Online to defer the review of my case and/or defer sending the written answer to my query/ies. I expressly acknowledge that the said fee is for the full payment for the subject matter of my query and to no other, and in case I failed to complete the facts or documents as requested, the partial written answer to my query/ies shall be considered as full performance of E-Lawyers Online’s obligation and the fees thereof forfeited in favor of E-Lawyers Online. For this purpose, I am providing you my personal information, the summary of the facts of my legal problem including documents (if any), my objective, my questions and my acceptance of your Online Legal Consultation Agreement. 
				</p>
				
				<p>
					Respectfully submitted.
				</p>				
				<br />
			    <input type="submit" class="button-submit" value="" />
			    
			<?php echo $this->Form->end();?>
		</div>
	</div>
</div>
