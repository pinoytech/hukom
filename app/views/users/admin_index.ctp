<?php $paginator->options(array('url' => $this->passedArgs)); ?>
<div class="users index">
	<h2><?php __('Users');?></h2>
	
	<div id="search-toggle-holder">
	  <?php echo $html->link(__('Search', true), 'javascript:void(0)', array('class'=>'search-toggle')); ?>
	</div>
	
	<?php
  
	if (!empty($title)) {
	  echo '<b>Search Parameters</b>';
	  echo '<br />';
    echo $title;
    echo '<br />';
    echo '<br />';
	}
	?>

	<?php echo $form->create('Users',array('action'=>'search','class'=>'search-form'));?>
  	<fieldset>
   		<legend><?php __('User Search');?></legend>
    	<?php
    		echo $form->input('Search.keywords');
    		echo $form->input('Search.id');
    		echo $form->input('Search.username',array('after'=>__('wildcard is *',true)));
    		echo $form->input('Search.first_name',array('after'=>__('wildcard is *',true)));
    		echo $form->input('Search.last_name',array('after'=>__('wildcard is *',true)));
    		echo $form->input('Search.type',array(
    			'empty'=>__('Any',true),
    			'options'=>array(
    				'personal'=>__('Personal',true),
    				'corporation'=>__('Corporation',true),
    			),
    		));
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
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('First Name', 'PersonalInfo.first_name');?></th>
			<th><?php echo $this->Paginator->sort('Last Name', 'PersonalInfo.last_name');?></th>
			<th><?php echo $this->Paginator->sort('Type', 'User.type');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
    // debug($users);
	foreach ($users as $user):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $user['User']['id']; ?>&nbsp;</td>
		<td><?php echo $user['User']['username']; ?>&nbsp;</td>
		<td><?php echo $user['PersonalInfo']['first_name']; ?>&nbsp;</td>
		<td><?php echo $user['PersonalInfo']['last_name']; ?>&nbsp;</td>
		<td><?php echo $user['User']['type']; ?>&nbsp;</td>
		<td><?php echo $user['User']['created']; ?>&nbsp;</td>
		<td class="actions">
		    <?php echo $this->Html->link(__('View Personal Info', true), array('controller' => 'personalinfos', 'action' => 'view', $user['PersonalInfo']['id'])); ?>
		    <?php
			    if (isset($user['PersonalInfo']['civil_status']) AND $user['PersonalInfo']['civil_status'] != 'Single') {
			        echo $this->Html->link(__('View Spouse Info', true), array('controller' => 'spouseinfos', 'action' => 'view', $user['SpouseInfo']['id']));
			    }
			?>
			<?php
			    if (isset($user['ChildrenInfo']) AND $user['ChildrenInfo']['no_of_children'] != 0) {
			        echo $this->Html->link(__('View Children Info', true), array('controller' => 'childrenlists', 'action' => 'index', $user['User']['id']));
			    }
			?>
			<?php echo $this->Html->link(__('View Cases', true), array('controller' => 'legalcases', 'action' => 'index', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit User Info', true), array('action' => 'edit', $user['User']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>

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
<?php $html->scriptBlock("search_toggle();", array('inline'=>false));?>
<?php $html->scriptBlock("date_picker();", array('inline'=>false));?>