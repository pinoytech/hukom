<?php
// debug($Payment); exit;
?>
<div class="cases index">
	<h2><?php __('Payments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Case ID');?></th>
			<th><?php echo $this->Paginator->sort('Case Detail ID');?></th>
			<th><?php echo $this->Paginator->sort('Username', 'User.username');?></th>
			<th><?php echo $this->Paginator->sort('Legal Service', 'Legalcasedetail.legal_service');?></th>
			<th><?php echo $this->Paginator->sort('option');?></th>
			<th><?php echo $this->Paginator->sort('Referred By');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	// debug($Payment);
	foreach ($Payments as $Payment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $Payment['Payment']['id']; ?>&nbsp;</td>
		<td><?php echo $Payment['Payment']['case_id']; ?>&nbsp;</td>
		<td><?php echo $Payment['Payment']['case_detail_id']; ?>&nbsp;</td>
		<td><?php echo $Payment['User']['username']; ?>&nbsp;</td>
		<td><?php echo $Payment['Legalcasedetail']['legal_service']; ?>&nbsp;</td>
		<td><?php echo $Payment['Payment']['option']; ?>&nbsp;</td>
		<td>&nbsp;</td>
		<td><?php echo $Payment['Payment']['status']; ?>&nbsp;</td>
		<td><?php echo $Payment['Payment']['amount']; ?>&nbsp;</td>
		<td><?php echo $Payment['Payment']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View Payment Details', true), array('action' => 'view', $Payment['Payment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit Payment Status', true), array('action' => 'edit', $Payment['Payment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $Payment['Payment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $Payment['Legalcase']['id'])); ?>
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