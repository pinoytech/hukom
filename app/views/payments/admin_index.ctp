<?php
// debug($Payment); exit;
?>
<div class="cases index">
	<h2><?php __('Payments');?></h2>
	
	<?php echo $this->element('admin_search_toggle'); ?>  
	<?php echo $form->create('Payments',array('action'=>'search','class'=>'search-form'));?>
  	<fieldset>
   		<legend><?php __('Payments Search');?></legend>
    	<?php
    		echo $form->input('Search.keywords');
    		echo $form->input('Search.id');
    		echo $form->input('Search.case_id', array('type' => 'text', 'label' => 'Case ID'));
    		echo $form->input('Search.case_detail_id', array('type' => 'text', 'label' => 'Case Detail ID'));
    		echo $form->input('Search.username');
    		echo $form->input('Search.legal_service',array(
    			'empty'=>__('Any',true),
    			'options'=>array(
    			  'Per Query' => 'Per Query',
    			  'Video Conference' => 'Video Conference',
    			  'Office Conference' => 'Office Conference',
    			  'Monthly Retainer' => 'Monthly Retainer',
    			  'Case Retainer' => 'Case/Project Retainer',
    			),
    		));
    		echo $form->input('Search.option',array(
    			'empty'=>__('Any',true),
    			'options'=>array(
    			  'Bank Deposit' => 'Bank Deposit',
    			  'Paypal' => 'Paypal',
    			  'GCash' => 'GCash',
    			  'SmartMoney' => 'SmartMoney',
    			  'Check Cash Pick up' => 'Check/Cash Pick up',
    			  'Cashsense' => 'Cashsense'
    			),
    		));
    		echo $form->input('Search.status',array(
    			'empty'=>__('Any',true),
    			'options'=>array(
    			  'Pending' => 'Pending',
    			  'Overdue' => 'Overdue',
    			  'Confirmed' => 'Confirmed',
    			),
    		));
    		echo $form->input('Search.amount');
    		echo $form->input('Search.created', array('class' => 'date_picker search_date_picker', 'label' => 'Date Created'));
        echo '<div class="input text"><label for="SearchCreated">Date Range</label>';
          echo 'Start Date ';
      		echo $form->input('Search.start_date', array('class' => 'date_picker search_date_picker', 'label' => false, 'div' => false));
      		echo ' End Date ';
      		echo $form->input('Search.end_date', array('class' => 'date_picker search_date_picker', 'label' => false, 'div' => false));
        echo '</div>';
    		echo $form->submit('Search');
    	?>
  	</fieldset>
  <?php echo $form->end();?>
	
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
		<td><?php echo $Payment['User']['referred_by']; ?></td>
		<td><?php echo $Payment['Payment']['status']; ?>&nbsp;</td>
		<td><?php echo $Payment['Payment']['amount']; ?>&nbsp;</td>
		<td><?php echo $Payment['Payment']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $Payment['Payment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $Payment['Payment']['id'])); ?>
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
<?php $html->scriptBlock("search_toggle();", array('inline'=>false));?>
<?php $html->scriptBlock("date_picker();", array('inline'=>false));?>