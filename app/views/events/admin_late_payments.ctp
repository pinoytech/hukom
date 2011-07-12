<?php
// debug($Payment); exit;
?>
<div class="cases index">
	<h2><?php __('Conference Late Payments List');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Username', 'User.username');?></th>
			<th><?php echo $this->Paginator->sort('User ID');?></th>
			<th><?php echo $this->Paginator->sort('Case ID');?></th>
			<th><?php echo $this->Paginator->sort('Case Detail ID');?></th>
			<th><?php echo $this->Paginator->sort('Date');?></th>
			<th><?php echo $this->Paginator->sort('Start Time');?></th>
			<th><?php echo $this->Paginator->sort('End Time');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
    // debug($Events);
    // exit;
	foreach ($Events as $Event):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $Event['Event']['id']; ?>&nbsp;</td>
		<td><?php echo $Event['User']['username']; ?>&nbsp;</td>
		<td><?php echo $Event['Event']['user_id']; ?>&nbsp;</td>
		<td><?php echo $Event['Event']['case_id']; ?>&nbsp;</td>
		<td><?php echo $Event['Event']['case_detail_id']; ?>&nbsp;</td>
		<td><?php echo date('F d, Y', strtotime($Event['Event']['start'])); ?>&nbsp;</td>
		<td><?php echo date('h:i A', strtotime($Event['Event']['start'])); ?>&nbsp;</td>
		<td><?php echo date('h:i A', strtotime($Event['Event']['end'])); ?>&nbsp;</td>
		<td><?php echo $Event['Event']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('Delete', true), array('action' => 'delete_event', $Event['Event']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $Event['Event']['id'])); ?>
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