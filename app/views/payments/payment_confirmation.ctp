<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<div class="form-title"><?php echo $payment_option_name; ?> - Confirmation</div>
		<div class="form-holder">
		
		<p>
			Thank You for your <strong><?php echo $payment_option_name; ?> Payment</strong>. We greatly appreciate your trust and confidence on us by giving opportunity to E-Layers Online
			to render service for you. Will send our written and legal advice via e-mail to your preferred email address. 
		</p>
		</div>
		<br />
		
		<div style="text-align:center;">
			<input type="button" id="home" value="Back to Case List" />
		</div>
	</div>
</div>

<script type="text/javascript">
jQuery('document').ready(function() {

	jQuery('#home').click(function() {
		window.location = '/legalcases/index/<?php echo $id;?>';
        
	});
});

</script>