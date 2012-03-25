<div class="cases index">
	<h2><?php __('Cases');?></h2>
	
	<?php echo $this->element('admin_search_toggle'); ?>
  
	<?php echo $form->create('Legalcases',array('action'=>'search','class'=>'search-form'));?>
  	<fieldset>
   		<legend><?php __('Cases Search');?></legend>
    	<?php
    		echo $form->input('Search.keywords');
    		echo $form->input('Search.id');
    		echo $form->input('Search.username',array('after'=>__('wildcard is *',true)));
    		echo $form->input('Search.legal_problem',array(
    			'empty'=>__('Any',true),
    			'options'=>array(
            'Personal' => 'Personal',
      			'Family' => 'Family',
      			'Property' => 'Property',
      			'Contractual' => 'Contractual',
      			'Business' => 'Business',
      			'Single Proprietorship' => 'Single Proprietorship',
      			'Corporation Partnership' => 'Corporation Partnership',
      			'Unregistered Business, Joint Venture, Consortium etc' => 'Unregistered Business, Joint Venture, Consortium etc',
      			'Others' => 'Others',
      			'Work' => 'Work',
      			'Legal Documents' => 'Legal Documents',
      			'Special Projects/Contracts' => 'Special Projects/Contracts',
    			),
    		));
    		echo $form->input('Search.anything_under_the_sun');
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
			<th><?php echo $this->Paginator->sort('Username', 'User.username');?></th>
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
		<td><?php echo $this->Custom->ShortenText($Legalcases['Legalcase']['legal_problem'],30); ?>&nbsp;</td>
		<td><?php echo $Legalcases['Legalcase']['status']; ?>&nbsp;</td>
		<td><?php echo $Legalcases['Legalcase']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View Case', true), array('controller' => 'legalcasedetails', 'action' => 'index', $Legalcases['Legalcase']['id'])); ?>
			<?php echo $this->Html->link(__('Edit Case Status', true), array('action' => 'edit', $Legalcases['Legalcase']['id'])); ?>
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
<?php $html->scriptBlock("search_toggle();", array('inline'=>false));?>
<?php $html->scriptBlock("date_picker();", array('inline'=>false));?>