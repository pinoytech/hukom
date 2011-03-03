<?php
// debug($Legalcasedetail);
?>
<div class="users view">
<h2><?php  __('Case Details of Case No. '. $Legalcasedetail['Legalcase']['id'] .' View');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['Legalcasedetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Legal Problem'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['Legalcase']['legal_problem']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Legal Service'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['Legalcasedetail']['legal_service']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Summary'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['Legalcasedetail']['summary']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Objectives'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['Legalcasedetail']['objectives']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Questions'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['Legalcasedetail']['questions']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['Legalcase']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['Legalcase']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['Legalcase']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
	
	<br />
	<div>
		<?php echo $this->Html->link(__('Edit', true), array('admin' => true, 'action' => 'edit', $Legalcasedetail['Legalcasedetail']['id'])); ?>
		|
		<?php echo $this->Html->link(__('View Case Details List', true), array('admin' => true, 'action' => 'index', $Legalcasedetail['Legalcase']['id'])); ?>
		|
		<?php echo $this->Html->link(__('View Case', true), array('admin' => true, 'controller' => 'legalcases', 'action' => 'view', $Legalcasedetail['Legalcase']['id'])); ?>
	</div>

	
</div>
<?php echo $this->element('admin_navigation'); ?>


