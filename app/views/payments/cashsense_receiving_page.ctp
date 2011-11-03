<div id="full-content">
	<div id="main">
		
		<?php //echo $this->element('navigation');?>
				
		<?php echo $this->Session->flash(); ?>
		
		<div class="form-title">Cashsense - Confirmation</div>
		<div class="form-holder">
	  
      <p>
        <?php
          echo "sRespCode = $sRespCode <br>";
          echo "sCSTxnID = $sCSTxnID <br>";
          echo "sMerchantTxnID = $sMerchantTxnID <br>";
          echo "isPaid = $isPaid <br>";
        ?>
      </p>

		<div style="text-align:center;">
			<input type="button" id="home" class="back-to-home" />
		</div>
		
		</div>

	</div>
</div>

<?php $html->scriptBlock("payment_confirmation('$id');", array('inline'=>false));?>
