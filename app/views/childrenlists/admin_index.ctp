<div class="childreninfos index">
	<h2><?php __('Children List');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Name', 'ChildrenList.name');?></th>
			<th><?php echo $this->Paginator->sort('Sex', 'ChildrenList.sex');?></th>
			<th><?php echo $this->Paginator->sort('Birth Date', 'ChildrenList.birth_date');?></th>
			<th><?php echo $this->Paginator->sort('School', 'ChildrenList.school');?></th>
			<th><?php echo $this->Paginator->sort('Grade/Year', 'ChildrenList.grade_year');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
    // debug($ChildrenLists);
	foreach ($ChildrenLists as $ChildrenList):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $ChildrenList['ChildrenList']['id']; ?>&nbsp;</td>
		<td><?php echo $ChildrenList['ChildrenList']['name']; ?>&nbsp;</td>
		<td><?php echo $ChildrenList['ChildrenList']['sex']; ?>&nbsp;</td>
		<td><?php echo $ChildrenList['ChildrenList']['birth_date']; ?>&nbsp;</td>
		<td><?php echo $ChildrenList['ChildrenList']['school']; ?>&nbsp;</td>
		<td><?php echo $ChildrenList['ChildrenList']['grade_year']; ?>&nbsp;</td>
		<td><?php echo $ChildrenList['ChildrenList']['created']; ?>&nbsp;</td>
		<td class="actions">
		    <?php echo $this->Html->link(__('View Child Info', true), array('action' => 'view', $ChildrenList['ChildrenList']['id'])); ?>
		    <?php echo $this->Html->link(__('Edit Child Info', true), array('action' => 'edit', $ChildrenList['ChildrenList']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $ChildrenList['ChildrenList']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ChildrenList['ChildrenList']['id'])); ?>
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