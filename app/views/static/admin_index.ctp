<div class="users index">
	<h2><?php __('Site Copies');?></h2>
	
	<div>
		<?php echo $this->Html->link(__('Add Site Copy', true), array('admin' => true, 'action' => 'add')); ?>
	</div>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('slug');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
    // debug($site_copies);
	foreach ($site_copies as $site_copy):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $site_copy['SiteCopy']['id']; ?>&nbsp;</td>
		<td><?php echo $site_copy['SiteCopy']['title']; ?>&nbsp;</td>
		<td><?php echo $site_copy['SiteCopy']['slug']; ?>&nbsp;</td>
		<td><?php echo $site_copy['SiteCopy']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $site_copy['SiteCopy']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $site_copy['SiteCopy']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $site_copy['SiteCopy']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $site_copy['SiteCopy']['id'])); ?>
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