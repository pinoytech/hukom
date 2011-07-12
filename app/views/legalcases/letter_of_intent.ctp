<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
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