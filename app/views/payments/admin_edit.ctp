<div class="users form">
<?php echo $this->Form->create('Payment');?>
	<fieldset>
 		<legend><?php __('Edit Payment'); ?></legend>
	<?php
		echo $this->Form->input('Payment.id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('Payment.user_id', array('type' => 'hidden'));
		echo $this->Form->input('Payment.case_id', array('type' => 'hidden'));
		echo $this->Form->input('Payment.case_detail_id', array('type' => 'hidden'));
		echo $this->Form->input('Payment.confirmed', array('type' => 'hidden'));
		echo $this->Form->input('Legalcasedetail.legal_service', array('type' => 'hidden'));
        echo '<div><label>Username</label>' . $this->data['User']['username'] . '</div>';
		
		//$options = array('Per Query' => 'Per Query', 'Video/Office Conference' => 'Video/Office Conference', 'Monthly Retainer' => 'Monthly Retainer', 'Case/Project Retainter' => 'Case/Project Retainter');
		//echo $this->Form->input('Legalcasedetail.legal_service', array('type' => 'select', 'options' => $options));
		
		echo '<div><label>Legal Service</label>' . $this->data['Legalcasedetail']['legal_service'] . '</div>';
		
        echo $this->Form->input('Payment.option', array('type' => 'select', 'options' => $custom->list_payment_option()));
		
		if ($this->data['Payment']['option'] == 'Bank Deposit') {
		    echo $this->Form->input('Payment.bank_name');
		    echo $this->Form->input('Payment.bank_branch');
		    echo $this->Form->input('Payment.bank_country');
		    echo $this->Form->input('Payment.bank_date_deposited');
	    }
		
		if ($this->data['Payment']['option'] == 'GCash') {
		    echo $this->Form->input('Payment.gcash_type', array('type' => 'select', 'options' => $custom->list_gcash_type()));
		    echo $this->Form->input('Payment.cellphone_no');
		    echo $this->Form->input('Payment.reference_no');
		}
		
		if ($this->data['Payment']['option'] == 'SmartMoney') {
		    echo $this->Form->input('Payment.smartmoney_type', array('type' => 'select', 'options' => $custom->list_smartmoney_type()));
		    echo $this->Form->input('Payment.cellphone_no');
		    echo $this->Form->input('Payment.reference_no');
		}
		
		
		echo $this->Form->input('Payment.amount');
		
        echo $this->Form->input('Payment.status', array('type' => 'select', 'options' => $custom->list_payment_status()));
	?>
	</fieldset>
	
	<?php echo $this->Form->end(__('Submit', true));?>
	
	
</div>
<?php echo $this->element('admin_navigation'); ?>