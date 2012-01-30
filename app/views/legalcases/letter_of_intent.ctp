<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>

        <?php
        if($service_tip) {
        ?>
        <?php echo SiteCopy::body('legal_advice_by_email_home_link'); ?> 
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
