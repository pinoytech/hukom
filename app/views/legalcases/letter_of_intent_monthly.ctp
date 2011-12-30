<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<?php
        if($service_tip && $legal_service == 'Monthly Retainer') {
        ?>
        <div class="form-title">Online/Offline Legal Consultation under a Monthly Retainer Agreement </div>
        <div class="form-holder">
            <p>
                This legal service is tailored for clients who require a dedicated lawyer to attend to the legal requirements of their business and/or projects on a monthly basis. Clients can choose from a scope of a monthly service through our website and E-Lawyers Online will send a proposed Monthly Retainer Agreement. Upon signing the agreement and payment of the retainer fee, E-Lawyers Online will provide online and offline legal service through video, chat, or phone, and through personal meeting at the convenience of the client.
            </p>
            
            <p>
                (Ang legal na serbisyo na ito ay para sa mga kliyente na nangangailangan ng abogado na aasikaso sa mga buwan-buwan na mga legal na problema at legal na pangangailangan ng kanilang negosyo, proyekto o personal na buhay.  Ang kliyente ay pwedeng pumili sa saklaw ng mga serbisyo at ang E-Lawyers Online ay magpapadala ng panukalang Monthly Retainer Agreement. Pagkatapos na magkasundo at lagdaan ang Monthly Retainer Agreement at nabayaran ang buwanang bayad, ang E-Lawyers Online ay magbibigay ng serbisyong legal.)
            </p>
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
					I, <b><?php echo $user_full_name;?></b>, with registered e-mail address of <b><?php echo $email;?></b>, of legal age, hereby intends to obtain from E-Lawyers Online your service of monthly retainer legal consultation.
				</p>
				
				<p>
				    I/we agree to pay the amount of <b>RETAINER FEE</b> per month as agreed upon in the Monthly Retainer Agreement. I undertake to pay the same every <b>5th day of the month</b>, which shall start from signing of our mutually agreed monthly retainer agreement. For this purpose, I am providing you my/our personal information and the list of scope of services I/we require. 
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