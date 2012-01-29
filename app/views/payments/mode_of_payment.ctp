<?php
$check_cash_payment_instructions = SiteCopy::body('check_cash_payment_instructions');


$bank_deposit_payment_instructions = SiteCopy::body('bank_deposit_payment_instructions');;

$paypal_payment_instructions = SiteCopy::body('paypal_payment_instructions');

$gcash_payment_instructions = SiteCopy::body('gcash_payment_instructions');

$smartmoney_payment_instructions = SiteCopy::body('smartmoney_payment_instructions');

$cashsense_payment_instructions = SiteCopy::body('cashsense_payment_instructions');
?>

<div id="bank_deposit_holder" class="hidden" title="Bank Deposit Payment Instructions">
  <p style="padding-top:20px; text-align:center;">
      <?php echo $bank_deposit_payment_instructions; ?>
  </p>
</div>

<div id="paypal_holder" class="hidden" title="Paypal Payment Instructions">
  <p style="padding-top:20px; text-align:center;">
      <?php echo $paypal_payment_instructions; ?>
  </p>
</div>

<div id="gcash_holder" class="hidden" title="G-Cash Payment Instructions">
  <p style="padding-top:20px; text-align:center;">
      <?php echo $gcash_payment_instructions; ?>
  </p>
</div>

<div id="smartmoney_holder" class="hidden" title="SmartMoney Payment Instructions">
  <p style="padding-top:20px; text-align:center;">
      <?php echo $smartmoney_payment_instructions; ?>
  </p>
</div>

<div id="check_cash_holder" class="hidden" title="Check/Cash Pick up Instructions">
  <p style="padding-top:20px; text-align:center;">
      <?php echo $check_cash_payment_instructions; ?>
  </p>
</div>

<div id="cashsense_holder" class="hidden" title="Cashsense Payment Instructions">
  <p style="padding-top:20px; text-align:center;">
      <?php echo $cashsense_payment_instructions; ?>
  </p>
</div>

<div id="monthly_case_payment_input" class="hidden" title="Input Retainer Amount">
    <div style="padding-top:20px;">
  <center>
      <p>Please input the agreed amount of <?php echo $legal_service;?> Fee</p>
        Php <input type="text" name="paypal_amount" id="paypal_amount" onkeypress="return numeralsOnly(event)">
  </center>
  </div>
</div>

<div id="full-content">
  <div id="main">

    <?php echo $this->element('navigation');?>

    <?php echo $this->Session->flash(); ?>

    <?php echo $this->Form->create('Payment');?>		

    <div class="form-title">Mode of Payment</div>
    <div class="form-holder">

        <?php echo SiteCopy::body('mode_of_payment'); ?>

        <?php
        echo $this->Form->input('Payment.user_id', array('type' => 'hidden', 'value' => $id));	
        echo $this->Form->input('Payment.case_id', array('type' => 'hidden', 'value' => $case_id));	
        echo $this->Form->input('Payment.case_detail_id', array('type' => 'hidden', 'value' => $case_detail_id));
        ?>

        <?php
        //$options=array('Paypal'=>'Paypal','GCash'=>'GCash','Smart Money'=>'Smart Money', 'Bank Transfer' => 'Bank Transfer');
        //echo $this->Form->input('Payment.option', array('type' => 'radio', 'options'=>$options, 'legend' => 'Please select payment option', 'class' => 'payment-options'));	
        ?>

      <div style="text-align:center">
        <div style="font-weight:bold">Please select your preferred payment option below:</div>
        <div>
          <input type="radio" class="option_radio" value="bank_deposit" name="data[Payment][option]" >Bank Deposit
          <input type="radio" class="option_radio" value="paypal" name="data[Payment][option]">Paypal
          <input type="radio" class="option_radio" value="gcash" name="data[Payment][option]">G-Cash
          <input type="radio" class="option_radio" value="smartmoney" name="data[Payment][option]">SmartMoney
          <input type="radio" class="option_radio" value="cashsense" name="data[Payment][option]">Cashsense
          <?php
          if ($legal_service == 'Monthly Retainer' || $legal_service == 'Case/Project Retainer') {
          ?>
          <input type="radio" class="option_radio" value="check_cash" name="data[Payment][option]" >Check/Cash Pick up
          <?php
          }
          ?>
        </div>
      </div>

        <center>
          <div style="display:block;padding-left:280px;">
            <label for="data[Payment][option]" class="error" style="display:none">Please select mode of payment</label> 
          </div>

          <br />
        <input type="submit" class="button-next" value="" />
            <?php echo $this->Form->end();?>
        </center>

        <!-- Paypal Form -->
        <!-- <form name="payment_summary" id="payment_summary" action="https://www.paypal.com/cgi-bin/webscr" method="post"> -->
        <form name="payment_summary" id="payment_summary" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_cart">
                <!-- <input type="hidden" name="business" value="info_1299852084_biz@e-lawyersonline.com"> -->
                <input type="hidden" name="business" value="attyvalderama@yahoo.com">
                <input type="hidden" name="upload" value="1">
                <?php $return_link = $base_url . 'payments/payment_confirmation/' .  $id . '/' . $case_id . '/' . $case_detail_id . '/' . 'null/paypal'; ?>
                <input type="hidden" name="return" id="return" value="https://e-lawyersonline.com/login?=<?php echo urlencode($return_link);?>">
                <input type="hidden" name="rm" value="2">
                <input type="hidden" name="no_shipping" value="1">
                <input type="hidden" name="item_name_1" value="E-Lawyers Online">
                <input type="hidden" name="amount_1" id="amount_1" value="<?php echo $fee; ?>">
                <input type="hidden" name="quantity_1" value="1">
                <!-- <input type="hidden" name="image_url" value="<?php echo $base_url;?>registration/paypal-banner.jpg"> -->
                <input type="hidden" name="currency_code" value="PHP">
        </form>

        <div id="cashsense_form_wrapper"></div>

        <div><b>Payment Instructions:</b></div>

        <div id="payment-instructions">

              <ul>
                <li><a href="#tabs-1">Bank Deposit</a></li>
                <li><a href="#tabs-2">Paypal</a></li>
                <li><a href="#tabs-3">G-Cash</a></li>
                <li><a href="#tabs-4">SmartMoney</a></li>
                <li><a href="#tabs-5">Cashsense</a></li>
                <?php
                if ($legal_service == 'Monthly Retainer') {
                ?>
                <li><a href="#tabs-6">Check/Cash Pick up</a></li>
                <?php
                }
                ?>
              </ul>
              <div id="tabs-1">
                <p><?php echo $bank_deposit_payment_instructions; ?></p>
              </div>
              <div id="tabs-2">
                <p><?php echo $paypal_payment_instructions; ?></p>
              </div>
              <div id="tabs-3">
                <p><?php echo $gcash_payment_instructions; ?></p>        	
              </div>
              <div id="tabs-4">
                <p><?php echo $smartmoney_payment_instructions; ?></p>        	
              </div>
              <div id="tabs-5">
                <p><?php echo $cashsense_payment_instructions; ?></p>        	
              </div>
              <?php
              if ($legal_service == 'Monthly Retainer') {
              ?>
              <div id="tabs-6">
                <p><?php echo $check_cash_payment_instructions; ?></p>        	
              </div>
              <?php
              }
              ?>
            </div>

        </div>

  </div>
</div>

<?php
$payment_option = $this->data['Payment']['option'];
$html->scriptBlock("mode_of_payment_form('$id', '$case_id', '$case_detail_id', '$payment_option', '$legal_service', '$fee');", array('inline'=>false));
?>
