<div class="personalinfos view">
<h2><?php  __('Child Information');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ChildrenList['ChildrenList']['id']; ?>
			&nbsp;
		</dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ChildrenList['ChildrenList']['name']; ?>
			&nbsp;
		</dd>

        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sex'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ChildrenList['ChildrenList']['sex']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Birth Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ChildrenList['ChildrenList']['birth_date']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Grade/Year'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ChildrenList['ChildrenList']['grade_year']; ?>
			&nbsp;
		</dd>		
			
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ChildrenList['ChildrenList']['created']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ChildrenList['ChildrenList']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
	
	<br />
	<div>
		<?php echo $this->Html->link(__('Edit Child Information', true), array('action' => 'edit', $ChildrenList['ChildrenList']['id'])); ?>
		|
		<?php echo $this->Html->link(__('Back to Children List', true), array('action' => 'index', $ChildrenList['User']['id'])); ?>
	</div>
</div>
<?php echo $this->element('admin_navigation'); ?>

