<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->Form->create('User', array('url' => "/users/letter_of_intent/$id"));
			echo $this->Form->input('User.id', array('value' => $id));
		?>
		
			<fieldset>
		 		<legend><?php __('Letter of Intent'); ?></legend>
				<p>
					I, <?php echo $user_full_name;?>, with <?php echo $email;?>, of legal age, hereby intends to obtain from E-Lawyers Online your service of online legal consultation via E-Mail or Written Query.
				</p>
				
				<p>
					I agree to pay the amount of [Fee] as professional fee. I undertake to pay the same within two (2) days from submission of this letter of intent and I understand that my failure to pay within the said period shall entitle E-Lawyers Online to defer the review of my case and defer sending the written answer to my query/ies. I expressly acknowledge that the said fee is for the full payment for the subject matter of my query and to no other, and in case I failed to complete the facts or documents as requested, the partial written answer to my query/ies shall be considered as full performance of E-Lawyers Online’s obligation and the fees thereof forfeited in favor of E-Lawyers Online. For this purpose, I am providing you my personal information, the summary of the facts of my legal problem including documents (if any), my objective, my questions and my acceptance of your Online Legal Consultation Agreement. 
				</p>
				
				<p>
					Respectfully submitted.
				</p>
				
			</fieldset>
		<?php echo $this->Form->end(__('Submit', true));?>
		
		
	</div>
</div>