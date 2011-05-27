<div class="cases index">
	<h2><?php __('Case No.'. $case_id);?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('legal_service');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	// debug($Legalcasedetails);
	foreach ($Legalcasedetails as $Legalcasedetail):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $Legalcasedetail['Legalcasedetail']['id']; ?>&nbsp;</td>
		<td><?php echo $Legalcasedetail['Legalcasedetail']['legal_service']; ?>&nbsp;</td>
		<td><?php echo $Legalcasedetail['Legalcasedetail']['status']; ?>&nbsp;</td>
		<td><?php echo $Legalcasedetail['Legalcasedetail']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View Case Details', true), array('action' => 'view', $Legalcasedetail['Legalcasedetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit Case Details', true), array('action' => 'edit', $Legalcasedetail['Legalcasedetail']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $Legalcasedetail['Legalcasedetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $Legalcasedetail['Legalcasedetail']['id'])); ?>
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