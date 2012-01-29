<div class="users index">
	<h2><?php __('Advertisements');?></h2>
	
	<div>
		<?php echo $this->Html->link(__('Add Advertisement', true), array('admin' => true, 'action' => 'add')); ?>
	</div>
	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($advertisements as $advertisement):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $advertisement['Advertisement']['id']; ?>&nbsp;</td>
		<td><?php echo $advertisement['Advertisement']['name']; ?>&nbsp;</td>
		<td><?php echo $advertisement['Advertisement']['type']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $advertisement['Advertisement']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $advertisement['Advertisement']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $advertisement['Advertisement']['id'])); ?>
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
