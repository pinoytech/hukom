<div class="users index">
	<h2><?php __('Initial Assessments');?></h2>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('first_name');?></th>
			<th><?php echo $this->Paginator->sort('last_name');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($initial_assessments as $initial_assessment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $initial_assessment['InitialAssessment']['id']; ?>&nbsp;</td>
		<td><?php echo $initial_assessment['InitialAssessment']['email']; ?>&nbsp;</td>
		<td><?php echo $initial_assessment['InitialAssessment']['first_name']; ?>&nbsp;</td>
		<td><?php echo $initial_assessment['InitialAssessment']['last_name']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $initial_assessment['InitialAssessment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $initial_assessment['InitialAssessment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $initial_assessment['InitialAssessment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
    	<?php
    	echo $this->Paginator->counter(array(
    	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
    	));
    	?>
	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	    |
	    <?php echo $this->Paginator->numbers();?>
        |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
		
</div>
<?php echo $this->element('admin_navigation'); ?>
