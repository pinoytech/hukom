<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<div class="form-title"><?php echo $payment_option_name; ?> - Confirmation</div>
		<div class="form-holder">
		
		<?php
		if ($payment_option == 'check_cash') {
        ?>
            <p>
    			Thank you for all the information you provided. Your <strong><?php echo $payment_option_name; ?> Payment</strong> will be picked up by our E-Lawyers Online Representative on your preferred date. 
                We greatly appreciate your trust and confidence on us by giving opportunity to E-Lawyers Online to render service for you. We will send our written legal advice via e-mail to your preferred email address.
    		</p>
        <?php
        }
        elseif ($payment_option == 'case') {
        ?>
            <p>
    			case
    		</p>
        <?php
        }
        else {
        ?>
            <p>
    			Thank you for your <strong><?php echo $payment_option_name; ?> Payment</strong>. We greatly appreciate your trust and confidence on us by giving opportunity to E-Lawyers Online to render service for you. We will send our written legal advice via e-mail to your preferred email address.
    		</p>
        <?php
        }
		?>
		
		<div style="text-align:center;">
			<input type="button" id="home" class="back-to-case-list" />
		</div>
		
		</div>

	</div>
</div>

<?php $html->scriptBlock("payment_confirmation('$id');", array('inline'=>false));?>