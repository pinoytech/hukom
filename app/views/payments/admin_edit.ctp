<div class="users form">
<?php echo $this->Form->create('Payment');?>
	<fieldset>
 		<legend><?php __('Edit Payment'); ?></legend>
	<?php
		echo $this->Form->input('Payment.id', array('type' => 'text', 'readonly' => true));
		echo $this->Form->input('Payment.case_id', array('type' => 'hidden'));
		echo $this->Form->input('Payment.confirmed', array('type' => 'hidden'));
        echo '<div><label>Username</label>' . $this->data['User']['username'] . '</div>';
		
		//$options = array('Per Query' => 'Per Query', 'Video/Office Conference' => 'Video/Office Conference', 'Monthly Retainer' => 'Monthly Retainer', 'Case/Project Retainter' => 'Case/Project Retainter');
		//echo $this->Form->input('Legalcasedetail.legal_service', array('type' => 'select', 'options' => $options));
		
		echo '<div><label>Legal Service</label>' . $this->data['Legalcasedetail']['legal_service'] . '</div>';
		
		$options = array('Bank Deposit' => 'Bank Deposit', 'Paypal' => 'Paypal', 'GCash' => 'GCash', 'SmartMoney' => 'SmartMoney');
		echo $this->Form->input('Payment.option', array('type' => 'select', 'options' => $options));
		
		echo $this->Form->input('Payment.amount');
		
		$options = array('Pending' => 'Pending', 'Overdue' => 'Overdue', 'Confirmed' => 'Confirmed');
		echo $this->Form->input('Payment.status', array('type' => 'select', 'options' => $options));
	?>
	</fieldset>
	
	<?php echo $this->Form->end(__('Submit', true));?>
	
	
</div>
<?php echo $this->element('admin_navigation'); ?>