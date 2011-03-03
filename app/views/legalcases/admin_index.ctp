<div class="cases index">
	<h2><?php __('Cases');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('User.username');?></th>
			<th><?php echo $this->Paginator->sort('legal_problem');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	// debug($Legalcase);
	foreach ($Legalcase as $Legalcases):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $Legalcases['Legalcase']['id']; ?>&nbsp;</td>
		<td><?php echo $Legalcases['User']['username']; ?>&nbsp;</td>
		<td><?php echo $Legalcases['Legalcase']['legal_problem']; ?>&nbsp;</td>
		<td><?php echo $Legalcases['Legalcase']['status']; ?>&nbsp;</td>
		<td><?php echo $Legalcases['Legalcase']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $Legalcases['Legalcase']['id'])); ?>
			<?php echo $this->Html->link(__('View Case Details', true), array('controller' => 'legalcasedetails', 'action' => 'index', $Legalcases['Legalcase']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $Legalcases['Legalcase']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $Legalcases['Legalcase']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $Legalcases['Legalcase']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<?php echo $this->element('admin_navigation'); ?>