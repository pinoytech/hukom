<div class="personalinfos view">
<h2><?php  __('Initial Assessment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $initial_assessment['InitialAssessment']['id']; ?>
			&nbsp;
		</dd>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $initial_assessment['InitialAssessment']['email']; ?>
			&nbsp;
		</dd>

        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('First Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $initial_assessment['InitialAssessment']['first_name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $initial_assessment['InitialAssessment']['last_name']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Details'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $initial_assessment['InitialAssessment']['details']; ?>
			&nbsp;
		</dd>		
			
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $initial_assessment['InitialAssessment']['created']; ?>
			&nbsp;
		</dd>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $initial_assessment['InitialAssessment']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
	
	<br />
	<div>
		<?php echo $this->Html->link(__('Back to Initial Assessment', true), array('action' => 'index', $initial_assessment['InitialAssessment']['id'])); ?>
	</div>
</div>
<?php echo $this->element('admin_navigation'); ?>

