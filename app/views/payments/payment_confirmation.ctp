<div id="full-content">
	<div id="main">
		
		<?php echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<div class="form-title"><?php echo $payment_option_name; ?> - Confirmation</div>
		<div class="form-holder">
		
      <?php echo eval('?>' . SiteCopy::body('payment_confirmation') . '<?php '); ?>
		<div style="text-align:center;">
			<input type="button" id="home" class="back-to-case-list" />
		</div>
		
		</div>

	</div>
</div>

<?php $html->scriptBlock("payment_confirmation('$id');", array('inline'=>false));?>
