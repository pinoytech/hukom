<?php
// debug($Payment);
?>
<div class="payments view">
<h2><?php  __('Payment Details');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Payment['Payment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Payment['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Legal Service'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Payment['Legalcasedetail']['legal_service']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Option'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Payment['Payment']['option']; ?>
			&nbsp;
		</dd>
		
		<?php
		if ($Payment['Payment']['option'] == 'Bank Deposit') {
        ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Name'); ?></dt>
    		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    			<?php echo $Payment['Payment']['bank_name']; ?>
    			&nbsp;
    		</dd>
		
    		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Branch'); ?></dt>
    		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    			<?php echo $Payment['Payment']['bank_branch']; ?>
    			&nbsp;
    		</dd>
		
    		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank Counrty'); ?></dt>
    		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    			<?php echo $Payment['Payment']['bank_country']; ?>
    			&nbsp;
    		</dd>
    		
    		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Deposited'); ?></dt>
    		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    			<?php echo $Payment['Payment']['bank_date_deposited']; ?>
    			&nbsp;
    		</dd>
		<?php
		}
		?>
		
		<?php
		if ($Payment['Payment']['option'] == 'GCash') {
        ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('GCash Type'); ?></dt>
    		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    			<?php echo $Payment['Payment']['gcash_type']; ?>
    			&nbsp;
    		</dd>
		
    		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cellphone No.'); ?></dt>
    		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    			<?php echo $Payment['Payment']['cellphone_no']; ?>
    			&nbsp;
    		</dd>
		
    		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reference No.'); ?></dt>
    		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    			<?php echo $Payment['Payment']['reference_no']; ?>
    			&nbsp;
    		</dd>
        <?php
		}
		?>
		
		<?php
		if ($Payment['Payment']['option'] == 'SmartMoney') {
        ?>
            <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('SmartMoney Type'); ?></dt>
    		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    			<?php echo $Payment['Payment']['smartmoney_type']; ?>
    			&nbsp;
    		</dd>
		
    		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cellphone No.'); ?></dt>
    		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    			<?php echo $Payment['Payment']['cellphone_no']; ?>
    			&nbsp;
    		</dd>
		
    		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reference No.'); ?></dt>
    		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    			<?php echo $Payment['Payment']['reference_no']; ?>
    			&nbsp;
    		</dd>
        <?php
		}
		?>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Payment['Payment']['amount']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Referred By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Payment['User']['referred_by']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Payment['Payment']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Payment['Payment']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Payment['Legalcase']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
	
	<br />
	<div>
		<?php echo $this->Html->link(__('Edit', true), array('admin' => true, 'action' => 'edit', $Payment['Payment']['id'])); ?>
		|
		<?php echo $this->Html->link(__('Payments List', true), array('admin' => true, 'controller' => 'payments', 'action' => 'index', $Payment['Payment']['id'])); ?>
		|
		<?php echo $this->Html->link(__('View Case Details', true), array('admin' => true, 'controller' => 'legalcasedetails', 'action' => 'view', $Payment['Legalcasedetail']['id'])); ?>
	</div>

	
</div>
<?php echo $this->element('admin_navigation'); ?>


