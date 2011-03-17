<?php
// debug($Payment);
?>
<div class="payments view">
<h2><?php  __('View Payment');?></h2>
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
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Referred By'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php //echo $Payment['Payment']['option']; ?>
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


