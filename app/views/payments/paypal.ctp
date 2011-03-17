<!-- Paypal Form -->
<!-- <form name="payment_summary" id="payment_summary" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post"> -->
<form name="payment_summary" id="payment_summary" action="https://www.paypal.com/cgi-bin/webscr" method="post">
    <input type="hidden" name="cmd" value="_cart">
    <!-- <input type="hidden" name="business" value="paoann_1277869433_biz@gmail.com"> pao_paypal_account@yahoo.com -->
    <input type="hidden" name="business" value="pao_paypal_account@yahoo.com">
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="return" id="return" value="<?php echo $base_url;?>payment_confirmation/<?php echo $id . '/' . $case_id . '/' . $case_detail_id; ?>">
    <input type="hidden" name="rm" value="2">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="item_name_1" value="PAO 2010 Annual Meeting Fees">
    <input type="hidden" name="amount_1" id="amount_1" value="<?php echo $meeting_amount_total + $annual_dues_ammount_total;?>">
    <input type="hidden" name="quantity_1" value="1">
    <input type="hidden" name="image_url" value="<?php echo $base_url;?>registration/paypal-banner.jpg">
    <input type="hidden" name="currency_code" value="PHP">
</form>